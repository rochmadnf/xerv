@extends('layouts.console')

@section('title', 'Berkas IKI')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Ubah Berkas IKI</h1>
    </div>

    @if (session()->has('success'))
        <input type="hidden" data-variants="success" id="flashMessage" value="{{ session()->get('success') }}">
    @endif

    <form action="{{ route('files.iki.update', ['id' => $file->uuid]) }}" class="mt-8 space-y-4" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="space-y-2">
            <span class="uk-label w-full bg-blue-500 py-2 text-white">Catatan: Tidak perlu mengunggah dokumen baru jika
                tidak ingin
                melakukan perubahan pada
                dokumen.</span>
            <x-forms.input name="doc" label="Dokumen" type="file" />

        </div>
        <x-forms.input name="doc_year" pattern="\d*" minlength="4" maxlength="4" label="Tahun" type="text"
            :value="old('doc_year') ?? $file->document_year" step="1" placeholder="2023" />

        <div class="space-y-1.5">
            <label class="uk-form-label">Aparatur Sipil Negara</label>
            <div class="uk-form-controls">
                <uk-select name="asn" id="asn" placeholder="--Pilih ASN--" searchable uk-cloak>
                    @foreach ($employees as $employee)
                        <option selected="{{ $employee->id === $file->user_id ? 'selected' : false }}"
                            value="{{ $employee->id . '--' . trim("{$employee?->user_detail?->front_title} {$employee?->name} {$employee?->user_detail?->back_title}") }} ">
                            {{ trim("{$employee?->user_detail?->front_title} {$employee?->name} {$employee?->user_detail?->back_title}") }}
                        </option>
                    @endforeach
                </uk-select>
            </div>
            @error('asn')
                <p class="uk-form-help uk-text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex items-center gap-x-4">
            <a href="{{ route('files.iki.index') }}"
                class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
            <button type="submit"
                class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
        </div>
    </form>
@endsection
