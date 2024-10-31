@extends('layouts.console')

@section('title', 'Ubah Data Berkas AKIP')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Ubah Data Berkas AKIP</h1>
    </div>

    @if (session()->has('success'))
        <input type="hidden" data-variants="success" id="flashMessage" value="{{ session()->get('success') }}">
    @endif

    <form action="{{ route('files.akip.update', ['id' => $file->uuid]) }}" class="mt-8 space-y-4" method="POST">
        @method('PUT')
        @csrf
        <x-forms.input name="title" label="Nama Dokumen" placeholder="POHON KINERJA BRIDA" :value="old('title') ?? $file->title" />
        <x-forms.input name="doc_year" pattern="\d*" minlength="4" maxlength="4" label="Tahun" type="text"
            :value="old('doc_year') ?? $file->document_year" step="1" placeholder="2023" />
        <x-forms.input name="pic" label="Penanggung Jawab" :value="old('pic') ?? $file->pic" placeholder="Alex Widodo" />
        <div class="flex items-center gap-x-4">
            <a href="{{ route('files.index', ['file_type' => 'akip']) }}"
                class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
            <button type="submit"
                class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
        </div>
    </form>
@endsection
