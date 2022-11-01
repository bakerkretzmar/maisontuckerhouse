<header class="flex items-center gap-4 px-4 py-2 bg-gray-50">
    <a href="{{ home_url('/') }}">
        <img src="@asset('images/logo-og_wordmark-narrow.svg')" class="h-28" alt="{{ __('Tucker House logo', 'mth') }}" />
    </a>
    <div class="grow">
        <h4 class="text-2xl font-calluna text-red-900 italic">{{ $siteDescription }}</h4>
        @if (has_nav_menu('primary_navigation'))
            <nav class="flex uppercase font-semibold text-green-700" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class' => 'flex gap-4 [&>*]:py-2 [&>*]:whitespace-nowrap [&>.menu-item-has-children::after]:[content:"▾"] [&>.menu-item-has-children::after]:text-xl [&>.menu-item-has-children::after]:leading-none',
                    'echo' => false,
                ]) !!}
            </nav>
        @endif
    </div>
    <div class="flex flex-col items-end gap-2">
        @foreach (pll_the_languages(['raw' => true]) as $locale)
            @unless ($locale['current_lang'])
                <a href="{{ $locale['url'] }}" class="text-sm font-semibold text-gray-600">
                    {{ $locale['name'] }}
                </a>
            @endunless
        @endforeach
        <div class="flex gap-4">
            <a href="/donate" class="px-4 py-2 font-bold text-gray-50 bg-green-700 border-2 border-green-700 rounded-lg uppercase">
                {{ __('Donate', 'mth') }}
            </a>
            <a href="/contact" class="px-4 py-2 font-bold text-green-700 border-2 border-green-700 rounded-lg uppercase">
                {{ __('Contact', 'mth') }}
            </a>
        </div>
    </div>
</header>
