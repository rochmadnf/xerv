<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Console\Field;
use App\Models\Console\File\Iki;
use App\Models\Console\UserDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        if (!is_null($userDetailSelectedField)) {
            $userDetailSelectedField->update(['order_number' => $userDetail?->order_number]);
        }

        $userDetail->update(['order_number' => $request?->order_number]);

        return back();
    }

    public function edit(string|int $id)
    {
        $user = User::where('username', $id)->firstOrFail();

        if ((string) $user->username !== (string) auth()->user()->username) {
            return back();
        }

        $fields = Field::get();
        $profileSection = true;
        $passSection = false;

        if (request()->has('action') && request()->action === 'change-password') {
            $passSection = true;
            $profileSection = false;
        }

        if ((int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') && (int) auth()->user()->id !== $user->id) {
            $passSection = true;
        }

        return view('pages.console.users.edit', [
            'user' => $user,
            'fields' => $fields,
            'passSection' => $passSection,
            'profileSection' => $profileSection
        ]);
    }

    public function update(string|int $id, Request $request)
    {
        $user = User::where('username', $id)->firstOrFail();
        $currentNIP = $user->username;

        if ((int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') && (int) env('SUPER_ADMIN_ID') === (int) $user->id) {
            $validData = $request->validate([
                'name' => ['required', 'string', 'min:3'],
                'username' => ['required', 'string', 'min:5', Rule::unique('users', 'username')->ignore($id, 'username')],
            ]);

            $user->update([
                'name' => $validData['name'],
                'username' => $validData['username']
            ]);
        } else {
            if ((int) auth()->user()->id !== intval(env('SUPER_ADMIN_ID')) && (int) auth()->user()->id !== $user->id) {
                return redirect()->route('console.dashboard');
            }
            $rules = [
                'name' => ['required', 'string', 'min:3'],
                'username' => ['required', 'string', 'min:5', Rule::unique('users', 'username')->ignore($id, 'username')],
                'front_title' => ['nullable', 'string', 'min:2'],
                'back_title' => ['nullable', 'string', 'min:2'],
            ];
            if ($request->has('field')) {
                $request->request->set('field', intval(explode('--', $request->field)[0]));
                $rules['field'] = ['required', 'integer', 'min:1'];
                $rules['position'] = ['required', 'string', 'min:2'];
            }

            $validData = $request->validate($rules, [], ['position' => 'Jabatan', 'field' => 'Bidang', 'back_title' => 'Gelar Belakang', 'front_title' => 'Gelar Depan', 'username' => 'NIP', 'name' => 'Nama ASN']);

            if ($request->has('field')) {
                if ((int) $user->user_detail->field_id !== (int) $validData['field']) {
                    $lastOrderNumber = intval(UserDetail::where('field_id', $validData['field'])->latest()->first()?->order_number) + 1;
                    $sort = 1;
                    foreach (UserDetail::whereNot('user_id', $user->id)->where('field_id', (int) $user->user_detail->field_id)->get() as $order) {
                        $order->update(['order_number' => $sort]);
                        $sort += 1;
                    }
                }
            }

            $user->update([
                'name' => $validData['name'],
                'username' => $validData['username']
            ]);

            $user->user_detail()->update([
                'front_title' => $validData['front_title'],
                'back_title' => $validData['back_title'],
                'field_id' => $validData['field'] ?? $user->user_detail->field_id,
                'position' => $validData['position'] ?? $user->user_detail->position,
                'order_number' => $lastOrderNumber ?? $user->user_detail->order_number,
            ]);
        }

        if ($currentNIP !== $user->username) {
            return redirect()->route('console.users.edit', ['id' => $user->username])->with('success', 'Data berhasil diubah.');
        }

        return back()->with('success', 'Data berhasil diubah.');
    }

    public function changePassword(int|string $id, Request $request)
    {
        $user = User::where('username', $id)->firstOrFail();

        $rules = [
            'current_password' => ['required', 'string', 'min:8', 'current_password'],
            'password' => ['different:current_password', 'required', 'string', 'confirmed', 'min:8']
        ];

        if ((int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') && (int) env('SUPER_ADMIN_ID') !== $user->id) {
            unset($rules['current_password']);
        }

        $validData = $request->validate($rules, [], ['current_password' => 'Katasandi Lama', 'password' => 'Katasandi']);

        $user->update(['password' => bcrypt($validData['password'])]);

        return back()->with('success', 'Katasandi berhasil diubah.');
    }

    public function destroy(int $id)
    {
        $user = User::where('username', $id)->firstOrFail();

        if ($user) {
            $iki = Iki::where('user_id', $user->id)->first();
            if (str()->of($iki->document_path)->contains('sample.pdf') === false) {
                Storage::disk('asset_public')->delete($iki->document_path);
            }
            $iki->delete();
            $userField = UserDetail::where('user_id', $user->id)?->first();
            $otherUserDetailsOnSameField = UserDetail::where('field_id', $userField->field_id)->get();
            $userField->delete();

            $sortNumber = 0;
            foreach ($otherUserDetailsOnSameField as $other) {
                $other->update(['order_number' => $sortNumber]);
                $sortNumber += 1;
            }

            $user->delete();
        }

        return back();
    }
}
