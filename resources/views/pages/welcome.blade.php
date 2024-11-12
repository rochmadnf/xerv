@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
    <div class="relative mx-4 rounded-2xl bg-white p-6 shadow-md shadow-slate-300 sm:p-10 lg:min-h-[550px] lg:w-[1000px]">
        <div class="flex h-full w-full flex-col space-y-10">
            <div
                class="flex w-full flex-col justify-between rounded-xl bg-yellow-600/10 px-4 pb-3 pt-6 shadow shadow-amber-600/40 sm:flex-row lg:px-10">
                <div class="w-full sm:w-1/2">
                    <div class="flex w-fit flex-col rounded-2xl bg-white px-4 py-3">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo SIAKIP BRIDA" class="w-28 lg:w-44">
                    </div>
                    <h1 class="mt-4 text-2xl font-bold sm:text-3xl">Halo, AKIPers</h1>
                    <div class="mt-2.5 space-y-1.5">
                        <p class="text-lg font-semibold sm:text-xl">Selamat Datang di Aplikasi SI-AKIP</p>
                        <p class="mt-4 text-sm italic text-gray-800 sm:text-base lg:mt-0 lg:text-left">&mdash; Ayo Bersama
                            Wujudkan
                            Sulawesi Tengah yang
                            Lebih Maju
                            dan Lebih Sejahtera.</p>
                    </div>
                </div>
                <img src="{{ asset('assets/illustration/asset-4.png') }}" class="hidden w-60 self-center sm:block"
                    alt="Welcome Character">
            </div>
            <div class="grid h-full w-full flex-1 grid-rows-2 gap-4 lg:grid-cols-2 lg:grid-rows-1">
                <x-card-link :route="route('docs.akip')" label="AKIP" subLabel="Akuntabilitas Kinerja Instansi Pemerintah"
                    classes="bg-slate-600 hover:bg-slate-700 duration-300 transition" :illustration="asset('assets/illustration/asset-2.png')" />
                <x-card-link :route="route('docs.iki')" label="IKI" subLabel="Indikator Kinerja Individu"
                    classes="bg-blue-500 hover:bg-blue-600 duration-300 transition" :illustration="asset('assets/illustration/asset-1.png')" />
            </div>
        </div>
    </div>
@endsection
