@extends('layouts.app')

@section('title', 'Daftar Dokumen AKIP')

@section('content')
    <div
        class="relative h-full w-full bg-white px-4 pb-4 shadow-md shadow-slate-300 lg:max-h-[665px] lg:w-[1000px] lg:rounded-2xl lg:px-10 lg:pb-10">
        <x-menu-back />
        <div class="flex h-full w-full flex-col space-y-8">
            <div
                class="flex w-full flex-col items-center justify-center gap-10 rounded-lg bg-slate-600 p-6 lg:h-60 lg:flex-row lg:items-start lg:justify-between lg:gap-24">
                <div class="flex w-fit flex-col rounded-2xl bg-white px-4 py-3 lg:hidden">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo SIAKIP BRIDA" class="w-32">
                </div>
                <div class="hidden flex-col gap-y-2 text-white lg:flex">
                    <h3 class="text-4xl font-bold">AKIP</h3>
                    <h6 class="text-lg font-medium">Akuntabilitas Kinerja Instansi
                        Pemerintah</h6>
                    <p class="text-justify text-xs tracking-wide lg:text-base">&mdash; Hai AKIPers, Sebagai
                        bentuk komitmen
                        untuk memberikan
                        informasi yang jelas dan dapat dipertanggungjawabkan mengenai kinerja kami. Kamu dapat mengakses
                        dokumen yang mencerminkan upaya kami dalam mencapai transparansi, efisiensi, dan efektivitas dalam
                        pelayanan publik.</p>
                </div>
                <img class="w-44" src="{{ asset('assets/illustration/asset-2.png') }}" alt="IKI Character">

                {{-- @:mobile-view --}}
                <div class="block space-y-1 text-center text-white lg:hidden">
                    <h3 class="text-3xl font-bold leading-tight tracking-wide">AKIP</h3>
                    <h5 class="text-base font-medium tracking-wide">Akuntabilitas Kinerja Instansi
                        Pemerintah</h5>
                </div>
            </div>

            <div
                class="flex h-full w-full flex-1 flex-col gap-y-4 rounded-lg border border-slate-400 p-4 lg:max-h-[285px] lg:min-h-[285px] lg:overflow-y-auto">

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
                <div class="flex flex-col gap-y-4">
                    @php
                        $sortNumber = 1;
                    @endphp
                    @forelse ($files as $file)
                        <div
                            class="relative flex flex-col items-start gap-x-0 gap-y-2 rounded-lg border border-slate-700/70 px-4 py-4 lg:flex-row lg:items-center lg:gap-x-2 lg:gap-y-0 lg:divide-x lg:divide-slate-700/70">

                            <div class="size-6 hidden rounded-full bg-blue-500 text-center font-medium text-white lg:block">
                                {{ $sortNumber }}</div>
                            <div
                                class="size-6 absolute -left-2.5 -top-2.5 block rounded-full bg-blue-500 text-center font-medium text-white lg:hidden">
                                {{ $sortNumber++ }}</div>

                            <div
                                class="flex w-full flex-1 flex-col border-b border-b-slate-700/70 pb-2 lg:border-b-0 lg:px-4 lg:pb-0">
                                <h4 class="text-sm/5 font-semibold lg:text-lg/5">
                                    {{ trim("{$file->title}") }}
                                </h4>
                            </div>

                            <div class="flex flex-row gap-x-2 pl-0 lg:pl-2">
                                <button data-id="{{ $file->uuid }}" data-fn="preview" data-file-type="akip"
                                    class="inline-flex items-center rounded-full bg-teal-500 p-2 text-white transition duration-300 hover:bg-teal-600">
                                    <svg viewBox="0 0 24 24" class="size-5 pointer-events-none" fill="none"
                                        stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 10V15C22 20 20 22 15 22H9C4 22 2 20 2 15V9C2 4 4 2 9 2H14"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M22 10H18C15 10 14 9 14 6V2L22 10Z" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7 13H13" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7 17H11" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button data-id="{{ $file->uuid }}" data-fn="download" data-file-type="akip"
                                    class="inline-flex items-center rounded-full bg-slate-500 p-2 text-white transition duration-300 hover:bg-slate-600">
                                    <svg viewBox="0 0 24 24" class="size-5 pointer-events-none" fill="none"
                                        stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 11V17L11 15" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9 17L7 15" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M22 10V15C22 20 20 22 15 22H9C4 22 2 20 2 15V9C2 4 4 2 9 2H14"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M22 10H18C15 10 14 9 14 6V2L22 10Z" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                    @empty
                        <div class="mt-4 flex items-center rounded-lg bg-blue-50 p-4 text-sm text-blue-800"
                            role="alert">
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
                    @endforelse
                </div>
            </div>
        </div>
        <footer class="mt-8 block w-full text-center text-sm font-medium text-gray-500 sm:hidden">
            &copy; 2024 SI-AKIP BRIDA
        </footer>
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
