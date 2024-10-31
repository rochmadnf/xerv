@extends('layouts.app')

@section('title', 'Masuk')

@section('viteResource')
    @vite(['resources/js/vendor/simple-notify.js'])
@endsection

@section('content')
    <main class="flex min-h-screen w-full items-center justify-center bg-gradient-to-br from-blue-50 to-blue-500">
        <div class="space-y-6 rounded-xl bg-white p-6 shadow-md shadow-slate-500/50">
            <div class="flex flex-col space-y-1.5">
                <h3 class="text-2xl font-semibold tracking-tight">Masuk</h3>
                <p class="text-sm text-[hsl(240_3.8%_46.1%)] dark:text-[hsl(240_5%_64.9%)]">Lengkapi kredensialmu untuk
                    mengakses akunmu.</p>
            </div>

            @error('account')
                <input type="hidden" data-variants="{{ $errors->first('status') }}" id="flashMessage" value="{{ $message }}">
            @enderror

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <x-forms.input placeholder="rochmadnf" name="username" label="Nama Pengguna" autofocus tabindex="1" />
                <x-forms.input placeholder="******" name="password" type="password" label="Katasandi" tabindex="2" />

                <button type="submit"
                    class="mb-2 me-2 w-full rounded-lg bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-blue-300">Masuk</button>
            </form>

        </div>
    </main>
@endsection
