<div id="test" class="grid">

    <div
        class="flex items-center justify-center gap-4 px-6 py-4 text-white bg-blue-900 md:py-8">
        <x-icon-eu class="max-h-20 sm:max-h-24" />
        <div>
            <p class="text-xl sm:text-4xl">Parliament elections</p>
            <p class="text-2xl font-medium sm:text-5xl">6-9 June 2024</p>
        </div>

    </div>
    <div class="px-6 py-4 bg-blue-50">
        <div class="container">
            @if (!$country)
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach (app('countries') as $code => $country)
                        <x-decision-tree.choice
                            :href="localizedRoute('country', ['country' => Str::slug($country['name'])])">
                            <x-dynamic-component :component="'icon-flags.' . $code" class="w-8 h-8" />
                            <span>{{ $country['name'] }}</span>
                        </x-decision-tree.choice>
                    @endforeach
                </div>
            @else
                @if (filled($items))
                    <div x-data="{
                        current: null,
                        steps: @js($items->keys()),
                        isCurrent(step) {
                            return this.current === step;
                        },
                        goTo(step) {
                            this.current = step;
                        },
                        updateHash() {
                            const hash = location.hash.substring(1);
                    
                            this.goTo(this.steps.includes(hash) ? hash : this.steps[0]);
                        }
                    }"
                        x-on:popstate.window="updateHash"
                        x-init="$watch('current', (value) => {
                            const url = new URL(window.location.href);
                        
                            url.hash = value;
                            history.pushState(null, document.title, url.toString());
                        });
                        
                        updateHash();">

                        @foreach ($items as $id => $options)
                            <div
                                class="flex flex-col gap-2 py-2"
                                x-show="isCurrent(@js($id))"
                                x-cloak>
                                @if (filled($options))
                                    <h2 class="text-lg font-medium text-left text-gray-900 border-b">
                                        {!! __("country-{$country}.$id") !!}
                                    </h2>

                                    @foreach ($options as $option)
                                        <x-decision-tree.choice
                                            x-on:click="goTo({{ Js::from($option['target'])->toHtml() }})">
                                            {!! __("country-{$country}.{$option['label']}") !!}
                                        </x-decision-tree.choice>
                                    @endforeach
                                @else
                                    <div class="prose max-w-none">
                                        {!! __("country-{$country}.$id") !!}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

        </div>
    </div>
</div>
