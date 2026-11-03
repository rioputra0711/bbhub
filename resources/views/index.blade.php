<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home — BBHub</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/navbar-init.tsx', 'resources/js/hero-init.tsx', 'resources/js/material-stack-init.tsx', 'resources/js/production-carousel-init.tsx'])
</head>
<body class="bg-white font-sans text-[#292821] antialiased min-h-screen relative">
        <!-- React Navbar container -->
        <div id="navbar-root" class="w-full"></div>

        <!-- React Hero container -->
        <div id="hero-root" class="w-full"></div>

        <!-- Benefits and rest of content -->
        <div class="flex flex-col items-start relative w-full">
            
            <!-- Core benefits -->
            <div class="bg-[#f7f5f0] flex gap-[58px] items-start px-[100px] py-[38px] w-full">
                <div class="flex flex-1 gap-[15px] items-start">
                    <div class="relative size-[28px] shrink-0">
                        <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/ruler.svg') }}" loading="lazy" decoding="async" />
                    </div>
                    <div class="flex flex-col gap-[6px] items-start leading-[1.5] flex-1">
                        <span class="font-medium text-[#292821] text-[15px]">Standardized specifications</span>
                        <span class="font-normal text-[#79766e] text-[12px]">Clear grades, dimensions, and moisture content.</span>
                    </div>
                </div>
                <div class="flex flex-1 gap-[15px] items-start">
                    <div class="relative size-[28px] shrink-0">
                        <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/shield-check.svg') }}" loading="lazy" decoding="async" />
                    </div>
                    <div class="flex flex-col gap-[6px] items-start leading-[1.5] flex-1">
                        <span class="font-medium text-[#292821] text-[15px]">Legal timber sourcing</span>
                        <span class="font-normal text-[#79766e] text-[12px]">Batch-level documents and traceability.</span>
                    </div>
                </div>
                <div class="flex flex-1 gap-[15px] items-start">
                    <div class="relative size-[28px] shrink-0">
                        <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/truck.svg') }}" loading="lazy" decoding="async" />
                    </div>
                    <div class="flex flex-col gap-[6px] items-start leading-[1.5] flex-1">
                        <span class="font-medium text-[#292821] text-[15px]">Connected shipping</span>
                        <span class="font-normal text-[#79766e] text-[12px]">Warehouse to destination coordination with Dexter.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories and stock -->
        <div class="lazy-section flex flex-col gap-[180px] items-start px-[72px] py-[80px] w-full bg-white">
            
            <!-- Categories / Know Your Material -->
            <div class="flex flex-col gap-[16px] items-start w-full bg-white">
                <div class="flex flex-col gap-[10px] items-start w-full">
                    <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">KNOW YOUR MATERIAL</span>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">One need. Many possibilities.</h2>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">Solid and processed wood for every production scale.</p>
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
            <div class="bg-[#f7f5f0] flex gap-[72px] items-center p-[72px] w-full">
                <div class="h-[470px] relative rounded-[4px] w-[580px] shrink-0 overflow-hidden">
                    <img alt="" class="absolute inset-0 max-w-none object-cover size-full" src="{{ asset('images/serat/story-inspection.png') }}" loading="lazy" decoding="async" />
                </div>
                <div class="flex flex-1 flex-col gap-[24px] items-start">
                    <div class="flex flex-col gap-[10px] items-start w-full">
                        <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">CLEAR SOURCING</span>
                        <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">Quality starts long before production.</h2>
                    </div>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                        We connect industrial needs with traceable raw materials. Every specification forms the basis of decisions, not just promises.
                    </p>
                    <div class="flex flex-col gap-[12px] w-full">
                        <div class="flex gap-[12px] items-start">
                            <div class="relative size-[17px] shrink-0 mt-0.5">
                                <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/check.svg') }}" />
                            </div>
                            <span class="font-normal leading-[1.5] text-[#292821] text-[14px]">Batch-level grade and moisture inspection</span>
                        </div>
                        <div class="flex gap-[12px] items-start">
                            <div class="relative size-[17px] shrink-0 mt-0.5">
                                <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/check.svg') }}" />
                            </div>
                            <span class="font-normal leading-[1.5] text-[#292821] text-[14px]">Accessible wood origin & legal documents</span>
                        </div>
                        <div class="flex gap-[12px] items-start">
                            <div class="relative size-[17px] shrink-0 mt-0.5">
                                <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/check.svg') }}" />
                            </div>
                            <span class="font-normal leading-[1.5] text-[#292821] text-[14px]">Measured dimensions, surfaces tailored to needs</span>
                        </div>
                    </div>
                    <a href="#" class="bg-white border border-[#e7e4dc] flex h-[46px] items-center justify-center px-[22px] rounded-[100px] text-[#292821] font-medium text-[14px] mt-2">
                        Discover BBHub standards
                    </a>
                </div>
            </div>

            <!-- Order journey -->
            <div class="flex flex-col gap-[40px] items-start px-[72px] py-[80px] w-full bg-white">
                <div class="flex flex-col gap-[10px] items-start w-full">
                    <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">FROM CATALOG TO PRODUCTION FLOOR</span>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">Simplified procurement.</h2>
                </div>

                <div class="flex gap-[32px] items-start w-full">
                    <div class="flex flex-1 flex-col gap-[18px] items-start">
                        <span class="font-normal leading-[1.5] text-[#a38355] text-[30px]">01</span>
                        <div class="bg-[#e7e4dc] h-px w-full"></div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[19px]">Find material</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Choose the right species, dimensions, and volume.</p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[18px] items-start">
                        <span class="font-normal leading-[1.5] text-[#a38355] text-[30px]">02</span>
                        <div class="bg-[#e7e4dc] h-px w-full"></div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[19px]">Confirm order</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Review pricing, address, and delivery estimates.</p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[18px] items-start">
                        <span class="font-normal leading-[1.5] text-[#a38355] text-[30px]">03</span>
                        <div class="bg-[#e7e4dc] h-px w-full"></div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[19px]">Warehouse ready</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Stock verification, picking, packing, and loading.</p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[18px] items-start">
                        <span class="font-normal leading-[1.5] text-[#a38355] text-[30px]">04</span>
                        <div class="bg-[#e7e4dc] h-px w-full"></div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[19px]">Receive & produce</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Track delivery and access order documents.</p>
                    </div>
                </div>
            </div>

            <!-- Dexter logistics -->
            <div class="bg-[#f7f5f0] flex gap-[64px] items-center p-[72px] w-full">
                <div class="flex flex-col gap-[24px] items-start w-[470px] shrink-0">
                    <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">SERAT. × DEXTER</span>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">Materials moving. Business keeps running.</h2>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                        Coordinate warehouse readiness, load volume, and delivery in a clear workflow. Access tracking via official Dexter links.
                    </p>
                    <div class="flex gap-[30px] font-normal leading-[1.5] text-[#292821] text-[13px] w-full">
                        <span>✓ Structured preparation</span>
                        <span>✓ Shipping documents</span>
                    </div>
                    <a href="#" class="bg-white border border-[#e7e4dc] flex gap-[10px] h-[46px] items-center justify-center px-[22px] rounded-[100px] text-[#292821] font-medium text-[14px]">
                        <span>About shipping</span>
                        <div class="relative size-[16px]">
                            <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/arrow-right-1.svg') }}" />
                        </div>
                    </a>
                </div>
                <div class="flex-1 h-[380px] relative rounded-[4px] overflow-hidden">
                    <img alt="" class="absolute inset-0 max-w-none object-cover size-full" src="{{ asset('images/serat/logistics-warehouse.png') }}" loading="lazy" decoding="async" />
                </div>
            </div>
        </div>

        <!-- Partnership and closing -->
        <div class="lazy-section flex flex-col items-start w-full bg-white">
            
            <!-- Custom request -->
            <div class="flex gap-[80px] items-start px-[100px] py-[72px] w-full">
                <div class="flex flex-1 flex-col gap-[20px] items-start">
                    <div class="bg-[#f7f5f0] px-[10px] py-[5px] rounded-[4px]">
                        <span class="font-medium leading-[1.5] text-[#79766e] text-[11px] tracking-wider uppercase">ADVANCED CAPABILITIES · RFQ</span>
                    </div>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">Custom sizes? Large volume? Let's talk.</h2>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                        Design your material requirements, from cut dimensions to supply schedules. The RFQ form helps our team understand your business needs.
                    </p>
                </div>
                <div class="flex flex-col gap-[18px] items-start justify-center w-[320px] shrink-0">
                    <a href="#" class="bg-[#a38355] border border-[#a38355] flex gap-[10px] h-[46px] items-center justify-center px-[22px] rounded-[100px] text-white font-medium text-[14px] w-full">
                        <span>Create quotation request</span>
                        <div class="relative size-[16px]">
                            <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/arrow-up-right-1.svg') }}" />
                        </div>
                    </a>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[12px]">Clear specifications. More focused discussions.</p>
                </div>
            </div>

            <!-- Business benefits -->
            <div class="bg-[#f7f5f0] flex flex-col gap-[38px] items-start px-[72px] py-[64px] w-full">
                <div class="flex flex-col gap-[10px] items-start w-full">
                    <span class="font-semibold leading-[1.5] text-[#a38355] text-[12px] tracking-wider uppercase">BUILT FOR YOUR WORKFLOW</span>
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">Not just buying wood.</h2>
                </div>
                <div class="flex gap-[48px] items-start w-full">
                    <div class="flex flex-1 flex-col gap-[16px] items-start">
                        <div class="relative size-[28px]">
                            <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/factory.svg') }}" />
                        </div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[20px]">For manufacturers</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Stock and specifications to support production planning.</p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[16px] items-start">
                        <div class="relative size-[28px]">
                            <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/folder-check.svg') }}" />
                        </div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[20px]">For procurement teams</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Orders, payments, invoices, and certificates in one account.</p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[16px] items-start">
                        <div class="relative size-[28px]">
                            <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/chart-no-axes-combined.svg') }}" />
                        </div>
                        <h3 class="font-medium leading-[1.5] text-[#292821] text-[20px]">For growing businesses</h3>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[14px]">Neat transaction history for future decisions.</p>
                    </div>
                </div>
            </div>

            <!-- Closing call to action -->
            <div class="flex items-center justify-between px-[100px] py-[72px] w-full bg-white">
                <div class="flex flex-col gap-[14px] items-start w-[760px]">
                    <h2 class="font-medium leading-[1.2] text-[#292821] text-[36px] tracking-[-1.1px]">Start with the right material.</h2>
                    <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">Find your next supply for your business with BBHub.</p>
                </div>
                <a href="#" class="bg-[#a38355] border border-[#a38355] flex gap-[10px] h-[46px] items-center justify-center px-[22px] rounded-[100px] text-white font-medium text-[14px]">
                    <span>Explore catalog</span>
                    <div class="relative size-[16px]">
                        <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/arrow-right.svg') }}" />
                    </div>
                </a>
            </div>

            <!-- Footer -->
            <footer class="bg-[#f7f5f0] flex flex-col gap-[32px] items-start px-[72px] py-[48px] w-full">
                <div class="flex gap-[90px] items-start w-full">
                    <div class="flex flex-col gap-[15px] items-start w-[360px] shrink-0">
                        <div class="flex gap-[9px] items-center">
                            <div class="h-[28px] relative w-[26px]">
                                <img alt="" class="absolute block inset-0 max-w-none size-full" src="{{ asset('images/serat/tree-deciduous.svg') }}" />
                            </div>
                            <span class="font-semibold leading-normal text-[#292821] text-[30px] tracking-[-1.5px]">BBHub</span>
                        </div>
                        <p class="font-normal leading-[1.5] text-[#79766e] text-[15px]">
                            The right raw material. Strong relationships. A timber ecosystem for your business growth.
                        </p>
                        <p class="font-normal leading-[1.5] text-[#292821] text-[13px]">
                            business@bbhub.id · +62 21 5088 2400
                        </p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[13px] items-start leading-[1.5] text-[13px]">
                        <span class="font-semibold text-[#292821]">Marketplace</span>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">All products</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Solid wood</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Processed wood</a>
                    </div>
                    <div class="flex flex-1 flex-col gap-[13px] items-start leading-[1.5] text-[13px]">
                        <span class="font-semibold text-[#292821]">For business</span>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Request quotation</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Dexter shipping</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Document center</a>
                    </div>
                    <div class="flex flex-1 flex-col gap-[13px] items-start leading-[1.5] text-[13px]">
                        <span class="font-semibold text-[#292821]">About BBHub</span>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Quality standards</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Sourcing & legality</a>
                        <a href="#" class="font-normal text-[#79766e] hover:text-[#292821]">Contact us</a>
                    </div>
                </div>
                <div class="bg-[#e7e4dc] h-px w-full"></div>
                <div class="flex font-normal items-start justify-between leading-[1.5] text-[#79766e] text-[12px] w-full">
                    <span>© 2026 BBHub · Timber supply, connected.</span>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-[#292821]">Privacy policy</a>
                        <a href="#" class="hover:text-[#292821]">Terms & conditions</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
