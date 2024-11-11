@extends('layouts.console')

@section('title', 'Dashboard')


@section('content')
    <div class="flex items-end justify-between gap-4">
        <h1 class="text-2xl/8 font-semibold text-zinc-950">Dashboard</h1>
    </div>

    <div class="mt-8 space-y-4 rounded-lg border border-blue-600 bg-blue-400 p-6 text-white">
        <h1 class="text-2xl font-bold">Hai {{ auth()->user()?->name }}</h1>
        <p class="text-lg">Selamat Datang di Admin Panel SI-AKIP BRIDA.</p>
    </div>
@endsection
