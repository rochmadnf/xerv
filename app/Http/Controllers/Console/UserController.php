<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Console\Field;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::notSuperAdmin()->get();

        return view('pages.console.users.index', compact('users'));
    }

    public function create()
    {
        $fields = Field::get();
        return view('pages.console.users.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'string', 'min:5', Rule::unique('users', 'username')],
            'front_title' => ['nullable', 'string', 'min:2'],
            'back_title' => ['nullable', 'string', 'min:2'],
            'field' => ['required', 'string', 'min:2'],
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
                'field' => $validData['field'],
                'position' => $validData['position'],
            ]);
            DB::commit();

            return back()->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
