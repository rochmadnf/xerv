@extends('layouts.console')

@section('title', 'Ubah Data Pengguna')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Data Pengguna</h1>
    </div>

    @if (session()->has('success'))
        <input type="hidden" data-variants="success" id="flashMessage" value="{{ session()->get('success') }}">
    @endif

    @if ($profileSection)
        <div class="mt-8 rounded-lg border border-slate-300/30 p-4 shadow shadow-slate-300">
            <h2 class="border-b-2 border-b-slate-900 pb-2 text-xl font-bold">Data Diri</h2>
            <form action="{{ route('console.users.update', ['id' => $user?->username]) }}" class="space-y-4" method="POST"
                enctype="multipart/form-data">
                @csrf
                <x-forms.input name="name" :label="(int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') ? 'Nama Akun' : 'Nama ASN'" :value="old('name') ?? $user->name" />
                @if ((int) env('SUPER_ADMIN_ID') !== $user?->id)
                    <div class="flex flex-row items-center gap-x-4">
                        <x-forms.input name="front_title" label="Gelar Depan" :value="old('front_title') ?? $user?->user_detail?->front_title" placeholder="" />
                        <x-forms.input name="back_title" label="Gelar Belakang" :value="old('back_title') ?? $user?->user_detail?->back_title" placeholder="" />
                    </div>
                @endif
                <x-forms.input name="username" :label="(int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') &&
                (int) auth()->user()->id === $user->id
                    ? 'Nama Pengguna'
                    : 'NIP'" :value="old('username') ?? $user?->username" />
                @if ((int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') && (int) env('SUPER_ADMIN_ID') !== $user?->id)
                    <div class="space-y-1.5">
                        <label class="uk-form-label">Bidang</label>
                        <div class="uk-form-controls">
                            <uk-select name="field" id="field" placeholder="--Pilih Bidang--" searchable uk-cloak>
                                @foreach ($fields as $field)
                                    <option value="{{ $field->id . '--' . $field->name }}" @selected((int) $field->id === (int) $user?->user_detail?->field_id)>
                                        {{ $field->name }}
                                    </option>
                                @endforeach
                            </uk-select>
                        </div>
                        @error('field')
                            <p class="uk-form-help uk-text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                @if ((int) auth()->user()->id === (int) env('SUPER_ADMIN_ID') && (int) env('SUPER_ADMIN_ID') !== $user?->id)
                    <x-forms.input name="position" label="Jabatan" :value="old('position') ?? $user?->user_detail?->position" placeholder="Sekretaris" />
                @endif
                <div class="flex items-center gap-x-4">
                    <a href="{{ url()->previous() }}"
                        class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
                    <button type="submit"
                        class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    @endif
    @if ($passSection)
        <div class="mt-8 scroll-mt-16 rounded-lg border border-slate-300/30 p-4 shadow shadow-slate-300"
            id="passwordSection">
            <h2 class="border-b-2 border-b-slate-900 pb-2 text-xl font-bold">Katasandi</h2>
            <form action="{{ route('console.users.change.password', ['id' => $user?->username]) }}" class="space-y-4"
                method="POST">
                @csrf
                @if ((int) auth()->user()->id !== (int) env('SUPER_ADMIN_ID') && auth()->user()->id === $user?->id)
                    <x-forms.input type="password" name="current_password" label="Katasandi Lama" :value="old('current_password') ?? ''"
                        placeholder="********" />
                @endif
                <x-forms.input type="password" name="password" label="Katasandi Baru" :value="old('password') ?? ''"
                    placeholder="********" />
                <x-forms.input type="password" name="password_confirmation" label="Konfirmasi Katasandi Baru"
                    :value="old('password_confirmation') ?? ''" placeholder="********" />
                <div class="flex items-center gap-x-4">
                    <a href="{{ url()->previous() }}"
                        class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
                    <button type="submit"
                        class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    @endif

@endsection
