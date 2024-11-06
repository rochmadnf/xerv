<div
    {{ $attributes->class(['flex justify-between col-span-1 rounded-lg py-4 px-6 text-white'])->merge(['class' => $classes ?? 'bg-gray-800']) }}>
    <div class="flex flex-col justify-between space-y-6">
        <div class="select-none space-y-1">
            <h4 class="text-2xl font-bold leading-tight">{{ $label }}</h4>
            <p class="text-base font-medium">{{ $subLabel }}</p>
        </div>
        <a href="{{ $route }}"
            class="inline-flex w-fit rounded-md bg-white px-4 py-2 text-gray-900 transition-all duration-300 hover:-translate-y-1 hover:shadow hover:shadow-slate-800">
            <span class="font-medium">Lihat Dokumen</span>
        </a>
    </div>
    <img class="w-32" src="{{ $illustration }}" alt="Character Card">

</div>
