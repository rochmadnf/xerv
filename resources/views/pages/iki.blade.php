@extends('layouts.app')

@section('title', 'Daftar Dokumen IKI')

@section('content')
    <div class="relative h-full rounded-2xl bg-white px-10 pb-10 shadow-md shadow-slate-300 lg:max-h-[665px] lg:w-[1000px]">
        <x-menu-back />
        <div class="flex h-full w-full flex-col space-y-8">
            <div class="flex h-60 w-full justify-between gap-24 rounded-lg bg-blue-500 p-6">
                <div class="flex flex-col gap-y-2 text-white">
                    <h3 class="text-4xl font-bold">IKI</h3>
                    <h6 class="text-lg font-medium">Indeks Kinerja Individu</h6>
                    <p class="text-justify tracking-wide">&mdash; Hai AKIPers, Sebagai bentuk transparansi dan
                        akuntabilitas,
                        kami
                        menghadirkan
                        dokumen Indeks
                        Kinerja Individu (IKI) para Aparatur Sipil Negara (ASN). Setiap dokumen ini menggambarkan
                        dedikasi dan pencapaian para ASN dalam memberikan pelayanan terbaik bagi masyarakat.</p>
                </div>
                <img src="{{ asset('assets/illustration/asset-1.png') }}" alt="IKI Character">
            </div>

            <div
                class="flex h-auto w-full flex-1 flex-col gap-y-4 overflow-y-auto rounded-lg border border-slate-400 p-4 lg:max-h-[285px]">
                @foreach ($fields as $field)
                    <div class="space-y-4">
                        <h4 class="font-bold leading-tight tracking-tight text-gray-700">{{ $field->name }}</h4>
                        <div class="flex flex-col gap-y-4">
                            @php
                                $sortNumber = 1;
                            @endphp
                            @foreach ($files as $file)
                                @if ((int) $file->field_id === (int) $field->id)
                                    <div
                                        class="flex flex-row items-center gap-x-2 divide-x divide-slate-700/70 rounded-lg border border-slate-700/70 px-4 py-2">

                                        <div class="size-6 rounded-full bg-blue-500 text-center font-medium text-white">
                                            {{ $sortNumber++ }}</div>

                                        <div class="flex flex-1 flex-col gap-y-1 px-2">
                                            <h4 class="text-lg/5 font-semibold">
                                                {{ trim("{$file->user?->user_detail?->front_title} {$file->user->name} {$file->user?->user_detail?->back_title}") }}
                                            </h4>
                                            <p class="text-sm font-medium">{{ $file->user->user_detail->position }}</p>
                                        </div>

                                        <div class="flex flex-row gap-x-2 pl-2">
                                            <div class="flex items-center gap-1.5">
                                                <button data-id="{{ $file->iki_uuid }}" data-fn="preview"
                                                    class="inline-flex items-center rounded-full bg-blue-500 p-2 text-white transition duration-300 hover:bg-blue-600">
                                                    <svg viewBox="0 0 24 24" class="size-5 pointer-events-none"
                                                        fill="none" stroke="currentColor" stroke-width="1.5"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M22 10V15C22 20 20 22 15 22H9C4 22 2 20 2 15V9C2 4 4 2 9 2H14"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M22 10H18C15 10 14 9 14 6V2L22 10Z" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M7 13H13" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M7 17H11" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>

                                                <span class="text-sm">Tinjau</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('viteResource')
    @vite('resources/js/preview-card.js')
@endsection
