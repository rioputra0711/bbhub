<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('site.meta.title') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script type="application/json" id="bbhub-i18n">{!! json_encode(trans('site'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>

    <script type="application/json" id="bbhub-products">{!! json_encode($products, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>

    <!-- Styles -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/navbar-init.tsx', 'resources/js/hero-init.tsx', 'resources/js/material-stack-init.tsx', 'resources/js/production-carousel-init.tsx'])
</head>
<body class="bg-white font-sans text-[#292821] antialiased min-h-screen relative">
        <!-- React Navbar container -->
        <div id="navbar-root" class="w-full" data-locale="{{ app()->getLocale() }}" data-active="home" data-tone="light"></div>

        <!-- React Hero container -->
        <div id="hero-root" class="w-full"></div>

        <!-- Benefits and rest of content -->
        <div class="flex flex-col items-start relative w-full">

            <!-- Core benefits -->
            <div class="bg-[#FAFAFA] grid grid-cols-1 md:grid-cols-3 items-stretch px-5 sm:px-10 lg:px-[72px] py-[16px] lg:py-[20px] w-full">
                <div class="flex gap-[10px] items-center py-[10px] md:py-[6px] md:pr-[24px]">
                    <img alt="" class="block size-[18px] shrink-0" src="{{ asset('images/serat/ruler.svg') }}" loading="lazy" decoding="async" />
                    <div class="flex flex-col leading-[1.35]">
                        <span class="font-semibold text-[#292821] text-[13px]">{{ __('site.bar.spec_title') }}</span>
                        <span class="font-normal text-[#79766e] text-[12px]">{{ __('site.bar.spec_desc') }}</span>
                    </div>
                </div>
                <div class="flex gap-[10px] items-center border-[#e7e4dc] border-t md:border-t-0 md:border-l py-[10px] md:py-[6px] md:px-[24px]">
                    <img alt="" class="block size-[18px] shrink-0" src="{{ asset('images/serat/shield-check.svg') }}" loading="lazy" decoding="async" />
                    <div class="flex flex-col leading-[1.35]">
                        <span class="font-semibold text-[#292821] text-[13px]">{{ __('site.bar.legal_title') }}</span>
                        <span class="font-normal text-[#79766e] text-[12px]">{{ __('site.bar.legal_desc') }}</span>
                    </div>
                </div>
                <div class="flex gap-[10px] items-center border-[#e7e4dc] border-t md:border-t-0 md:border-l py-[10px] md:py-[6px] md:pl-[24px]">
                    <img alt="" class="block size-[18px] shrink-0" src="{{ asset('images/serat/truck.svg') }}" loading="lazy" decoding="async" />
                    <div class="flex flex-col leading-[1.35]">
                        <span class="font-semibold text-[#292821] text-[13px]">{{ __('site.bar.ship_title') }}</span>
                        <span class="font-normal text-[#79766e] text-[12px]">{{ __('site.bar.ship_desc') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories and stock -->
        <div class="lazy-section flex flex-col gap-16 sm:gap-24 lg:gap-[140px] items-start px-5 sm:px-10 lg:px-[72px] pt-14 sm:pt-20 pb-14 sm:pb-20 w-full bg-white">

            <!-- Categories / Know Your Material -->
            <div class="flex flex-col gap-[16px] items-start w-full bg-white">
                <div class="flex flex-col gap-[10px] items-start w-full">
                    <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">{{ __('site.material.eyebrow') }}</span>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[28px] sm:text-[32px] lg:text-[36px] tracking-[-1.1px]">{{ __('site.material.title') }}</h2>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">{{ __('site.material.subtitle') }}</p>
                </div>

                <!-- React CardStack Interactive 3D component -->
                <div id="material-stack-root" class="w-full"></div>
            </div>

            <!-- Featured stock (React Carousel Cards) -->
            <div id="production-carousel-root" class="w-full"></div>
        </div>

        <!-- Sourcing, process and logistics -->
        <div class="lazy-section flex flex-col items-start w-full">

            <!-- Quality story -->
            <div class="bg-[#FAFAFA] flex flex-col lg:flex-row gap-8 lg:gap-[72px] items-center p-5 sm:p-10 lg:p-[72px] w-full">
                <div class="h-[280px] sm:h-[360px] lg:h-[470px] relative rounded-[24px] lg:rounded-[32px] w-full lg:w-[580px] shrink-0 overflow-hidden">
                    <img alt="{{ __('site.alt.story') }}" class="absolute inset-0 max-w-none object-cover size-full" src="{{ asset('images/serat/story-inspection.png') }}" loading="lazy" decoding="async" />
                </div>
                <div class="flex flex-1 flex-col gap-[24px] items-start">
                    <div class="flex flex-col gap-[10px] items-start w-full">
                        <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">{{ __('site.sourcing.eyebrow') }}</span>
                        <h2 class="font-medium leading-[1.2] text-[#292821] text-[28px] sm:text-[32px] lg:text-[36px] tracking-[-1.1px]">{{ __('site.sourcing.title') }}</h2>
                    </div>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                        {{ __('site.sourcing.description') }}
                    </p>
                    <div class="flex flex-col gap-[12px] w-full">
                        <div class="flex gap-[12px] items-start">
                            <div class="relative size-[17px] shrink-0 mt-0.5">
                                <svg aria-hidden="true" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" class="absolute block inset-0 size-full text-[#292821]"><path d="M255 85H150a65 65 0 0 0-65 65v210a65 65 0 0 0 65 65h210a65 65 0 0 0 65-65V255"/><path d="M170 210l85 85 193-193"/></svg>
                            </div>
                            <span class="font-normal leading-[1.5] text-[#292821] text-[14px]">{{ __('site.sourcing.bullet_1') }}</span>
                        </div>
                        <div class="flex gap-[12px] items-start">
                            <div class="relative size-[17px] shrink-0 mt-0.5">
                                <svg aria-hidden="true" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" class="absolute block inset-0 size-full text-[#292821]"><path d="M255 85H150a65 65 0 0 0-65 65v210a65 65 0 0 0 65 65h210a65 65 0 0 0 65-65V255"/><path d="M170 210l85 85 193-193"/></svg>
                            </div>
                            <span class="font-normal leading-[1.5] text-[#292821] text-[14px]">{{ __('site.sourcing.bullet_2') }}</span>
                        </div>
                        <div class="flex gap-[12px] items-start">
                            <div class="relative size-[17px] shrink-0 mt-0.5">
                                <svg aria-hidden="true" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" class="absolute block inset-0 size-full text-[#292821]"><path d="M255 85H150a65 65 0 0 0-65 65v210a65 65 0 0 0 65 65h210a65 65 0 0 0 65-65V255"/><path d="M170 210l85 85 193-193"/></svg>
                            </div>
                            <span class="font-normal leading-[1.5] text-[#292821] text-[14px]">{{ __('site.sourcing.bullet_3') }}</span>
                        </div>
                    </div>
                    <a href="#" class="bg-white border border-[#e7e4dc] flex h-[46px] w-full sm:w-auto items-center justify-center px-[22px] rounded-[100px] text-[#292821] font-medium text-[14px] mt-2">
                        {{ __('site.sourcing.cta') }}
                    </a>
                </div>
            </div>

            <!-- Order journey -->
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-[56px] items-start lg:items-center px-5 sm:px-10 lg:px-[72px] py-10 lg:py-[40px] w-full bg-white">
                <div class="flex flex-col gap-[8px] items-start shrink-0 w-full lg:w-[260px]">
                    <span class="font-semibold leading-[1.4] text-[#a38355] text-[11px] tracking-[0.12em] uppercase">{{ __('site.journey.eyebrow') }}</span>
                    <h2 class="font-semibold leading-[1.15] text-[#292821] text-[24px] sm:text-[28px] tracking-[-0.6px]">{{ __('site.journey.title') }}</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[24px] w-full lg:flex-1">
                    <div class="flex flex-col gap-[6px] items-start border-t border-[#e7e4dc] pt-[16px]">
                        <span class="font-semibold leading-none text-[#a38355] text-[12px] tabular-nums">01</span>
                        <h3 class="font-semibold leading-[1.3] text-[#292821] text-[15px]">{{ __('site.journey.step_1_title') }}</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.journey.step_1_desc') }}</p>
                    </div>
                    <div class="flex flex-col gap-[6px] items-start border-t border-[#e7e4dc] pt-[16px]">
                        <span class="font-semibold leading-none text-[#a38355] text-[12px] tabular-nums">02</span>
                        <h3 class="font-semibold leading-[1.3] text-[#292821] text-[15px]">{{ __('site.journey.step_2_title') }}</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.journey.step_2_desc') }}</p>
                    </div>
                    <div class="flex flex-col gap-[6px] items-start border-t border-[#e7e4dc] pt-[16px]">
                        <span class="font-semibold leading-none text-[#a38355] text-[12px] tabular-nums">03</span>
                        <h3 class="font-semibold leading-[1.3] text-[#292821] text-[15px]">{{ __('site.journey.step_3_title') }}</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.journey.step_3_desc') }}</p>
                    </div>
                    <div class="flex flex-col gap-[6px] items-start border-t border-[#e7e4dc] pt-[16px]">
                        <span class="font-semibold leading-none text-[#a38355] text-[12px] tabular-nums">04</span>
                        <h3 class="font-semibold leading-[1.3] text-[#292821] text-[15px]">{{ __('site.journey.step_4_title') }}</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.journey.step_4_desc') }}</p>
                    </div>
                </div>
            </div>

            <!-- Dexter logistics -->
            <div class="bg-[#292821] relative flex items-center min-h-[420px] lg:min-h-[560px] overflow-hidden px-5 sm:px-10 py-14 lg:p-[72px] w-full">
                <img alt="{{ __('site.alt.logistics') }}" aria-hidden="true" src="{{ asset('images/serat/logistics-warehouse.png') }}" loading="lazy" decoding="async" class="absolute inset-0 size-full object-cover scale-110 blur-[3px]" />
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-black/10"></div>
                <div class="relative z-10 flex flex-col gap-[24px] items-start w-full max-w-[470px] shrink-0">
                    <span class="font-semibold leading-[1.5] text-[#d9bf94] text-[12px] tracking-wider uppercase">{{ __('site.logistics.eyebrow') }}</span>
                    <h2 class="font-medium leading-[1.2] text-white text-[28px] sm:text-[32px] lg:text-[36px] tracking-[-1.1px]">{{ __('site.logistics.title') }}</h2>
                    <p class="font-normal leading-[1.5] text-white/85 text-[15px]">
                        {{ __('site.logistics.description') }}
                    </p>
                    <div class="flex flex-wrap gap-x-[30px] gap-y-2 font-normal leading-[1.5] text-white text-[13px] w-full">
                        <span class="flex items-center gap-[8px]"><svg aria-hidden="true" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" class="size-[16px] shrink-0 text-white"><path d="M255 85H150a65 65 0 0 0-65 65v210a65 65 0 0 0 65 65h210a65 65 0 0 0 65-65V255"/><path d="M170 210l85 85 193-193"/></svg>{{ __('site.logistics.check_1') }}</span>
                        <span class="flex items-center gap-[8px]"><svg aria-hidden="true" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" class="size-[16px] shrink-0 text-white"><path d="M255 85H150a65 65 0 0 0-65 65v210a65 65 0 0 0 65 65h210a65 65 0 0 0 65-65V255"/><path d="M170 210l85 85 193-193"/></svg>{{ __('site.logistics.check_2') }}</span>
                    </div>
                    <a href="#" class="bg-white border border-[#e7e4dc] flex gap-[10px] h-[46px] items-center justify-center px-[22px] rounded-[100px] text-[#292821] font-medium text-[14px]">
                        <span>{{ __('site.logistics.cta') }}</span>
                        <div class="relative size-[16px]">
                            <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/arrow-right-1.svg') }}" />
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Partnership and closing -->
        <div class="lazy-section flex flex-col items-start w-full bg-white">

            <!-- Custom request -->
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-[80px] items-start px-5 sm:px-10 lg:px-[100px] py-12 lg:py-[72px] w-full">
                <div class="flex flex-1 flex-col gap-[20px] items-start">
                    <div class="bg-[#FAFAFA] px-[10px] py-[5px] rounded-[4px]">
                        <span class="font-medium leading-[1.5] text-[#79766e] text-[11px] tracking-wider uppercase">{{ __('site.rfq.eyebrow') }}</span>
                    </div>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[28px] sm:text-[32px] lg:text-[36px] tracking-[-1.1px]">{{ __('site.rfq.title') }}</h2>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                        {{ __('site.rfq.description') }}
                    </p>
                </div>
                <div class="flex flex-col gap-[18px] items-start justify-center shrink-0 w-full lg:w-[calc((100%-696px)/3)]">
                    <a href="#" class="wood-sign w-full">
                        <span>{{ __('site.rfq.cta') }}</span>
                    </a>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[12px] lg:whitespace-nowrap">{{ __('site.rfq.note') }}</p>
                </div>
            </div>

            <!-- Business benefits -->
            <div class="bg-[#FAFAFA] flex flex-col lg:flex-row items-start gap-6 lg:gap-[80px] px-5 sm:px-10 lg:px-[100px] pt-[12px] pb-[8px] w-full">
                <div class="flex flex-col gap-0 items-start shrink-0 w-full lg:w-[360px]">
                    <span class="font-semibold leading-[1.4] text-[#a38355] text-[11px] tracking-wider uppercase lg:whitespace-nowrap">{{ __('site.workflow.eyebrow') }}</span>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[24px] sm:text-[28px] tracking-[-0.8px] lg:whitespace-nowrap">{{ __('site.workflow.title') }}</h2>
                </div>
                <div class="grid w-full lg:flex-1 grid-cols-1 sm:grid-cols-3 gap-5 sm:gap-[28px] items-start">
                    <div class="flex flex-col gap-[6px] items-start border-t sm:border-t-0 sm:border-l border-[#e7e4dc] pt-4 sm:pt-0 sm:pl-[24px]">
                        <div class="flex items-center gap-[8px]">
                            <div class="relative size-[16px] shrink-0">
                                <img alt="" class="absolute block inset-0 max-w-none size-full brightness-0" src="{{ asset('images/serat/factory.svg') }}" />
                            </div>
                            <h3 class="font-semibold leading-[1.4] text-[#292821] text-[15px]">{{ __('site.workflow.item_1_title') }}</h3>
                        </div>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.workflow.item_1_desc') }}</p>
                    </div>
                    <div class="flex flex-col gap-[6px] items-start border-t sm:border-t-0 sm:border-l border-[#e7e4dc] pt-4 sm:pt-0 sm:pl-[24px]">
                        <div class="flex items-center gap-[8px]">
                            <div class="relative size-[16px] shrink-0">
                                <img alt="" class="absolute block inset-0 max-w-none size-full brightness-0" src="{{ asset('images/serat/folder-check.svg') }}" />
                            </div>
                            <h3 class="font-semibold leading-[1.4] text-[#292821] text-[15px]">{{ __('site.workflow.item_2_title') }}</h3>
                        </div>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.workflow.item_2_desc') }}</p>
                    </div>
                    <div class="flex flex-col gap-[6px] items-start border-t sm:border-t-0 sm:border-l border-[#e7e4dc] pt-4 sm:pt-0 sm:pl-[24px]">
                        <div class="flex items-center gap-[8px]">
                            <div class="relative size-[16px] shrink-0">
                                <img alt="" class="absolute block inset-0 max-w-none size-full brightness-0" src="{{ asset('images/serat/chart-no-axes-combined.svg') }}" />
                            </div>
                            <h3 class="font-semibold leading-[1.4] text-[#292821] text-[15px]">{{ __('site.workflow.item_3_title') }}</h3>
                        </div>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[13px]">{{ __('site.workflow.item_3_desc') }}</p>
                    </div>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="bg-white flex flex-col lg:flex-row items-center justify-center gap-10 lg:gap-[64px] px-5 sm:px-10 lg:px-[72px] py-12 lg:py-[64px] w-full">
                <div class="flex flex-col gap-[16px] items-start max-w-[520px] w-full">
                    <h2 class="font-semibold leading-[1.2] text-[#292821] text-[26px] sm:text-[32px] tracking-[-0.8px]">{{ __('site.newsletter.title') }}</h2>
                    <p class="font-normal leading-[1.6] text-[#79766e] text-[15px]">
                        {{ __('site.newsletter.description') }}
                    </p>
                    <form action="#" method="POST" onsubmit="event.preventDefault()" class="flex w-full flex-wrap gap-[12px] items-center mt-[8px]">
                        <input type="email" required placeholder="{{ __('site.newsletter.placeholder') }}" class="h-[46px] w-full sm:w-[300px] rounded-[8px] border border-[#e7e4dc] bg-white px-[16px] text-[14px] text-[#292821] placeholder:text-[#79766e] focus:outline-none focus:border-[#a38355]" />
                        <button type="submit" class="h-[46px] w-full sm:w-auto rounded-[8px] bg-[#292821] px-[22px] text-[14px] font-medium text-white shadow-md transition-colors hover:bg-[#a38355]">{{ __('site.newsletter.cta') }}</button>
                    </form>
                </div>
                <div class="relative w-full max-w-[420px] h-[240px] sm:h-[280px] shrink-0">
                    <div class="absolute inset-0 translate-x-[12px] -translate-y-[14px] rotate-[3deg] rounded-[12px] bg-[#e7e4dc]"></div>
                    <img src="{{ asset('images/timber-planks.jpg') }}" alt="{{ __('site.alt.newsletter') }}" loading="lazy" decoding="async" class="absolute inset-0 size-full rounded-[12px] object-cover -rotate-[2deg] shadow-lg" />
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-[#FAFAFA] flex flex-col gap-[40px] lg:gap-[48px] items-start px-5 sm:px-10 lg:px-[72px] py-12 lg:py-[64px] w-full">
                <div class="bg-[#e7e4dc] h-px w-full"></div>

                <div class="flex flex-col md:flex-row flex-wrap gap-10 md:gap-[60px] lg:gap-[90px] items-start w-full">
                    <div class="flex flex-col gap-[15px] items-start w-full md:w-[360px] shrink-0">
                        <div class="flex gap-[9px] items-center">
                            <div class="h-[28px] relative w-[26px]">
                                <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/tree-deciduous.svg') }}" />
                            </div>
                            <span class="font-semibold leading-normal text-[#292821] text-[30px] tracking-[-1.5px]">BBHub</span>
                        </div>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                            {{ __('site.footer.description') }}
                        </p>
                        <p class="font-normal leading-[1.5] text-[#292821] text-[13px]">
                            business@bbhub.id · +62 21 5088 2400
                        </p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[13px] items-start leading-[1.5] text-[13px]">
                        <span class="font-semibold text-[#292821]">{{ __('site.footer.marketplace') }}</span>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.all_products') }}</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.solid_wood') }}</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.processed_wood') }}</a>
                    </div>
                    <div class="flex flex-1 flex-col gap-[13px] items-start leading-[1.5] text-[13px]">
                        <span class="font-semibold text-[#292821]">{{ __('site.footer.business') }}</span>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.request_quotation') }}</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.dexter_shipping') }}</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.document_center') }}</a>
                    </div>
                    <div class="flex flex-1 flex-col gap-[13px] items-start leading-[1.5] text-[13px]">
                        <span class="font-semibold text-[#292821]">{{ __('site.footer.about') }}</span>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.quality') }}</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.legality') }}</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">{{ __('site.footer.contact') }}</a>
                    </div>
                </div>
                <div class="bg-[#e7e4dc] h-px w-full"></div>
                <div class="flex flex-col sm:flex-row font-normal items-start sm:items-center justify-between gap-3 leading-[1.5] text-[#79766e] text-[12px] w-full">
                    <span>{{ __('site.footer.copyright') }}</span>
                    <div class="flex items-center gap-4 sm:gap-6">
                        <div class="flex items-center gap-2 sm:hidden">
                            <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'font-semibold text-[#292821]' : 'hover:text-[#292821]' }}">EN</a>
                            <span class="text-[#c9c5bb]">/</span>
                            <a href="{{ route('language.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'font-semibold text-[#292821]' : 'hover:text-[#292821]' }}">ID</a>
                        </div>
                        <a href="#" class="hover:text-[#292821]">{{ __('site.footer.privacy') }}</a>
                        <a href="#" class="hover:text-[#292821]">{{ __('site.footer.terms') }}</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
