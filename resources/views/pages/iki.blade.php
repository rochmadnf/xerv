@extends('layouts.app')

@section('title', 'Daftar Dokumen IKI')

@section('content')
    <div class="relative h-full rounded-2xl bg-white px-10 pb-10 shadow-md shadow-slate-300 lg:max-h-[665px] lg:w-[1000px]">
        <x-menu-back />
        <div class="flex h-full w-full flex-col space-y-8">
            <div class="flex h-60 w-full justify-between gap-24 rounded-lg bg-blue-500 p-6">
                <div class="flex flex-col gap-y-2 text-white">
                    <h3 class="text-4xl font-bold">IKI</h3>
                    <h6 class="text-lg font-medium">Indikator Kinerja Individu</h6>
                    <p class="text-justify tracking-wide">&mdash; Hai AKIPers, Sebagai bentuk transparansi dan
                        akuntabilitas,
                        kami
                        menghadirkan
                        dokumen Indikator
                        Kinerja Individu (IKI) para Aparatur Sipil Negara (ASN). Setiap dokumen ini menggambarkan
                        dedikasi dan pencapaian para ASN dalam memberikan pelayanan terbaik bagi masyarakat.</p>
                </div>
                <img src="{{ asset('assets/illustration/asset-1.png') }}" alt="IKI Character">
            </div>

            <div
                class="flex h-auto w-full flex-1 flex-col gap-y-4 overflow-y-auto rounded-lg border border-slate-400 p-4 lg:max-h-[285px] lg:min-h-[285px]">

                {{-- Year Selection --}}
                <form id="formYear" method="GET" class="flex flex-row items-center gap-x-4">
                    <button type="button" id="prevYear" class="hover:text-gray-500">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.5 12H9.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.5 9L8.5 12L11.5 15" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    <input data-init-value="{{ $initYear }}" name="year" id="seasonYear" type="tel"
                        maxlength="4" minlength="4" min="1998"
                        class="block w-20 rounded-md border border-b-[3px] p-2 text-center font-bold tracking-wide outline-none"
                        value="{{ $initYear }}" />

                    <button type="button" id="nextYear" class="rotate-180 hover:text-gray-500">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.5 12H9.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.5 9L8.5 12L11.5 15" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button type="submit"
                        class="hidden rounded-md bg-blue-500 px-2.5 py-2 text-sm tracking-wide text-white">
                        Terapkan
                    </button>
                </form>
                @if (count($files) > 0)
                    @foreach ($fields as $field)
                        <div class="relative space-y-4">
                            <div class="absolute left-2 top-10 h-[calc(100%-25px)] w-[1.5px] bg-gray-500"></div>
                            <div class="absolute -bottom-2.5 h-[2.5px] w-[calc(100%-25px)] bg-gray-500"></div>
                            <h4 class="font-bold leading-tight tracking-tight text-gray-700">{{ $field->name }}</h4>
                            <div class="flex flex-col gap-y-4 px-6">
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
                                                <button data-id="{{ $file->iki_uuid }}" data-fn="preview"
                                                    data-file-type="iki"
                                                    class="inline-flex items-center rounded-full bg-teal-500 p-2 text-white transition duration-300 hover:bg-teal-600">
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
                                                <button data-id="{{ $file->iki_uuid }}" data-fn="download"
                                                    data-file-type="iki"
                                                    class="inline-flex items-center rounded-full bg-slate-500 p-2 text-white transition duration-300 hover:bg-slate-600">
                                                    <svg viewBox="0 0 24 24" class="size-5 pointer-events-none"
                                                        fill="none" stroke="currentColor" stroke-width="1.5"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 11V17L11 15" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M9 17L7 15" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M22 10V15C22 20 20 22 15 22H9C4 22 2 20 2 15V9C2 4 4 2 9 2H14"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M22 10H18C15 10 14 9 14 6V2L22 10Z" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mt-4 flex items-center rounded-lg bg-blue-50 p-4 text-sm text-blue-800" role="alert">
                        <svg class="size-5 me-3 inline flex-shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-lg">
                            Dokumen <strong class="font-medium">Tahun {{ $initYear }}</strong> belum tersedia.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('viteResource')
    @vite(['resources/js/preview-card.js', 'resources/js/download-doc.js'])
@endsection

@section('script_page')
    <script>
        const deleteBtns = document.querySelectorAll('button#deleteBtn');
        deleteBtns.forEach((del) => {
            del.addEventListener('click', (e) => {
                const modal = document.getElementById(`deleteModal-${e.target.getAttribute('data-urut')}`);

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            })
        });
    </script>
    <script>
        function changeSeason(val) {
            const season = document.getElementById('seasonYear');

            const changedSeason = Number(season.value) + Number(val);
            season.value = changedSeason;

            const applyBtn = document.querySelector(`form#formYear>button[type='submit']`);

            if (
                Number(changedSeason) !== Number(season.dataset.initValue) &&
                Number(changedSeason) >= 1998 &&
                Number(changedSeason) <= Number(+new Date().getFullYear() + 10)
            ) {
                applyBtn.classList.remove('hidden');
            } else {
                applyBtn.classList.add('hidden');
            }
        }

        document.getElementById('formYear').addEventListener('submit', (el) => {
            if (Boolean(el.target.children[3].classList.contains('hidden')) === true) {
                el.preventDefault();
            }
        });

        document.getElementById('seasonYear').addEventListener('change', () => {
            changeSeason(0);
        });

        document.getElementById('seasonYear').addEventListener('keyup', () => {
            changeSeason(0);
        });

        document.getElementById('nextYear').addEventListener('click', () => {
            changeSeason(1);
        });

        document.getElementById('prevYear').addEventListener('click', () => {
            changeSeason(-1);
        });
    </script>
@endsection