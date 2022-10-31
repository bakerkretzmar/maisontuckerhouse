<header class="flex items-center gap-2 p-2 font-proxima bg-gray-50">
    <a href="{{ home_url('/') }}">
        <img src="@asset('images/logo-og_wordmark-narrow.svg')" class="h-28" alt="{{ __('Tucker House logo', 'mth') }}" />
    </a>
    <div>
        <h4 class="text-2xl font-calluna text-red-900 italic">{{ $siteDescription }}</h4>
        @if (has_nav_menu('primary_navigation'))
            <nav class="flex uppercase font-semibold text-green-700" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class' => 'flex gap-4',
                    'echo' => false,
                ]) !!}
            </nav>
        @endif
    </div>
    <div>
        @foreach (pll_the_languages(['raw' => true]) as $locale)
            @unless ($locale['current_lang'])
                <a href="{{ $locale['url'] }}">{{ $locale['name'] }}</a>
            @endunless
        @endforeach
    </div>
</header>
