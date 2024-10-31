<div class="fixed inset-y-0 left-0 w-64 max-lg:hidden bg-white">
    <nav class="flex h-full min-h-0 flex-col">

        {{-- header --}}
        <div class="flex items-center justify-center gap-x-2 border-b border-r border-slate-950/10 py-4 px-2">
            <span class="select-none truncate text-lg font-semibold leading-tight tracking-wide">SI-AKIP
                BRIDA</span>
        </div>

        {{-- menu --}}
        <div role="menu"
            class="flex flex-1 flex-col overflow-y-auto py-3.5 px-2 gap-1.5 border-r border-r-slate-950/10">
            <x-sidebar.menu />
        </div>

        {{-- user auth --}}
        <div class="relative flex min-w-0 flex-col border-t border-r border-slate-950/10 p-2">
            <button class="flex flex-row items-center gap-3 rounded-lg p-2 focus-within:bg-slate-100 hover:bg-slate-100"
                type="button">
                <span class="size-12 inline-grid shrink-0 rounded-lg p-1.5 align-middle">
                    <img class="size-full" src="{{ asset('assets/avatars/avatar-' . rand(1, 5) . '.png') }}"
                        alt="Avatar User">
                </span>
                <div class="min-w-0 grow text-left">
                    <span class="block truncate text-sm/5 font-normal">{{ auth()->user()?->name }}</span>
                    <span
                        class="block truncate text-xs/5 font-normal text-gray-500">{{ auth()->user()?->username }}</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-5 pointer-events-none text-gray-600">
                    <path d="m6.293 13.293 1.414 1.414L12 10.414l4.293 4.293 1.414-1.414L12 7.586z"></path>
                </svg>
            </button>
            <div class="w-full uk-drop uk-dropdown" uk-dropdown="mode: click">
                <ul class="uk-dropdown-nav uk-nav">
                    <li class="uk-nav-divider"></li>
                    <li>
                        <form class="p-1" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="inline-flex w-full items-center gap-2 rounded-sm p-2 hover:bg-slate-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="size-5 pointer-events-none" viewBox="0 0 24 24">
                                    <path
                                        d="M17.4409 15.3699C17.2509 15.3699 17.0609 15.2999 16.9109 15.1499C16.6209 14.8599 16.6209 14.3799 16.9109 14.0899L18.9409 12.0599L16.9109 10.0299C16.6209 9.73994 16.6209 9.25994 16.9109 8.96994C17.2009 8.67994 17.6809 8.67994 17.9709 8.96994L20.5309 11.5299C20.8209 11.8199 20.8209 12.2999 20.5309 12.5899L17.9709 15.1499C17.8209 15.2999 17.6309 15.3699 17.4409 15.3699Z" />
                                    <path
                                        d="M19.9298 12.8101H9.75977C9.34977 12.8101 9.00977 12.4701 9.00977 12.0601C9.00977 11.6501 9.34977 11.3101 9.75977 11.3101H19.9298C20.3398 11.3101 20.6798 11.6501 20.6798 12.0601C20.6798 12.4701 20.3398 12.8101 19.9298 12.8101Z" />
                                    <path
                                        d="M11.7598 20.75C6.60977 20.75 3.00977 17.15 3.00977 12C3.00977 6.85 6.60977 3.25 11.7598 3.25C12.1698 3.25 12.5098 3.59 12.5098 4C12.5098 4.41 12.1698 4.75 11.7598 4.75C7.48977 4.75 4.50977 7.73 4.50977 12C4.50977 16.27 7.48977 19.25 11.7598 19.25C12.1698 19.25 12.5098 19.59 12.5098 20C12.5098 20.41 12.1698 20.75 11.7598 20.75Z" />
                                </svg>
                                <span class="truncate text-sm/5">Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
