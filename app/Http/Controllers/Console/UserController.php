<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Console\Field;
use App\Models\Console\UserDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $fields = Field::get();
        $fieldSelected = request()->get('field') ?? 1;
        $users = User::notSuperAdmin()->whereHas('user_detail', function (Builder $query) use ($fieldSelected) {
            $query->where('field_id', $fieldSelected);
        })->orderByRaw('(SELECT order_number FROM user_details WHERE user_details.user_id = users.id)')->get();

        return view('pages.console.users.index', compact('users', 'fields', 'fieldSelected'));
    }

    public function create()
    {
        $fields = Field::get();
        return view('pages.console.users.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->request->set('field', intval(explode('--', $request->field)[0]));

        $validData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'string', 'min:5', Rule::unique('users', 'username')],
            'front_title' => ['nullable', 'string', 'min:2'],
            'back_title' => ['nullable', 'string', 'min:2'],
            'field' => ['required', 'integer', 'min:1'],
            'position' => ['required', 'string', 'min:2'],
        ], [], ['position' => 'Jabatan', 'field' => 'Bidang', 'back_title' => 'Gelar Belakang', 'front_title' => 'Gelar Depan', 'username' => 'NIP', 'name' => 'Nama ASN']);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validData['name'],
                'username' => $validData['username'],
                'email' => str()->of($validData['name'])->slug() . '@email-sample.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'remember_token' => str()->random(10),
            ]);

            $user->user_detail()->create([
                'front_title' => $validData['front_title'],
                'back_title' => $validData['back_title'],
                'field_id' => $validData['field'],
                'position' => $validData['position'],
                'order_number' => ((int) UserDetail::where('field_id', $validData['field'])->latest()->first()?->order_number) + 1,
            ]);
            DB::commit();

            return back()->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function order(string $id, Request $request)
    {
        $userDetail = UserDetail::findOrFail($id);

        if (!$request->has('order_number') || !is_numeric($request?->order_number)) {
            return back();
        }

        $userDetailSelectedField = UserDetail::where(['field_id' => $userDetail->field_id, 'order_number' => $request?->order_number])->first();

        $userDetailSelectedField->update(['order_number' => $userDetail->order_number]);
        $userDetail->update(['order_number' => $request?->order_number]);

        return back();
    }
}
