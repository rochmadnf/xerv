<div class="space-y-1.5">
    <label for="{{ $name }}" class="text-sm font-medium leading-none">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}"
        class="flex h-10 w-full rounded-md border border-[hsl(240_5.9%_90%)] bg-[hsl(0_0%_100%)] px-3 py-2 text-sm ring-offset-[hsl(0_0%_100%)] placeholder:text-gray-400/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        {{ $attributes }}>
    @error($name)
        <small class="text-xs font-light text-red-500">{{ $message }}</small>
    @enderror
</div>
