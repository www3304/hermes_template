<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Sneakers | Hermès Malaysia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
        body {
            font-family: 'Inter', "Helvetica Neue", Helvetica, sans-serif;
            -webkit-font-smoothing: antialiased;
            color: #111;
        }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
        .drawer-scroll::-webkit-scrollbar { width: 4px; }
        .drawer-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; }
        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button { display: none; }
    </style>
</head>
<body class="bg-[#fbfbf9] overflow-x-hidden"
      x-data="{ isFilterOpen: false, activeMenu: null, isCartPopupOpen: false, isMobileMenuOpen: false, isSearchOpen: false, searchInput: '' }"
      @add-to-cart.window="isCartPopupOpen = true; setTimeout(() => isCartPopupOpen = false, 4000)"
      :class="{'overflow-hidden': isFilterOpen || activeMenu || isMobileMenuOpen || isSearchOpen}">

    <div x-show="isFilterOpen || activeMenu" 
         x-transition.opacity.duration.300ms
         class="fixed inset-0 bg-black/10 z-40 hidden lg:block"
         @click="isFilterOpen = false; activeMenu = null" style="display: none;"></div>

    <header class="fixed top-0 w-full z-50 bg-[#fbfbf9] border-b border-gray-200">
        
        <div class="hidden lg:flex max-w-[1800px] mx-auto px-8 pt-6 pb-4 justify-between items-center">
            
            <div class="w-1/3 flex items-end" x-data="{ searchFocused: false }">
                <div class="flex items-center transition-all duration-300 border-b" :class="searchFocused ? 'border-black w-64' : 'border-black/50 w-48'">
                    <svg class="w-4 h-4 text-black mb-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="search" placeholder="Search" 
                           x-model="searchInput" 
                           @keydown.enter="if(searchInput) window.location.href='index.php?q=' + encodeURIComponent(searchInput)"
                           @focus="searchFocused = true" @blur="searchFocused = false" 
                           class="bg-transparent w-full outline-none text-[12px] text-black placeholder-gray-500 pb-1">
                </div>
            </div>
            
            <div class="w-1/3 flex flex-col items-center justify-center cursor-pointer">
                <a href="index.php"><h1 class="text-3xl tracking-[0.1em] font-medium uppercase leading-none text-black">HERMÈS</h1></a>
                <span class="text-[10px] tracking-[0.3em] font-medium mt-1 text-black">PARIS</span>
            </div>

            <div class="w-1/3 flex justify-end space-x-8 text-xs font-medium tracking-wide text-black">
                <a href="account.php" class="flex items-center space-x-2 hover:text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Account</span>
                </a>
                
                <div class="relative flex items-center">
                    <a href="cart.php" class="flex items-center space-x-2 hover:text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Cart</span>
                    </a>

                    <div x-show="isCartPopupOpen" 
                         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute top-[150%] right-0 w-[320px] bg-white shadow-[0_10px_40px_rgba(0,0,0,0.1)] p-8 text-center z-50 border border-gray-100" 
                         style="display: none;">
                        <button @click="isCartPopupOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-black">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <div class="flex justify-center mb-4">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <p class="text-[13px] text-gray-800 mb-6">This item has been added to the cart</p>
                        <a href="cart.php" class="block w-full bg-black text-white text-[11px] font-bold tracking-[0.15em] uppercase py-3.5 hover:bg-gray-800 transition-colors">
                            View Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="hidden lg:flex max-w-[1400px] mx-auto px-8 py-4 relative justify-center space-x-10 text-[10px] font-bold tracking-[0.15em] uppercase text-gray-800">
            <div @mouseenter="activeMenu = 'women'" @mouseleave="activeMenu = null" class="relative">
                <span class="cursor-pointer pb-2" :class="activeMenu === 'women' ? 'border-b border-black' : ''">Women</span>
                
                <div x-show="activeMenu === 'women'" 
                     x-transition.opacity.duration.200ms
                     class="absolute left-1/2 -translate-x-1/2 top-full mt-0 w-screen bg-[#fbfbf9] shadow-md border-t border-gray-200" style="display: none;">
                    <div class="max-w-[1400px] mx-auto px-8 py-10 flex gap-x-16 text-left capitalize tracking-normal">
                        <div class="w-1/4">
                            <div class="relative group cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Styled in Silk" class="w-full h-auto object-cover">
                                <div class="absolute bottom-4 right-4 text-white text-[10px] font-bold tracking-widest uppercase">STYLED IN SILK</div>
                            </div>
                        </div>
                        <div class="w-1/6 flex flex-col space-y-3">
                            <h4 class="text-[10px] font-bold tracking-widest uppercase mb-1">Ready-to-wear</h4>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Spring-Summer 2026 Collection</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Coats and jackets</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Dresses and skirts</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Tops and shirts</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Pants and shorts</a>
                        </div>
                        <div class="w-1/6 flex flex-col space-y-3">
                            <h4 class="text-[10px] font-bold tracking-widest uppercase mb-1">Shoes</h4>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Sandals</a>
                            <a href="index.php" class="text-xs text-black border-b border-black w-max pb-[1px]">Sneakers</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Ballet flats and pumps</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Mules</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Espadrilles</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Loafers and derbies</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Boots and ankle boots</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black mt-2">View all</a>
                        </div>
                        <div class="w-1/6 flex flex-col space-y-3">
                            <h4 class="text-[10px] font-bold tracking-widest uppercase mb-1">Scarves, shawls and stoles</h4>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Silk scarves and accessories</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Cashmere shawls and stoles</a>
                            <a href="#" class="text-xs text-gray-600 hover:text-black">Twilly and other small formats</a>
                        </div>
                        <div class="w-1/6 flex flex-col space-y-8">
                            <div>
                                <h4 class="text-[10px] font-bold tracking-widest uppercase mb-4">Fashion Jewelry</h4>
                                <div class="flex flex-col space-y-3">
                                    <a href="#" class="text-xs text-gray-600 hover:text-black">Bracelets</a>
                                    <a href="#" class="text-xs text-gray-600 hover:text-black">Necklaces and pendants</a>
                                </div>
                            </div>
                            <h4 class="text-[10px] font-bold tracking-widest uppercase">Belts</h4>
                            <h4 class="text-[10px] font-bold tracking-widest uppercase">Hats and gloves</h4>
                        </div>
                    </div>
                </div>
            </div>

            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Men</span>
            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Leather Goods</span>
            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Jewelry</span>
            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Watches</span>
            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Fragrances and make-up</span>
            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Home and Art of Living</span>
            <span class="cursor-pointer hover:border-b hover:border-black pb-2">Equestrian</span>
        </nav>

        <div class="flex lg:hidden justify-between items-center px-5 py-4">
            <div class="flex items-center space-x-5 w-1/3">
                <button @click="isMobileMenuOpen = true" class="text-black hover:opacity-70">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <button @click="isSearchOpen = true" class="text-black hover:opacity-70">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
            
            <div class="w-1/3 flex flex-col items-center justify-center cursor-pointer">
                <a href="index.php"><h1 class="text-xl tracking-[0.1em] font-medium uppercase leading-none text-black">HERMÈS</h1></a>
                <span class="text-[7px] tracking-[0.3em] font-medium mt-1 text-black">PARIS</span>
            </div>

            <div class="flex justify-end items-center space-x-5 w-1/3">
                <a href="account.php" class="text-black hover:opacity-70">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
                <a href="cart.php" class="text-black hover:opacity-70 relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </a>
            </div>
        </div>
    </header>


    <div x-show="isMobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
         class="fixed inset-0 w-full h-full bg-[#fbfbf9] z-[100] flex flex-col overflow-y-auto" style="display: none;"
         x-data="{ openCategory: 'women', openSub: 'shoes' }">
        
        <div class="flex justify-between items-center px-6 py-5 border-b border-transparent">
            <span class="text-[15px] font-medium tracking-[0.15em] uppercase">MENU</span>
            <button @click="isMobileMenuOpen = false" class="text-black hover:opacity-70">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="px-6 py-4 flex-1">
            <div class="border-b border-black pb-4 mb-4">
                <div class="flex justify-between items-center cursor-pointer" @click="openCategory = openCategory === 'women' ? '' : 'women'">
                    <span class="text-[28px] font-light">Women</span>
                    <span class="text-2xl font-light" x-text="openCategory === 'women' ? '−' : '+'"></span>
                </div>
                
                <div x-show="openCategory === 'women'" x-transition class="mt-8 space-y-7">
                    <div>
                        <div class="flex justify-between items-center cursor-pointer" @click="openSub = openSub === 'rtw' ? '' : 'rtw'">
                            <span class="text-[11px] font-bold tracking-[0.15em] uppercase">READY-TO-WEAR</span>
                            <span class="text-xl font-light" x-text="openSub === 'rtw' ? '−' : '+'"></span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-center cursor-pointer" @click="openSub = openSub === 'shoes' ? '' : 'shoes'">
                            <span class="text-[11px] font-bold tracking-[0.15em] uppercase">SHOES</span>
                            <span class="text-xl font-light" x-text="openSub === 'shoes' ? '−' : '+'"></span>
                        </div>
                        <div x-show="openSub === 'shoes'" x-transition class="mt-5 flex flex-col space-y-5 pl-4">
                            <a href="#" class="text-[14px] text-gray-800">Sandals</a>
                            <a href="index.php" class="text-[14px] text-black border-b border-black w-max pb-[1px]">Sneakers</a>
                            <a href="#" class="text-[14px] text-gray-800">Ballet flats and pumps</a>
                            <a href="#" class="text-[14px] text-gray-800">Mules</a>
                            <a href="#" class="text-[14px] text-gray-800">Espadrilles</a>
                            <a href="#" class="text-[14px] text-gray-800">Loafers and derbies</a>
                            <a href="#" class="text-[14px] text-gray-800">Boots and ankle boots</a>
                            <a href="#" class="text-[14px] text-gray-800 mt-2">View all</a>
                        </div>
                    </div>
                    <div class="flex justify-between items-center cursor-pointer">
                        <span class="text-[11px] font-bold tracking-[0.15em] uppercase">SCARVES, SHAWLS AND STOLES</span>
                        <span class="text-xl font-light">+</span>
                    </div>
                    <div class="flex justify-between items-center cursor-pointer">
                        <span class="text-[11px] font-bold tracking-[0.15em] uppercase">FASHION JEWELRY</span>
                        <span class="text-xl font-light">+</span>
                    </div>
                    <div class="flex justify-between items-center cursor-pointer">
                        <span class="text-[11px] font-bold tracking-[0.15em] uppercase">BELTS</span>
                    </div>
                    <div class="flex justify-between items-center cursor-pointer">
                        <span class="text-[11px] font-bold tracking-[0.15em] uppercase">HATS AND GLOVES</span>
                    </div>
                    <div class="flex justify-between items-center cursor-pointer">
                        <span class="text-[11px] font-bold tracking-[0.15em] uppercase">HAIR ACCESSORIES</span>
                    </div>
                </div>
            </div>

            <div class="py-4 border-b border-gray-200 cursor-pointer"><span class="text-[28px] font-light text-gray-400">Men</span></div>
            <div class="py-4 border-b border-gray-200 cursor-pointer"><span class="text-[28px] font-light text-gray-400">Leather Goods</span></div>
            <div class="py-4 border-b border-gray-200 cursor-pointer"><span class="text-[28px] font-light text-gray-400">Jewelry</span></div>
        </div>
        
        <div class="px-6 py-6 flex justify-center">
            <a href="index.php" class="bg-gray-100 px-6 py-3 rounded-full text-xs font-bold tracking-widest uppercase">hermes.com</a>
        </div>
    </div>


    <div x-show="isSearchOpen" 
         x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full"
         class="fixed inset-0 w-full h-full bg-[#fbfbf9] z-[110] flex flex-col" style="display: none;">
        
        <div class="flex justify-between items-center px-5 py-4 border-b border-gray-200 bg-white">
            <div class="flex items-center flex-1 border-b border-black pb-1 relative">
                <svg class="w-4 h-4 text-black absolute left-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="search" placeholder="Search" 
                       x-model="searchInput" 
                       @keydown.enter="if(searchInput) window.location.href='index.php?q=' + encodeURIComponent(searchInput)"
                       class="w-full bg-transparent outline-none text-[14px] text-black placeholder-gray-400 pl-7 pr-2">
            </div>
            <button @click="isSearchOpen = false" class="ml-5 text-[11px] font-bold tracking-widest uppercase text-black hover:opacity-70">Cancel</button>
        </div>

        <div class="px-6 py-8 flex-1 bg-[#fbfbf9]">
            <p class="text-[10px] font-bold tracking-widest uppercase text-gray-500 mb-6">Popular Searches</p>
            <div class="flex flex-col space-y-5">
                <a href="index.php?q=Sneakers" class="text-[20px] font-light text-black hover:opacity-70 flex items-center space-x-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Sneakers</span>
                </a>
                <a href="index.php?q=Sandals" class="text-[20px] font-light text-black hover:opacity-70 flex items-center space-x-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Sandals</span>
                </a>
                <a href="index.php?q=Oran" class="text-[20px] font-light text-black hover:opacity-70 flex items-center space-x-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Oran</span>
                </a>
                <a href="index.php?q=Birkin" class="text-[20px] font-light text-black hover:opacity-70 flex items-center space-x-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Birkin</span>
                </a>
            </div>
        </div>
    </div>


    <div x-show="isFilterOpen" 
         x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-full w-[420px] bg-white z-50 shadow-2xl flex flex-col" style="display: none;">
        
        <div class="px-8 py-6 flex justify-between items-center bg-white border-b border-transparent">
            <span class="text-xs font-bold uppercase tracking-widest">Filter</span>
            <button @click="isFilterOpen = false" class="text-black hover:opacity-70">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <div class="overflow-y-auto flex-1 px-8 pb-10 space-y-2 drawer-scroll" x-data="{ openSection: 'size' }">
            
            <div class="border-b border-gray-200">
                <button @click="openSection = openSection === 'size' ? null : 'size'" class="w-full flex justify-between items-center py-6">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Size</span>
                    <svg class="w-4 h-4 transform transition-transform" :class="openSection === 'size' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openSection === 'size'" class="pb-8">
                    <div class="grid grid-cols-5 gap-[6px]">
                        <?php 
                        $sizes = ['34', '34.5', '35', '35.5', '36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5', '40', '40.5', '41', '41.5', '42'];
                        foreach ($sizes as $size) {
                            echo '<button class="aspect-square flex items-center justify-center border border-[#d1d1d1] text-[13px] text-gray-700 hover:border-black transition-colors focus:border-black focus:border-[1.5px]">' . $size . '</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-200">
                <button @click="openSection = openSection === 'line' ? null : 'line'" class="w-full flex justify-between items-center py-6">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Line</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            <div class="border-b border-gray-200">
                <button @click="openSection = openSection === 'color' ? null : 'color'" class="w-full flex justify-between items-center py-6">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Color</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            <div class="border-b border-gray-200">
                <button @click="openSection = openSection === 'price' ? null : 'price'" class="w-full flex justify-between items-center py-6">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Price</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

             <div class="border-b border-gray-200">
                <button @click="openSection = openSection === 'sort' ? null : 'sort'" class="w-full flex justify-between items-center py-6">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Sort By</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>

        <div class="px-8 py-6 bg-white flex justify-center border-t border-transparent shadow-[0_-10px_20px_-15px_rgba(0,0,0,0.1)]">
            <button @click="isFilterOpen = false" class="w-full bg-black text-white text-[11px] tracking-widest uppercase py-4 hover:bg-gray-800 transition-colors font-bold">
                Apply
            </button>
        </div>
    </div>