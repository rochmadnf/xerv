@extends('layouts.console')

@section('title', 'Ubah Dokumen AKIP')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Ubah Dokumen AKIP</h1>
    </div>

    @if (session()->has('success'))
        <input type="hidden" data-variants="success" id="flashMessage" value="{{ session()->get('success') }}">
    @endif

    <form action="{{ route('files.akip.update.file', ['id' => $file->uuid]) }}" class="mt-8 space-y-4" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-forms.input name="doc" label="Dokumen" type="file" />
        <div class="flex items-center gap-x-4">
            <a href="{{ route('files.index', ['file_type' => 'akip']) }}"
                class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
            <button type="submit"
                class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
        </div>
    </form>
@endsection
