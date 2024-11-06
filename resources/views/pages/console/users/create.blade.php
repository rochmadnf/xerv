@extends('layouts.console')

@section('title', 'Tambah Pengguna')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Tambah Pengguna</h1>
    </div>

    @if (session()->has('success'))
        <input type="hidden" data-variants="success" id="flashMessage" value="{{ session()->get('success') }}">
    @endif

    <form action="{{ route('console.users.store') }}" class="mt-8 space-y-4" method="POST" enctype="multipart/form-data">
        @csrf
        <x-forms.input name="name" label="Nama ASN" placeholder="Agustin Maria" :value="old('title') ?? ''" />
        <div class="flex flex-row items-center gap-x-4">
            <x-forms.input name="front_title" label="Gelar Depan" :value="old('front_title') ?? ''" placeholder="" />
            <x-forms.input name="back_title" label="Gelar Belakang" :value="old('back_title') ?? ''" placeholder="" />
        </div>
        <x-forms.input name="username" label="NIP" :value="old('username') ?? ''" placeholder="197708232009032002" />
        <div class="space-y-1.5">
            <label class="uk-form-label">Bidang</label>
            <div class="uk-form-controls">
                <uk-select name="field" id="field" placeholder="--Pilih Bidang--" searchable uk-cloak>
                    @foreach ($fields as $field)
                        <option value="{{ $field->id . '--' . $field->name }}">
                            {{ $field->name }}
                        </option>
                    @endforeach
                </uk-select>
            </div>
            @error('field')
                <p class="uk-form-help uk-text-danger">{{ $message }}</p>
            @enderror
        </div>
        <x-forms.input name="position" label="Jabatan" :value="old('position') ?? ''" placeholder="Sekretaris" />
        <div class="flex items-center gap-x-4">
            <a href="{{ route('console.users') }}"
                class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
            <button type="submit"
                class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
        </div>
    </form>
@endsection
