<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('site.catalog.meta_title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script type="application/json" id="bbhub-i18n">{!! json_encode(trans('site'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>

    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/navbar-init.tsx'])
</head>
@php
    $isId = app()->getLocale() === 'id';
    $decimal = $isId ? ',' : '.';
    $thousand = $isId ? '.' : ',';

    $money = fn (float $value): string => number_format($value, 0, $decimal, $thousand);

    $num = function (float $value, int $decimals = 1) use ($decimal, $thousand): string {
        $formatted = number_format($value, $decimals, $decimal, $thousand);

        return $decimals > 0
            ? rtrim(rtrim($formatted, '0'), $decimal)
            : $formatted;
    };

    $activeSpecies = $filters['species'];
    $activeGrades = $filters['grade'];
    $activeFilters = count($activeSpecies) + count($activeGrades)
        + ($filters['q'] !== '' ? 1 : 0)
        + ($filters['price_min'] !== null && $filters['price_min'] !== '' ? 1 : 0)
        + ($filters['price_max'] !== null && $filters['price_max'] !== '' ? 1 : 0)
        + ($filters['in_stock'] ? 1 : 0);
@endphp
<body class="bg-white font-sans text-[#292821] antialiased min-h-screen relative">
    <div id="navbar-root" class="w-full" data-locale="{{ app()->getLocale() }}" data-active="products" data-tone="dark"></div>

    <main class="lazy-section flex flex-col items-start w-full px-5 sm:px-10 lg:px-[72px] pt-24 sm:pt-28 lg:pt-32 pb-14 sm:pb-20">
        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-[12px] leading-[1.5] text-[#79766e]">
            <a href="{{ route('home') }}" class="hover:text-[#292821]">{{ __('site.catalog.breadcrumb_home') }}</a>
            <span aria-hidden="true" class="text-[#c9c5bb]">/</span>
            <span class="text-[#292821]">{{ __('site.catalog.breadcrumb_current') }}</span>
        </nav>

        <!-- Page header -->
        <div class="mt-6 flex flex-col gap-[10px] items-start w-full">
            <span class="font-semibold leading-[1.5] text-[#a38355] text-[11px] sm:text-[12px] tracking-wider uppercase">{{ __('site.catalog.eyebrow') }}</span>
            <h1 class="font-medium leading-[1.15] text-[#292821] text-[30px] sm:text-[34px] lg:text-[40px] tracking-[-1.2px]">{{ __('site.catalog.title') }}</h1>
            <p class="font-normal leading-[1.5] text-[#79766e] text-[14px] sm:text-[15px] max-w-[620px]">{{ __('site.catalog.subtitle') }}</p>
        </div>

        <!-- Filters + catalog -->
        <form method="GET" action="{{ route('products.index') }}" class="mt-8 lg:mt-10 flex flex-col lg:flex-row gap-8 lg:gap-10 items-start w-full">

            <!-- Sidebar -->
            <aside class="w-full lg:w-[264px] shrink-0 lg:sticky lg:top-28">
                <div class="w-full overflow-hidden rounded-[8px] border border-[#e7e4dc] bg-white">
                    <button
                        type="button"
                        id="catalog-filter-toggle"
                        aria-expanded="false"
                        aria-controls="catalog-filter-body"
                        class="flex w-full items-center justify-between gap-3 border-b border-[#e7e4dc] bg-[#FAFAFA] px-4 py-4 text-left lg:cursor-default"
                    >
                        <span class="flex flex-col">
                            <span class="flex items-center gap-2 text-[12px] font-semibold uppercase tracking-[0.1em] text-[#292821]">
                                {{ __('site.catalog.filter_title') }}
                                @if ($activeFilters > 0)
                                    <span class="inline-flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[#a38355] px-1 text-[10px] font-bold leading-none text-white">{{ $activeFilters }}</span>
                                @endif
                            </span>
                            <span class="mt-1 text-[11px] leading-[1.5] text-[#79766e]">{{ __('site.catalog.filter_subtitle') }}</span>
                        </span>
                        <svg id="catalog-filter-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="size-4 shrink-0 text-[#79766e] transition-transform duration-300 lg:hidden">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="catalog-filter-body" class="hidden lg:block">
                    <!-- Species -->
                    <div class="border-b border-[#e7e4dc] px-4 py-4">
                        <span class="mb-2.5 block text-[11px] font-semibold uppercase tracking-[0.09em] text-[#79766e]">{{ __('site.catalog.species') }}</span>
                        <div class="flex flex-col gap-1">
                            @foreach ($speciesOptions as $slug => $name)
                                <label class="flex cursor-pointer items-center gap-2.5 py-0.5 text-[13px] leading-[1.5] text-[#292821]">
                                    <input type="checkbox" name="species[]" value="{{ $slug }}" @checked(in_array($slug, $activeSpecies, true)) class="size-[14px] shrink-0 cursor-pointer accent-[#a38355]" />
                                    <span class="flex-1">{{ $name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Grade -->
                    @if ($gradeOptions->isNotEmpty())
                        <div class="border-b border-[#e7e4dc] px-4 py-4">
                            <span class="mb-2.5 block text-[11px] font-semibold uppercase tracking-[0.09em] text-[#79766e]">{{ __('site.catalog.grade') }}</span>
                            <div class="flex flex-col gap-1">
                                @foreach ($gradeOptions as $grade)
                                    <label class="flex cursor-pointer items-center gap-2.5 py-0.5 text-[13px] leading-[1.5] text-[#292821]">
                                        <input type="checkbox" name="grade[]" value="{{ $grade }}" @checked(in_array($grade, $activeGrades, true)) class="size-[14px] shrink-0 cursor-pointer accent-[#a38355]" />
                                        <span class="flex-1">{{ $grade }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Price -->
                    <div class="border-b border-[#e7e4dc] px-4 py-4">
                        <span class="mb-2.5 block text-[11px] font-semibold uppercase tracking-[0.09em] text-[#79766e]">{{ __('site.catalog.price') }}</span>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex flex-col gap-1">
                                <span class="text-[10px] uppercase tracking-[0.06em] text-[#a09889]">{{ __('site.catalog.price_min') }}</span>
                                <input type="number" name="price_min" min="0" step="100000" value="{{ $filters['price_min'] }}" class="h-[34px] w-full rounded-[6px] border border-[#e7e4dc] bg-white px-2 text-[12px] text-[#292821] focus:border-[#a38355] focus:outline-none" />
                            </label>
                            <label class="flex flex-col gap-1">
                                <span class="text-[10px] uppercase tracking-[0.06em] text-[#a09889]">{{ __('site.catalog.price_max') }}</span>
                                <input type="number" name="price_max" min="0" step="100000" value="{{ $filters['price_max'] }}" class="h-[34px] w-full rounded-[6px] border border-[#e7e4dc] bg-white px-2 text-[12px] text-[#292821] focus:border-[#a38355] focus:outline-none" />
                            </label>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="px-4 py-4">
                        <span class="mb-2.5 block text-[11px] font-semibold uppercase tracking-[0.09em] text-[#79766e]">{{ __('site.catalog.stock') }}</span>
                        <label class="flex cursor-pointer items-center gap-2.5 py-0.5 text-[13px] leading-[1.5] text-[#292821]">
                            <input type="checkbox" name="in_stock" value="1" @checked($filters['in_stock']) class="size-[14px] shrink-0 cursor-pointer accent-[#a38355]" />
                            <span class="flex-1">{{ __('site.catalog.in_stock') }}</span>
                        </label>
                    </div>

                    <div class="border-t border-[#e7e4dc] px-4 py-4">
                        <button type="submit" class="wood-sign !h-[44px] w-full !text-[13px]">{{ __('site.catalog.apply') }}</button>
                        @if ($activeFilters > 0)
                            <a href="{{ route('products.index') }}" class="mt-3 block text-center text-[12px] text-[#79766e] transition-colors hover:text-[#292821]">{{ __('site.catalog.reset') }}</a>
                        @endif
                    </div>
                    </div>
                </div>
            </aside>

            <!-- Results -->
            <section class="flex w-full min-w-0 flex-1 flex-col items-start">
                <!-- Search -->
                <div class="flex w-full flex-col gap-3 sm:flex-row">
                    <div class="flex flex-1 flex-col gap-1">
                        <label for="catalog-search" class="text-[11px] font-semibold uppercase tracking-[0.09em] text-[#79766e]">{{ __('site.catalog.search') }}</label>
                        <input
                            id="catalog-search"
                            type="search"
                            name="q"
                            value="{{ $filters['q'] }}"
                            placeholder="{{ __('site.catalog.search_placeholder') }}"
                            class="h-[46px] w-full rounded-[8px] border border-[#e7e4dc] bg-white px-4 text-[14px] text-[#292821] placeholder:text-[#a09889] focus:border-[#a38355] focus:outline-none"
                        />
                    </div>
                    <button type="submit" class="wood-sign mt-auto !h-[46px] w-full shrink-0 px-6 !text-[13px] sm:w-auto">{{ __('site.catalog.apply') }}</button>
                </div>

                <!-- Count + sort -->
                <div class="mt-6 flex w-full flex-wrap items-center justify-between gap-3 border-b border-[#e7e4dc] pb-3">
                    <span class="text-[12px] leading-[1.5] text-[#79766e]">
                        {{ __('site.catalog.count', ['count' => $products->total()]) }}
                        @if ($filters['q'] !== '')
                            · {{ __('site.catalog.results_for', ['term' => $filters['q']]) }}
                        @endif
                    </span>
                    <label class="flex items-center gap-2 text-[12px] text-[#79766e]">
                        <span>{{ __('site.catalog.sort') }}</span>
                        <select
                            name="sort"
                            onchange="this.form.submit()"
                            class="h-[34px] cursor-pointer rounded-[6px] border border-[#e7e4dc] bg-white px-2 text-[12px] font-medium text-[#292821] focus:border-[#a38355] focus:outline-none"
                        >
                            @foreach (['recommended', 'price_asc', 'price_desc', 'volume', 'newest'] as $sortKey)
                                <option value="{{ $sortKey }}" @selected($filters['sort'] === $sortKey)>{{ __('site.catalog.sort_'.$sortKey) }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <!-- Grid -->
                @if (count($items) > 0)
                    <div class="mt-5 grid w-full grid-cols-2 gap-3 sm:grid-cols-[repeat(auto-fill,minmax(200px,1fr))] sm:gap-4 lg:grid-cols-[repeat(auto-fill,minmax(240px,1fr))]">
                        @foreach ($items as $item)
                            @php
                                $detailUrl = \Illuminate\Support\Facades\Route::has('products.show')
                                    ? route('products.show', $item['id'])
                                    : '#';

                                $badge = $item['custom'] ? __('site.carousel.custom_order') : $item['grade'];

                                $locationParts = array_values(array_filter([$item['location'], $item['dimensions']]));
                                $locationLine = $locationParts !== [] ? implode(' · ', $locationParts) : null;

                                $stockParts = [__('site.carousel.volume_available', ['volume' => $num($item['volume'])])];

                                if ($item['moisture_min'] !== null && $item['moisture_max'] !== null) {
                                    $stockParts[] = __('site.carousel.moisture', [
                                        'range' => __('site.carousel.moisture_range', [
                                            'min' => $num($item['moisture_min'], 0),
                                            'max' => $num($item['moisture_max'], 0),
                                        ]),
                                    ]);
                                }

                                $stockLine = implode(' · ', $stockParts);
                            @endphp

                            <a
                                href="{{ $detailUrl }}"
                                class="group flex flex-col overflow-hidden rounded-xl border border-[#e7e4dc] bg-white shadow-xs transition-shadow duration-300 hover:shadow-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#a38355] focus-visible:ring-offset-2"
                            >
                                <div class="relative aspect-[4/3] w-full overflow-hidden rounded-t-xl bg-neutral-100">
                                    @if ($item['image'])
                                        <img
                                            src="{{ $item['image'] }}"
                                            alt="{{ __('site.carousel.image_alt', ['title' => $item['title']]) }}"
                                            loading="lazy"
                                            decoding="async"
                                            class="size-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        />
                                    @else
                                        <div class="flex size-full items-center justify-center bg-neutral-100 text-xs text-[#79766e]">{{ $item['species'] ?? $item['code'] }}</div>
                                    @endif

                                    @if ($badge)
                                        <span class="absolute top-2.5 left-2.5 rounded-md bg-white/95 px-2 py-0.5 text-[11px] font-medium text-[#292821] shadow-xs">{{ $badge }}</span>
                                    @endif
                                </div>

                                <div class="flex flex-1 flex-col justify-between p-3.5">
                                    <div class="space-y-1">
                                        <h3 class="line-clamp-1 text-sm font-semibold tracking-tight text-[#292821]">{{ $item['title'] }}</h3>
                                        @if ($item['location'])
                                            <p class="line-clamp-1 text-xs tracking-tight text-[#79766e]">{{ $item['location'] }}</p>
                                        @endif
                                        <p class="text-xs font-medium tracking-tight text-[#52694e]">{{ $stockLine }}</p>
                                    </div>

                                    <div class="mt-auto flex items-center justify-between border-t border-[#f0eee6] pt-2">
                                        <span class="text-[11px] tracking-tight text-[#79766e]">{{ $item['code'] }}</span>
                                        <span class="text-xs font-semibold tracking-tight text-[#292821]">
                                            @if ($item['price'] !== null)
                                                Rp {{ $money($item['price']) }} <span class="text-[11px] font-normal text-[#79766e]">{{ __('site.carousel.per_m3') }}</span>
                                            @else
                                                {{ __('site.carousel.custom_order') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <div class="mt-8 flex w-full flex-wrap items-center justify-between gap-3 border-t border-[#e7e4dc] pt-4">
                            <span class="text-[12px] text-[#79766e]">
                                {{ __('site.catalog.showing', [
                                    'from' => $products->firstItem(),
                                    'to' => $products->lastItem(),
                                    'total' => $products->total(),
                                ]) }}
                            </span>
                            <nav aria-label="Pagination" class="flex items-center gap-1">
                                @if ($products->onFirstPage())
                                    <span class="flex h-8 items-center rounded-[6px] border border-[#e7e4dc] px-2.5 text-[12px] text-[#c9c5bb]">{{ __('site.catalog.prev') }}</span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="flex h-8 items-center rounded-[6px] border border-[#e7e4dc] px-2.5 text-[12px] text-[#292821] transition-colors hover:border-[#a38355]">{{ __('site.catalog.prev') }}</a>
                                @endif

                                @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                                    @if ($page === $products->currentPage())
                                        <span class="flex h-8 min-w-8 items-center justify-center rounded-[6px] bg-[#292821] px-2 text-[12px] font-semibold text-white">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="flex h-8 min-w-8 items-center justify-center rounded-[6px] border border-[#e7e4dc] px-2 text-[12px] text-[#292821] transition-colors hover:border-[#a38355]">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="flex h-8 items-center rounded-[6px] border border-[#e7e4dc] px-2.5 text-[12px] text-[#292821] transition-colors hover:border-[#a38355]">{{ __('site.catalog.next') }}</a>
                                @else
                                    <span class="flex h-8 items-center rounded-[6px] border border-[#e7e4dc] px-2.5 text-[12px] text-[#c9c5bb]">{{ __('site.catalog.next') }}</span>
                                @endif
                            </nav>
                        </div>
                    @endif
                @else
                    <div class="mt-8 flex w-full flex-col items-start gap-2 rounded-[8px] border border-dashed border-[#e7e4dc] bg-[#FAFAFA] px-6 py-10">
                        <p class="text-[14px] font-medium text-[#292821]">{{ __('site.catalog.empty') }}</p>
                        <p class="text-[13px] text-[#79766e]">{{ __('site.catalog.empty_hint') }}</p>
                        <a href="{{ route('products.index') }}" class="mt-2 text-[13px] font-medium text-[#a38355] hover:text-[#292821]">{{ __('site.catalog.reset') }}</a>
                    </div>
                @endif

                <p class="mt-6 max-w-[680px] text-[11px] leading-[1.6] text-[#a09889]">{{ __('site.catalog.disclaimer') }}</p>
            </section>
        </form>
    </main>

    <script>
        (function () {
            var toggle = document.getElementById('catalog-filter-toggle');
            var body = document.getElementById('catalog-filter-body');
            var chevron = document.getElementById('catalog-filter-chevron');

            if (!toggle || !body) {
                return;
            }

            toggle.addEventListener('click', function () {
                if (window.matchMedia('(min-width: 1024px)').matches) {
                    return;
                }

                var open = !body.classList.toggle('hidden');

                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');

                if (chevron) {
                    chevron.style.transform = open ? 'rotate(180deg)' : '';
                }
            });
        })();
    </script>
</body>
</html>
