@extends('layouts.console')

@section('title', 'Berkas AKIP')

@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Berkas AKIP</h1>
        <a href="{{ route('files.create', ['file_type' => 'akip']) }}"
            class="inline-flex items-center gap-x-2 rounded-lg bg-blue-500 px-3 py-1.5 text-sm font-medium text-white transition duration-300 hover:bg-blue-600">
            <svg viewBox="0 0 24 24" fill="currentColor" class="size-6 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM16 12.75H12.75V16C12.75 16.41 12.41 16.75 12 16.75C11.59 16.75 11.25 16.41 11.25 16V12.75H8C7.59 12.75 7.25 12.41 7.25 12C7.25 11.59 7.59 11.25 8 11.25H11.25V8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V11.25H16C16.41 11.25 16.75 11.59 16.75 12C16.75 12.41 16.41 12.75 16 12.75Z" />
            </svg>
            <span class="text-base/5 font-medium">Tambah</span>
        </a>
    </div>

    <form id="formYear" method="GET" class="mt-8 flex flex-row items-center gap-x-4">
        <button type="button" id="prevYear" class="hover:text-gray-500">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 pointer-events-none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.5 12H9.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.5 9L8.5 12L11.5 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>

        <input data-init-value="{{ $initYear }}" name="year" id="seasonYear" type="tel" maxlength="4"
            minlength="4" min="1998"
            class="block w-20 rounded-md border border-b-[3px] p-2 text-center font-bold tracking-wide outline-none"
            value="{{ $initYear }}" />

        <button type="button" id="nextYear" class="rotate-180 hover:text-gray-500">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-8 pointer-events-none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.5 12H9.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.5 9L8.5 12L11.5 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <button type="submit" class="hidden rounded-md bg-blue-500 px-2.5 py-2 text-sm tracking-wide text-white">
            Terapkan
        </button>
    </form>

    <div class="mt-8 space-y-4">
        @php
            $no = 1;
        @endphp
        @forelse ($files as $file)
            <div class="relative flex w-full flex-row gap-x-3 rounded-lg border border-slate-300 p-4">
                <div class="size-6 mt-1 self-start rounded-full bg-blue-300 text-center font-medium text-white">
                    {{ $no++ }}</div>
                <div class="flex flex-1 shrink-0 flex-col justify-between gap-y-1 px-2">
                    <div class="space-y-0.5">
                        <span class="block text-sm font-semibold">Nama Dokumen</span>
                        <a href="{{ asset('assets/' . $file->document_path) }}" target="_blank"
                            class="inline-flex items-center font-medium transition-colors duration-200 hover:text-gray-700">
                            <h3>{{ $file->title }}</h3>
                        </a>
                    </div>
                    <div>
                        <span class="text-sm font-semibold">Penanggung Jawab</span>
                        <h3>{{ $file->pic }}</h3>
                    </div>
                </div>
                <div id="deleteModal-{{ $file->id }}" class="right-24 hidden items-center justify-center p-2">
                    <div class="space-y-4 rounded-lg border border-slate-500/50 bg-white p-4">
                        <p class="border-b border-b-slate-300 pb-2 font-medium uppercase">Menghapus Data?</p>
                        <form action="{{ route('files.akip.destroy', ['id' => $file->uuid]) }}" method="POST"
                            class="flex items-center gap-x-4">
                            @method('DELETE')
                            @csrf

                            <input type="hidden" name="">
                            <a href="{{ route('files.index', ['file_type' => 'akip']) }}"
                                class="rounded-lg bg-neutral-500 px-4 py-2 text-white transition duration-200 hover:bg-neutral-600">Tidak</a>
                            <button type="submit"
                                class="rounded-lg bg-red-500 px-4 py-2 text-white transition duration-200 hover:bg-red-600">Ya</button>
                        </form>
                    </div>
                </div>
                <div class="relative flex w-20 flex-col items-center justify-center gap-y-2">
                    {{-- Edit Data --}}
                    <div>
                        <a href="{{ route('files.akip.edit', ['id' => $file->uuid]) }}" type="button"
                            class="inline-flex items-center justify-center rounded-md bg-amber-500 p-2 text-white transition-colors duration-150 hover:bg-amber-400">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="size-5 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 22.75H9C3.57 22.75 1.25 20.43 1.25 15V9C1.25 3.57 3.57 1.25 9 1.25H11C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75H9C4.39 2.75 2.75 4.39 2.75 9V15C2.75 19.61 4.39 21.25 9 21.25H15C19.61 21.25 21.25 19.61 21.25 15V13C21.25 12.59 21.59 12.25 22 12.25C22.41 12.25 22.75 12.59 22.75 13V15C22.75 20.43 20.43 22.75 15 22.75Z" />
                                <path
                                    d="M8.49935 17.6901C7.88935 17.6901 7.32935 17.4701 6.91935 17.0701C6.42935 16.5801 6.21935 15.8701 6.32935 15.1201L6.75935 12.1101C6.83935 11.5301 7.21935 10.7801 7.62935 10.3701L15.5093 2.49006C17.4993 0.500059 19.5193 0.500059 21.5093 2.49006C22.5993 3.58006 23.0893 4.69006 22.9893 5.80006C22.8993 6.70006 22.4193 7.58006 21.5093 8.48006L13.6293 16.3601C13.2193 16.7701 12.4693 17.1501 11.8893 17.2301L8.87935 17.6601C8.74935 17.6901 8.61935 17.6901 8.49935 17.6901ZM16.5693 3.55006L8.68935 11.4301C8.49935 11.6201 8.27935 12.0601 8.23935 12.3201L7.80935 15.3301C7.76935 15.6201 7.82935 15.8601 7.97935 16.0101C8.12935 16.1601 8.36935 16.2201 8.65935 16.1801L11.6693 15.7501C11.9293 15.7101 12.3793 15.4901 12.5593 15.3001L20.4393 7.42006C21.0893 6.77006 21.4293 6.19006 21.4793 5.65006C21.5393 5.00006 21.1993 4.31006 20.4393 3.54006C18.8393 1.94006 17.7393 2.39006 16.5693 3.55006Z" />
                                <path
                                    d="M19.8496 9.82978C19.7796 9.82978 19.7096 9.81978 19.6496 9.79978C17.0196 9.05978 14.9296 6.96978 14.1896 4.33978C14.0796 3.93978 14.3096 3.52978 14.7096 3.40978C15.1096 3.29978 15.5196 3.52978 15.6296 3.92978C16.2296 6.05978 17.9196 7.74978 20.0496 8.34978C20.4496 8.45978 20.6796 8.87978 20.5696 9.27978C20.4796 9.61978 20.1796 9.82978 19.8496 9.82978Z" />
                            </svg>
                        </a>
                        <div class="uk-drop w-fit rounded-md border border-slate-300 bg-white p-2"
                            uk-drop="mode: hover; pos: left-center">
                            Ubah Data
                        </div>
                    </div>

                    {{-- Edit File --}}
                    <div>
                        <a href="{{ route('files.akip.edit.file', ['id' => $file->uuid]) }}" type="button"
                            class="inline-flex items-center justify-center rounded-md bg-emerald-500 p-2 text-white transition-colors duration-150 hover:bg-emerald-400">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="size-5 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.5396 21.94C10.3096 21.94 10.0895 21.84 9.93954 21.64L8.92953 20.29C8.71953 20.01 8.43956 19.85 8.13956 19.83C7.82956 19.81 7.53953 19.95 7.29953 20.2C5.84953 21.75 4.74954 21.62 4.21954 21.42C3.67954 21.21 2.76953 20.52 2.76953 18.3V7.04001C2.76953 2.60001 4.04953 1.25 8.23953 1.25H15.7896C19.9796 1.25 21.2596 2.60001 21.2596 7.04001V11.3C21.2596 11.71 20.9196 12.05 20.5096 12.05C20.0996 12.05 19.7596 11.71 19.7596 11.3V7.04001C19.7596 3.43001 19.1296 2.75 15.7896 2.75H8.23953C4.89953 2.75 4.26953 3.43001 4.26953 7.04001V18.3C4.26953 19.35 4.52953 19.93 4.76953 20.02C4.94953 20.09 5.43955 19.99 6.19955 19.18C6.74955 18.6 7.46954 18.29 8.21954 18.33C8.95954 18.37 9.65955 18.76 10.1295 19.39L11.1495 20.74C11.3995 21.07 11.3295 21.54 10.9995 21.79C10.8495 21.9 10.6896 21.94 10.5396 21.94Z" />
                                <path
                                    d="M16 7.75H8C7.59 7.75 7.25 7.41 7.25 7C7.25 6.59 7.59 6.25 8 6.25H16C16.41 6.25 16.75 6.59 16.75 7C16.75 7.41 16.41 7.75 16 7.75Z" />
                                <path
                                    d="M15 11.75H9C8.59 11.75 8.25 11.41 8.25 11C8.25 10.59 8.59 10.25 9 10.25H15C15.41 10.25 15.75 10.59 15.75 11C15.75 11.41 15.41 11.75 15 11.75Z" />
                                <path
                                    d="M14.8196 21.7816C14.4396 21.7816 14.0796 21.6416 13.8196 21.3816C13.5096 21.0716 13.3696 20.6216 13.4396 20.1516L13.6296 18.8016C13.6796 18.4516 13.8896 18.0316 14.1396 17.7816L17.6796 14.2416C18.1596 13.7616 18.6296 13.5116 19.1396 13.4616C19.7596 13.4016 20.3796 13.6616 20.9596 14.2416C21.5396 14.8216 21.7996 15.4316 21.7396 16.0616C21.6896 16.5616 21.4296 17.0416 20.9596 17.5216L17.4196 21.0616C17.1696 21.3116 16.7496 21.5216 16.3996 21.5716L15.0495 21.7616C14.9695 21.7716 14.8996 21.7816 14.8196 21.7816ZM19.3096 14.9516C19.2996 14.9516 19.2896 14.9516 19.2796 14.9516C19.1396 14.9616 18.9496 15.0916 18.7396 15.3016L15.1996 18.8416C15.1696 18.8716 15.1196 18.9716 15.1196 19.0116L14.9396 20.2616L16.1896 20.0816C16.2296 20.0716 16.3295 20.0216 16.3595 19.9916L19.8996 16.4516C20.1096 16.2316 20.2396 16.0516 20.2496 15.9116C20.2696 15.7116 20.0696 15.4716 19.8996 15.3016C19.7396 15.1416 19.5096 14.9516 19.3096 14.9516Z" />
                                <path
                                    d="M19.9206 18.2509C19.8506 18.2509 19.7806 18.2409 19.7206 18.2209C18.4006 17.8509 17.3506 16.8009 16.9806 15.4809C16.8706 15.0809 17.1006 14.6709 17.5006 14.5509C17.9006 14.4409 18.3106 14.6709 18.4206 15.0709C18.6506 15.8909 19.3006 16.5409 20.1206 16.7709C20.5206 16.8809 20.7506 17.3009 20.6406 17.7009C20.5506 18.0309 20.2506 18.2509 19.9206 18.2509Z" />
                            </svg>
                        </a>
                        <div class="uk-drop w-fit rounded-md border border-slate-300 bg-white p-2"
                            uk-drop="mode: hover; pos: left-center">
                            Ubah Dokumen
                        </div>
                    </div>

                    {{-- Delete --}}
                    <div>
                        <button type="button" id="deleteBtn" data-urut="{{ $file->id }}"
                            class="inline-flex items-center justify-center rounded-md bg-red-500 p-2 text-white transition-colors duration-150 hover:bg-red-400">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="size-5 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.9997 6.72998C20.9797 6.72998 20.9497 6.72998 20.9197 6.72998C15.6297 6.19998 10.3497 5.99998 5.11967 6.52998L3.07967 6.72998C2.65967 6.76998 2.28967 6.46998 2.24967 6.04998C2.20967 5.62998 2.50967 5.26998 2.91967 5.22998L4.95967 5.02998C10.2797 4.48998 15.6697 4.69998 21.0697 5.22998C21.4797 5.26998 21.7797 5.63998 21.7397 6.04998C21.7097 6.43998 21.3797 6.72998 20.9997 6.72998Z" />
                                <path
                                    d="M8.50074 5.72C8.46074 5.72 8.42074 5.72 8.37074 5.71C7.97074 5.64 7.69074 5.25 7.76074 4.85L7.98074 3.54C8.14074 2.58 8.36074 1.25 10.6907 1.25H13.3107C15.6507 1.25 15.8707 2.63 16.0207 3.55L16.2407 4.85C16.3107 5.26 16.0307 5.65 15.6307 5.71C15.2207 5.78 14.8307 5.5 14.7707 5.1L14.5507 3.8C14.4107 2.93 14.3807 2.76 13.3207 2.76H10.7007C9.64074 2.76 9.62074 2.9 9.47074 3.79L9.24074 5.09C9.18074 5.46 8.86074 5.72 8.50074 5.72Z" />
                                <path
                                    d="M15.2104 22.7501H8.79039C5.30039 22.7501 5.16039 20.8201 5.05039 19.2601L4.40039 9.19007C4.37039 8.78007 4.69039 8.42008 5.10039 8.39008C5.52039 8.37008 5.87039 8.68008 5.90039 9.09008L6.55039 19.1601C6.66039 20.6801 6.70039 21.2501 8.79039 21.2501H15.2104C17.3104 21.2501 17.3504 20.6801 17.4504 19.1601L18.1004 9.09008C18.1304 8.68008 18.4904 8.37008 18.9004 8.39008C19.3104 8.42008 19.6304 8.77007 19.6004 9.19007L18.9504 19.2601C18.8404 20.8201 18.7004 22.7501 15.2104 22.7501Z" />
                                <path
                                    d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z" />
                                <path
                                    d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z" />
                            </svg>
                        </button>
                        <div class="uk-drop w-fit rounded-md border border-slate-300 bg-white p-2"
                            uk-drop="mode: hover; pos: left-center">
                            Hapus
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="uk-alert border-blue-500 p-4">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                    <path
                        d="M6.85357 3.85355L7.65355 3.05353C8.2981 2.40901 9.42858 1.96172 10.552 1.80125C11.1056 1.72217 11.6291 1.71725 12.0564 1.78124C12.4987 1.84748 12.7698 1.97696 12.8965 2.10357C13.0231 2.23018 13.1526 2.50125 13.2188 2.94357C13.2828 3.37086 13.2779 3.89439 13.1988 4.44801C13.0383 5.57139 12.591 6.70188 11.9464 7.34645L7.49999 11.7929L6.35354 10.6465C6.15827 10.4512 5.84169 10.4512 5.64643 10.6465C5.45117 10.8417 5.45117 11.1583 5.64643 11.3536L7.14644 12.8536C7.34171 13.0488 7.65829 13.0488 7.85355 12.8536L8.40073 12.3064L9.57124 14.2572C9.65046 14.3893 9.78608 14.4774 9.9389 14.4963C10.0917 14.5151 10.2447 14.4624 10.3535 14.3536L12.3535 12.3536C12.4648 12.2423 12.5172 12.0851 12.495 11.9293L12.0303 8.67679L12.6536 8.05355C13.509 7.19808 14.0117 5.82855 14.1887 4.58943C14.2784 3.9618 14.2891 3.33847 14.2078 2.79546C14.1287 2.26748 13.9519 1.74482 13.6035 1.39645C13.2552 1.04809 12.7325 0.871332 12.2045 0.792264C11.6615 0.710945 11.0382 0.721644 10.4105 0.8113C9.17143 0.988306 7.80189 1.491 6.94644 2.34642L6.32322 2.96968L3.07071 2.50504C2.91492 2.48278 2.75773 2.53517 2.64645 2.64646L0.646451 4.64645C0.537579 4.75533 0.484938 4.90829 0.50375 5.0611C0.522563 5.21391 0.61073 5.34954 0.742757 5.42876L2.69364 6.59928L2.14646 7.14645C2.0527 7.24022 2.00002 7.3674 2.00002 7.50001C2.00002 7.63261 2.0527 7.75979 2.14646 7.85356L3.64647 9.35356C3.84173 9.54883 4.15831 9.54883 4.35357 9.35356C4.54884 9.1583 4.54884 8.84172 4.35357 8.64646L3.20712 7.50001L3.85357 6.85356L6.85357 3.85355ZM10.0993 13.1936L9.12959 11.5775L11.1464 9.56067L11.4697 11.8232L10.0993 13.1936ZM3.42251 5.87041L5.43935 3.85356L3.17678 3.53034L1.80638 4.90074L3.42251 5.87041ZM2.35356 10.3535C2.54882 10.1583 2.54882 9.8417 2.35356 9.64644C2.1583 9.45118 1.84171 9.45118 1.64645 9.64644L0.646451 10.6464C0.451188 10.8417 0.451188 11.1583 0.646451 11.3535C0.841713 11.5488 1.1583 11.5488 1.35356 11.3535L2.35356 10.3535ZM3.85358 11.8536C4.04884 11.6583 4.04885 11.3417 3.85359 11.1465C3.65833 10.9512 3.34175 10.9512 3.14648 11.1465L1.14645 13.1464C0.95119 13.3417 0.951187 13.6583 1.14645 13.8535C1.34171 14.0488 1.65829 14.0488 1.85355 13.8536L3.85358 11.8536ZM5.35356 13.3535C5.54882 13.1583 5.54882 12.8417 5.35356 12.6464C5.1583 12.4512 4.84171 12.4512 4.64645 12.6464L3.64645 13.6464C3.45119 13.8417 3.45119 14.1583 3.64645 14.3535C3.84171 14.5488 4.1583 14.5488 4.35356 14.3535L5.35356 13.3535ZM9.49997 6.74881C10.1897 6.74881 10.7488 6.1897 10.7488 5.5C10.7488 4.8103 10.1897 4.25118 9.49997 4.25118C8.81026 4.25118 8.25115 4.8103 8.25115 5.5C8.25115 6.1897 8.81026 6.74881 9.49997 6.74881Z"
                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
                <div class="uk-alert-title">Informasi</div>
                <div class="uk-alert-description">
                    Dokumen belum tersedia. Silakan <a href="{{ route('files.create', ['file_type' => 'akip']) }}"
                        class="text-blue-500">Tambah</a> data terlebih dahulu.
                </div>
            </div>
        @endforelse
    </div>
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
