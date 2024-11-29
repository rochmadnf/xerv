@extends('layouts.console')

@section('title', 'Berkas IKI')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Tambah Berkas IKI</h1>
    </div>

    @if (session()->has('alert'))
        @php
            $msg = explode(';', session()->get('alert'));
        @endphp
        <input type="hidden" data-variants="{{ $msg[0] }}" id="flashMessage" value="{{ $msg[1] }}">
    @endif

    <form action="{{ route('files.iki.store') }}" class="mt-8 space-y-4" method="POST" enctype="multipart/form-data">
        @csrf
        <x-forms.input name="doc" label="Dokumen" type="file" />
        <x-forms.input name="doc_year" pattern="\d*" minlength="4" maxlength="4" label="Tahun" type="text"
            :value="old('doc_year') ?? ''" step="1" placeholder="2023" />

        @if ((int) env('SUPER_ADMIN_ID') === auth()->user()?->id)
            <div class="space-y-1.5">
                <label class="uk-form-label">Aparatur Sipil Negara</label>
                <div class="uk-form-controls">
                    <uk-select name="asn" id="asn" placeholder="--Pilih ASN--" searchable uk-cloak>
                        @foreach ($employees as $employee)
                            <option
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
        @endif


        <div class="flex items-center gap-x-4">
            <a href="{{ route('files.iki.index') }}"
                class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Kembali</a>
            <button type="submit"
                class="rounded-lg bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600">Simpan</button>
        </div>
    </form>
@endsection
