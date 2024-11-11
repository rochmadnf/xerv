@php
    $menus = [
        [
            'label' => 'Dashboard',
            'route' => route('console.dashboard'),
            'mainRoute' => 'dashboard.*',
            'only_admin' => false,
            'iconPath' => '<path d="M8.27 22.75H4.23C2.22 22.75 1.25 21.82 1.25 19.9V4.1C1.25 2.18 2.23 1.25 4.23 1.25H8.27C10.28 1.25 11.25 2.18 11.25 4.1V19.9C11.25 21.82 10.27 22.75 8.27 22.75ZM4.23 2.75C2.96 2.75 2.75 3.09 2.75 4.1V19.9C2.75 20.91 2.96 21.25 4.23 21.25H8.27C9.54 21.25 9.75 20.91 9.75 19.9V4.1C9.75 3.09 9.54 2.75 8.27 2.75H4.23Z"/>
            <path d="M19.77 11.25H15.73C13.72 11.25 12.75 10.36 12.75 8.52V3.98C12.75 2.14 13.73 1.25 15.73 1.25H19.77C21.78 1.25 22.75 2.14 22.75 3.98V8.51C22.75 10.36 21.77 11.25 19.77 11.25ZM15.73 2.75C14.39 2.75 14.25 3.13 14.25 3.98V8.51C14.25 9.37 14.39 9.74 15.73 9.74H19.77C21.11 9.74 21.25 9.36 21.25 8.51V3.98C21.25 3.12 21.11 2.75 19.77 2.75H15.73Z"/>
            <path d="M19.77 22.75H15.73C13.72 22.75 12.75 21.77 12.75 19.77V15.73C12.75 13.72 13.73 12.75 15.73 12.75H19.77C21.78 12.75 22.75 13.73 22.75 15.73V19.77C22.75 21.77 21.77 22.75 19.77 22.75ZM15.73 14.25C14.55 14.25 14.25 14.55 14.25 15.73V19.77C14.25 20.95 14.55 21.25 15.73 21.25H19.77C20.95 21.25 21.25 20.95 21.25 19.77V15.73C21.25 14.55 20.95 14.25 19.77 14.25H15.73Z"/>',
        ],

        [
            'label' => 'Berkas',
            'only_admin' => false,
            'route' =>
                (int) env('SUPER_ADMIN_ID') === (int) auth()?->user()?->id
                    ? '#'
                    : route('files.index', ['file_type' => 'iki']),
            'mainRoute' => 'files.*',
            'children' => [
                [
                    'label' => 'AKIP',
                    'show' => (int) auth()->user()?->id === (int) env('SUPER_ADMIN_ID'),
                    'route' => ['full' => route('files.index', ['file_type' => 'akip']), 'sub' => 'files.akip.*'],
                ],
                [
                    'label' => 'IKI',
                    'route' => ['full' => route('files.index', ['file_type' => 'iki']), 'sub' => 'files.iki.*'],
                ],
            ],
            'iconPath' => '<path d="M18.289 22.75H5.70897C2.30897 22.75 2.12897 20.88 1.97897 19.37L1.57897 14.36C1.48897 13.39 1.76897 12.42 2.38897 11.64C3.12897 10.74 4.17897 10.25 5.30897 10.25H18.689C19.799 10.25 20.849 10.74 21.559 11.59L21.729 11.82C22.269 12.56 22.509 13.46 22.419 14.37L22.019 19.36C21.869 20.88 21.689 22.75 18.289 22.75ZM5.30897 11.75C4.63897 11.75 3.99897 12.05 3.57897 12.57L3.50897 12.64C3.18897 13.05 3.01897 13.63 3.07897 14.23L3.47897 19.24C3.61897 20.7 3.67897 21.25 5.70897 21.25H18.289C20.329 21.25 20.379 20.7 20.519 19.23L20.919 14.22C20.979 13.63 20.809 13.04 20.419 12.58L20.319 12.46C19.869 11.99 19.299 11.75 18.679 11.75H5.30897Z"/>
            <path d="M20.5 12.2213C20.09 12.2213 19.75 11.8813 19.75 11.4713V9.68125C19.75 6.70125 19.23 6.18125 16.25 6.18125H13.7C12.57 6.18125 12.18 5.78125 11.75 5.21125L10.46 3.50125C10.02 2.92125 9.92 2.78125 9.02 2.78125H7.75C4.77 2.78125 4.25 3.30125 4.25 6.28125V11.4313C4.25 11.8413 3.91 12.1813 3.5 12.1813C3.09 12.1813 2.75 11.8413 2.75 11.4313V6.28125C2.75 2.45125 3.92 1.28125 7.75 1.28125H9.03C10.57 1.28125 11.05 1.78125 11.67 2.60125L12.95 4.30125C13.22 4.66125 13.24 4.68125 13.71 4.68125H16.26C20.09 4.68125 21.26 5.85125 21.26 9.68125V11.4713C21.25 11.8813 20.91 12.2213 20.5 12.2213Z"/>
            <path d="M14.5697 17.75H9.42969C9.01969 17.75 8.67969 17.41 8.67969 17C8.67969 16.59 9.01969 16.25 9.42969 16.25H14.5697C14.9797 16.25 15.3197 16.59 15.3197 17C15.3197 17.41 14.9897 17.75 14.5697 17.75Z"/>
            ',
        ],

        [
            'label' => 'Pengguna',
            'route' => route('console.users'),
            'mainRoute' => 'users.*',
            'only_admin' => true,
            'iconPath' => '<path d="M18.0003 7.91002C17.9703 7.91002 17.9503 7.91002 17.9203 7.91002H17.8703C15.9803 7.85002 14.5703 6.39001 14.5703 4.59001C14.5703 2.75001 16.0703 1.26001 17.9003 1.26001C19.7303 1.26001 21.2303 2.76001 21.2303 4.59001C21.2203 6.40001 19.8103 7.86001 18.0103 7.92001C18.0103 7.91001 18.0103 7.91002 18.0003 7.91002ZM17.9003 2.75002C16.8903 2.75002 16.0703 3.57002 16.0703 4.58002C16.0703 5.57002 16.8403 6.37002 17.8303 6.41002C17.8403 6.40002 17.9203 6.40002 18.0103 6.41002C18.9803 6.36002 19.7303 5.56002 19.7403 4.58002C19.7403 3.57002 18.9203 2.75002 17.9003 2.75002Z"/>
            <path d="M18.0105 15.2801C17.6205 15.2801 17.2305 15.2501 16.8405 15.1801C16.4305 15.1101 16.1605 14.7201 16.2305 14.3101C16.3005 13.9001 16.6905 13.6301 17.1005 13.7001C18.3305 13.9101 19.6305 13.6802 20.5005 13.1002C20.9705 12.7902 21.2205 12.4001 21.2205 12.0101C21.2205 11.6201 20.9605 11.2401 20.5005 10.9301C19.6305 10.3501 18.3105 10.1201 17.0705 10.3401C16.6605 10.4201 16.2705 10.1401 16.2005 9.73015C16.1305 9.32015 16.4005 8.93015 16.8105 8.86015C18.4405 8.57015 20.1305 8.88014 21.3305 9.68014C22.2105 10.2701 22.7205 11.1101 22.7205 12.0101C22.7205 12.9001 22.2205 13.7502 21.3305 14.3502C20.4205 14.9502 19.2405 15.2801 18.0105 15.2801Z"/>
            <path d="M5.97047 7.91C5.96047 7.91 5.95047 7.91 5.95047 7.91C4.15047 7.85 2.74047 6.39 2.73047 4.59C2.73047 2.75 4.23047 1.25 6.06047 1.25C7.89047 1.25 9.39047 2.75 9.39047 4.58C9.39047 6.39 7.98047 7.85 6.18047 7.91L5.97047 7.16L6.04047 7.91C6.02047 7.91 5.99047 7.91 5.97047 7.91ZM6.07047 6.41C6.13047 6.41 6.18047 6.41 6.24047 6.42C7.13047 6.38 7.91047 5.58 7.91047 4.59C7.91047 3.58 7.09047 2.75999 6.08047 2.75999C5.07047 2.75999 4.25047 3.58 4.25047 4.59C4.25047 5.57 5.01047 6.36 5.98047 6.42C5.99047 6.41 6.03047 6.41 6.07047 6.41Z"/>
            <path d="M5.96 15.2801C4.73 15.2801 3.55 14.9502 2.64 14.3502C1.76 13.7602 1.25 12.9101 1.25 12.0101C1.25 11.1201 1.76 10.2701 2.64 9.68014C3.84 8.88014 5.53 8.57015 7.16 8.86015C7.57 8.93015 7.84 9.32015 7.77 9.73015C7.7 10.1401 7.31 10.4201 6.9 10.3401C5.66 10.1201 4.35 10.3501 3.47 10.9301C3 11.2401 2.75 11.6201 2.75 12.0101C2.75 12.4001 3.01 12.7902 3.47 13.1002C4.34 13.6802 5.64 13.9101 6.87 13.7001C7.28 13.6301 7.67 13.9101 7.74 14.3101C7.81 14.7201 7.54 15.1101 7.13 15.1801C6.74 15.2501 6.35 15.2801 5.96 15.2801Z"/>
            <path d="M12.0003 15.38C11.9703 15.38 11.9503 15.38 11.9203 15.38H11.8703C9.98031 15.32 8.57031 13.86 8.57031 12.06C8.57031 10.22 10.0703 8.72998 11.9003 8.72998C13.7303 8.72998 15.2303 10.23 15.2303 12.06C15.2203 13.87 13.8103 15.33 12.0103 15.39C12.0103 15.38 12.0103 15.38 12.0003 15.38ZM11.9003 10.22C10.8903 10.22 10.0703 11.04 10.0703 12.05C10.0703 13.04 10.8403 13.84 11.8303 13.88C11.8403 13.87 11.9203 13.87 12.0103 13.88C12.9803 13.83 13.7303 13.03 13.7403 12.05C13.7403 11.05 12.9203 10.22 11.9003 10.22Z"/>
            <path d="M11.9993 22.76C10.7993 22.76 9.5993 22.45 8.6693 21.82C7.7893 21.23 7.2793 20.39 7.2793 19.49C7.2793 18.6 7.7793 17.74 8.6693 17.15C10.5393 15.91 13.4693 15.91 15.3293 17.15C16.2093 17.74 16.7193 18.58 16.7193 19.48C16.7193 20.37 16.2193 21.23 15.3293 21.82C14.3993 22.44 13.1993 22.76 11.9993 22.76ZM9.4993 18.41C9.0293 18.72 8.7793 19.11 8.7793 19.5C8.7793 19.89 9.0393 20.27 9.4993 20.58C10.8493 21.49 13.1393 21.49 14.4893 20.58C14.9593 20.27 15.2093 19.88 15.2093 19.49C15.2093 19.1 14.9493 18.72 14.4893 18.41C13.1493 17.5 10.8593 17.51 9.4993 18.41Z"/>',
        ],
    ];
@endphp

@foreach ($menus as $menu)
    @if ($menu['children'] ?? false)
        <div>
            <a href="{{ $menu['route'] }}"
                class="{{ request()->fullUrlIs($menu['route']) || request()->routeIs($menu['mainRoute']) ? 'bg-slate-100' : 'transition-colors duration-300 hover:bg-slate-100' }} group/menuitem relative inline-flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 pointer-events-none" fill="currentColor"
                    viewBox="0 0 24 24">
                    {!! $menu['iconPath'] !!}"
                </svg>

                <span class="text-sm uppercase leading-tight tracking-wide">{{ $menu['label'] }}</span>
            </a>

            <ul
                class="relative flex flex-col gap-y-2 after:absolute after:left-4 after:h-[30%] after:w-px after:bg-slate-500">
                @if ((int) env('SUPER_ADMIN_ID') === (int) auth()?->user()?->id)
                    @foreach ($menu['children'] as $child)
                        @if ($child['show'] ?? true)
                            <li
                                class="inline-flex items-center gap-x-1.5 pl-4 before:inline-block before:h-px before:w-2 before:bg-slate-500 after:absolute after:h-1/2 after:w-px after:bg-slate-500 first:mt-2 first:after:translate-y-1/2 last:after:-translate-y-1/2 lg:flex-row lg:justify-start [&:not(:first-child):not(:last-child)]:after:h-full">
                                <a href="{{ $child['route']['full'] }}"
                                    class="{{ request()->fullUrlIs($child['route']['full']) || request()->routeIs($child['route']['sub']) ? 'bg-slate-100' : 'transition-colors duration-300 hover:bg-slate-100' }} inline-flex w-full items-center rounded-md py-2.5 pl-3 text-xs uppercase">{{ $child['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    @else
        @if ($menu['only_admin'] === ((int) env('SUPER_ADMIN_ID') === (int) auth()->user()->id))
            <a href="{{ $menu['route'] }}"
                class="{{ request()->fullUrlIs($menu['route']) || request()->routeIs($menu['mainRoute']) ? 'bg-slate-100' : 'transition-colors duration-300 hover:bg-slate-100' }} group/menuitem relative inline-flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 pointer-events-none" fill="currentColor"
                    viewBox="0 0 24 24">
                    {!! $menu['iconPath'] !!}"
                </svg>

                <span class="text-sm uppercase leading-tight tracking-wide">{{ $menu['label'] }}</span>
            </a>
        @endif
    @endif
@endforeach
