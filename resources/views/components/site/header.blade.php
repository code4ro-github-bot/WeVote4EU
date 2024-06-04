<header x-data="{ menuOpen: false }" class="relative z-40">
    <nav class="container flex justify-between max-w-6xl gap-4 py-4">
        <a href="{{ localizedRoute('home') }}" class="flex items-center gap-2" wire:navigate>
            <div class="sr-only">{{ config('app.name') }}</div>
            <x-icon-logo class="h-7 md:h-10" />
        </a>

        <div class="relative flex items-center gap-2">
            <div class="items-center hidden gap-2 md:flex">
                @foreach ($menuItems as $route => $label)
                    <x-navigation-item :route="$route" :label="$label" />
                @endforeach
            </div>

            <div x-data="{ langOpen: false }" x-on:click.away="langOpen = false">
                <button
                    class="flex items-center gap-1 px-3 py-2 font-light leading-tight rounded text-primary-900 hover:bg-primary-50 focus:bg-primary-100 focus:outline-none"
                    x-on:click="langOpen = !langOpen">
                    <x-ri-translate class="w-5 h-5" />
                    <span class="font-medium">{{ currentLocale()['nativeName'] }}</span>
                    <x-ri-arrow-drop-down-line class="w-5 h-5 ml-1 -mr-1" />
                </button>

                <div
                    class="absolute right-0 mt-2 origin-top-right bg-white shadow-xl sw-48"
                    x-show="langOpen"
                    x-collapse
                    x-cloak>
                    <ul class="p-2 columns-3 gap-x-1 gap-y-2">
                        @foreach ($alternateUrls as $locale => $item)
                            <li class="text-sm">
                                <a
                                    class="flex px-3 py-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
                                    hreflang="{{ $locale }}"
                                    href="{{ $item['url'] }}"
                                    wire:navigate>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="button" @@click="menuOpen = !menuOpen" class="md:hidden">
                <div class="sr-only">{{ __('app.menu') }}</div>
                <x-ri-menu-line x-show="!menuOpen" class="w-5 h-5" />
                <x-ri-close-line x-show="menuOpen" class="w-5 h-5" x-cloak />
            </button>
        </div>

        <div class="absolute inset-x-0 z-50 transition origin-top transform bg-white shadow-lg top-full lg:hidden"
            x-show="menuOpen" x-collapse x-cloak>
            <ul class="container flex flex-col py-4 text-gray-600 gap-y-1 md:py-8">
                @foreach ($menuItems as $route => $label)
                    <li><x-navigation-item mobile :route="$route" :label="$label" /></li>
                @endforeach
            </ul>
        </div>

    </nav>
</header>
