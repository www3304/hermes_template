<?php include 'header.php'; ?>

<script>
    window.addToHermesCart = function(name, color, price, size, image, ref) {
        let cart = JSON.parse(localStorage.getItem('hermes_cart')) || [];
        let existingItem = cart.find(i => i.name === name && i.size === size);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ name, color, price, size, quantity: 1, image, ref });
        }
        localStorage.setItem('hermes_cart', JSON.stringify(cart));
    }
</script>

<main x-data="{ searchQuery: new URLSearchParams(window.location.search).get('q') ? new URLSearchParams(window.location.search).get('q').toLowerCase() : '' }" 
      class="max-w-[1800px] mx-auto px-4 md:px-8 pt-[100px] md:pt-[160px] pb-24 bg-[#fbfbf9]">
    
    <div class="mb-4 md:mb-6 flex items-end justify-between border-b border-gray-200 pb-3 md:pb-4">
        <div>
            <nav class="text-[8px] md:text-[9px] text-gray-500 mb-1 md:mb-2 tracking-widest uppercase">
                WOMEN <span class="mx-1">/</span> SHOES <span class="mx-1">/</span> SNEAKERS
            </nav>
            <h2 class="text-2xl md:text-3xl font-normal text-gray-900">Sneakers <span class="text-[10px] md:text-xs text-gray-500 ml-1">(61)</span></h2>
        </div>
        
        <button @click="isFilterOpen = true" class="flex items-center space-x-1 md:space-x-2 text-[10px] md:text-xs font-bold tracking-widest uppercase hover:text-gray-500 transition-colors">
            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            <span>Filter</span>
        </button>
    </div>

    <div x-show="searchQuery !== ''" style="display: none;" class="mb-8 p-4 bg-[#f7f7f7] border border-gray-200 text-[11px] text-gray-600 flex justify-between items-center">
        <span>Showing search results for: <strong class="text-black text-[13px] ml-2" x-text="searchQuery"></strong></span>
        <a href="index.php" class="text-black font-bold uppercase tracking-widest underline hover:text-gray-500">Clear Search</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-6 gap-x-2 gap-y-10 md:gap-x-4 md:gap-y-16 mt-6 md:mt-8">
        
        <div x-show="searchQuery === '' || 'bouncing sneaker blanc noir'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-1 md:col-span-3 relative group transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=1000&q=80" alt="Bouncing sneaker" class="w-[85%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>

                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>

                <div x-show="showQuickAdd" 
                     x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                     x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
                     class="absolute bottom-0 left-0 w-full bg-white p-5 md:p-6 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <div class="flex gap-3 md:gap-4 mb-4 md:mb-5">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-[#ebe9e4] flex items-center justify-center p-1">
                            <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply">
                        </div>
                        <div>
                            <h4 class="text-[10px] md:text-[11px] font-bold uppercase tracking-widest mb-1 text-gray-900">Bouncing sneaker</h4>
                            <p class="text-[9px] md:text-[11px] text-gray-500">RM 5,600</p>
                            <p class="text-[9px] md:text-[11px] text-gray-500 mt-0.5">Color: Blanc / Noir</p>
                        </div>
                    </div>

                    <div x-show="showError" class="text-red-500 text-[9px] md:text-[10px] mb-2 font-medium" style="display: none;">Please select a size!</div>

                    <div class="mb-4">
                        <span class="text-[9px] md:text-[10px] text-gray-500 block mb-2">Size</span>
                        <div class="grid grid-cols-5 gap-1 md:gap-2">
                            <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">36</button>
                            <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">37</button>
                            <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">38</button>
                            <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">39</button>
                            <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">40</button>
                        </div>
                    </div>

                    <button @click="if(selectedSize) { 
                                window.addToHermesCart('Bouncing sneaker', 'Blanc / Noir', 5600, selectedSize, 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=300&q=80', 'H202143Z 02360'); 
                                $dispatch('add-to-cart'); 
                                showQuickAdd = false; 
                                selectedSize = null;
                            } else { showError = true; }" 
                            class="w-full bg-black text-white text-[9px] md:text-[10px] font-bold tracking-[0.15em] uppercase py-3 md:py-3.5 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Add</span>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-start mt-3 md:mt-4">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Bouncing sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 5,600</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'jet sneaker kraft'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-1 md:col-span-3 relative group transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=1000&q=80" alt="Jet sneaker" class="w-[85%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>

                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>

                <div x-show="showQuickAdd" 
                     x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                     x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
                     class="absolute bottom-0 left-0 w-full bg-white p-5 md:p-6 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <div class="flex gap-3 md:gap-4 mb-4 md:mb-5">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-[#ebe9e4] flex items-center justify-center p-1">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply">
                        </div>
                        <div>
                            <h4 class="text-[10px] md:text-[11px] font-bold uppercase tracking-widest mb-1 text-gray-900">Jet sneaker</h4>
                            <p class="text-[9px] md:text-[11px] text-gray-500">RM 5,900</p>
                            <p class="text-[9px] md:text-[11px] text-gray-500 mt-0.5">Color: Kraft</p>
                        </div>
                    </div>

                    <div x-show="showError" class="text-red-500 text-[9px] md:text-[10px] mb-2 font-medium" style="display: none;">Please select a size!</div>

                    <div class="mb-4">
                        <span class="text-[9px] md:text-[10px] text-gray-500 block mb-2">Size</span>
                        <div class="grid grid-cols-5 gap-1 md:gap-2">
                            <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">36</button>
                            <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">37</button>
                            <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">38</button>
                            <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">39</button>
                            <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 md:py-2 text-[9px] md:text-[11px] hover:border-black transition-colors">40</button>
                        </div>
                    </div>

                    <button @click="if(selectedSize) { 
                                window.addToHermesCart('Jet sneaker', 'Kraft', 5900, selectedSize, 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=300&q=80', 'H261010Z 98400'); 
                                $dispatch('add-to-cart'); 
                                showQuickAdd = false; 
                                selectedSize = null;
                            } else { showError = true; }" 
                            class="w-full bg-black text-white text-[9px] md:text-[10px] font-bold tracking-[0.15em] uppercase py-3 md:py-3.5 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Add</span>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-start mt-3 md:mt-4">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Jet sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 5,900</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'master sneaker noir'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-1 md:col-span-2 relative group transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=600&q=80" alt="Master sneaker" class="w-[90%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>
                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>
                <div x-show="showQuickAdd" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="absolute bottom-0 left-0 w-full bg-white p-5 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <div class="flex gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#ebe9e4] flex items-center justify-center p-1"><img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply"></div>
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 text-gray-900">Master sneaker</h4>
                            <p class="text-[9px] text-gray-500">RM 5,200</p>
                        </div>
                    </div>
                    <div x-show="showError" class="text-red-500 text-[9px] mb-2 font-medium" style="display: none;">Select a size!</div>
                    <div class="grid grid-cols-5 gap-1 mb-4">
                        <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">36</button>
                        <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">37</button>
                        <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">38</button>
                        <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">39</button>
                        <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">40</button>
                    </div>
                    <button @click="if(selectedSize) { window.addToHermesCart('Master sneaker', 'Noir', 5200, selectedSize, 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=300&q=80', 'H261010Z 00000'); $dispatch('add-to-cart'); showQuickAdd = false; selectedSize = null; } else { showError = true; }" class="w-full bg-black text-white text-[9px] font-bold tracking-widest uppercase py-3 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-start mt-3">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Master sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 5,200</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'jet sneaker model kraft'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-1 md:col-span-2 relative group transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1552346154-21d32810baa3?auto=format&fit=crop&w=600&q=80" alt="Model wearing Jet Sneaker" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </a>
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>
                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>
                <div x-show="showQuickAdd" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="absolute bottom-0 left-0 w-full bg-white p-5 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <div class="flex gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#ebe9e4] flex items-center justify-center p-1"><img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply"></div>
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 text-gray-900">Jet sneaker</h4>
                            <p class="text-[9px] text-gray-500">RM 5,900</p>
                        </div>
                    </div>
                    <div x-show="showError" class="text-red-500 text-[9px] mb-2 font-medium" style="display: none;">Select a size!</div>
                    <div class="grid grid-cols-5 gap-1 mb-4">
                        <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">36</button>
                        <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">37</button>
                        <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">38</button>
                        <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">39</button>
                        <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">40</button>
                    </div>
                    <button @click="if(selectedSize) { window.addToHermesCart('Jet sneaker', 'Kraft', 5900, selectedSize, 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=300&q=80', 'H261010Z 98400'); $dispatch('add-to-cart'); showQuickAdd = false; selectedSize = null; } else { showError = true; }" class="w-full bg-black text-white text-[9px] font-bold tracking-widest uppercase py-3 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-start mt-3">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Jet sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 5,900</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'master sneaker blanc'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-2 md:col-span-2 relative group transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=600&q=80" alt="Master sneaker" class="w-[90%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>
                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>
                <div x-show="showQuickAdd" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="absolute bottom-0 left-0 w-full bg-white p-5 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <div class="flex gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#ebe9e4] flex items-center justify-center p-1"><img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply"></div>
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 text-gray-900">Master sneaker</h4>
                            <p class="text-[9px] text-gray-500">RM 5,200</p>
                        </div>
                    </div>
                    <div x-show="showError" class="text-red-500 text-[9px] mb-2 font-medium" style="display: none;">Select a size!</div>
                    <div class="grid grid-cols-5 gap-1 mb-4">
                        <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">36</button>
                        <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">37</button>
                        <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">38</button>
                        <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">39</button>
                        <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">40</button>
                    </div>
                    <button @click="if(selectedSize) { window.addToHermesCart('Master sneaker', 'Blanc', 5200, selectedSize, 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=300&q=80', 'H261010Z 11111'); $dispatch('add-to-cart'); showQuickAdd = false; selectedSize = null; } else { showError = true; }" class="w-full bg-black text-white text-[9px] font-bold tracking-widest uppercase py-3 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-start mt-3">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Master sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 5,200</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'match sneaker blanc'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-1 md:col-span-2 relative group md:mt-8 transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=600&q=80" alt="Match sneaker" class="w-[90%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>
                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>
                <div x-show="showQuickAdd" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="absolute bottom-0 left-0 w-full bg-white p-5 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <div class="flex gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#ebe9e4] flex items-center justify-center p-1"><img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply"></div>
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 text-gray-900">Match sneaker</h4>
                            <p class="text-[9px] text-gray-500">RM 4,750</p>
                        </div>
                    </div>
                    <div x-show="showError" class="text-red-500 text-[9px] mb-2 font-medium" style="display: none;">Select a size!</div>
                    <div class="grid grid-cols-5 gap-1 mb-4">
                        <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">36</button>
                        <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">37</button>
                        <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">38</button>
                        <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">39</button>
                        <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">40</button>
                    </div>
                    <button @click="if(selectedSize) { window.addToHermesCart('Match sneaker', 'Blanc', 4750, selectedSize, 'https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=300&q=80', 'H261010Z 22222'); $dispatch('add-to-cart'); showQuickAdd = false; selectedSize = null; } else { showError = true; }" class="w-full bg-black text-white text-[9px] font-bold tracking-widest uppercase py-3 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-start mt-3">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Match sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 4,750</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'lucky slip-on beige'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-1 md:col-span-2 relative group md:mt-8 transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=600&q=80" alt="Lucky slip-on" class="w-[90%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>
                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>
                <div x-show="showQuickAdd" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="absolute bottom-0 left-0 w-full bg-white p-5 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <div class="flex gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#ebe9e4] flex items-center justify-center p-1"><img src="https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply"></div>
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 text-gray-900">Lucky slip-on</h4>
                            <p class="text-[9px] text-gray-500">RM 4,450</p>
                        </div>
                    </div>
                    <div x-show="showError" class="text-red-500 text-[9px] mb-2 font-medium" style="display: none;">Select a size!</div>
                    <div class="grid grid-cols-5 gap-1 mb-4">
                        <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">36</button>
                        <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">37</button>
                        <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">38</button>
                        <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">39</button>
                        <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">40</button>
                    </div>
                    <button @click="if(selectedSize) { window.addToHermesCart('Lucky slip-on', 'Beige', 4450, selectedSize, 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=300&q=80', 'H261010Z 33333'); $dispatch('add-to-cart'); showQuickAdd = false; selectedSize = null; } else { showError = true; }" class="w-full bg-black text-white text-[9px] font-bold tracking-widest uppercase py-3 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-start mt-3">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Lucky slip-on</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 4,450</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

        <div x-show="searchQuery === '' || 'impulse sneaker noir'.includes(searchQuery)" 
             x-data="{ showQuickAdd: false, selectedSize: null, showError: false }" class="col-span-2 md:col-span-2 relative group md:mt-8 transition-all duration-300">
            <div class="bg-[#ebe9e4] aspect-[4/3] relative overflow-hidden">
                <a href="product.php" class="absolute inset-0 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?auto=format&fit=crop&w=600&q=80" alt="Impulse sneaker" class="w-[90%] h-auto object-contain transition-transform duration-700 group-hover:scale-105 mix-blend-multiply">
                </a>
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-1 md:hidden">
                    <div class="w-1 h-1 bg-black rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                </div>
                <div x-show="showQuickAdd" x-transition.opacity class="absolute inset-0 bg-black/40 z-10" style="display: none;"></div>
                <div x-show="showQuickAdd" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="absolute bottom-0 left-0 w-full bg-white p-5 z-20 rounded-t-sm shadow-xl" style="display: none;" @click.away="showQuickAdd = false; showError = false; selectedSize = null;">
                    <button @click="showQuickAdd = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <div class="flex gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#ebe9e4] flex items-center justify-center p-1"><img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?auto=format&fit=crop&w=200&q=80" class="w-full h-auto mix-blend-multiply"></div>
                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 text-gray-900">Impulse sneaker</h4>
                            <p class="text-[9px] text-gray-500">RM 5,800</p>
                        </div>
                    </div>
                    <div x-show="showError" class="text-red-500 text-[9px] mb-2 font-medium" style="display: none;">Select a size!</div>
                    <div class="grid grid-cols-5 gap-1 mb-4">
                        <button @click="selectedSize = '36'; showError = false" :class="selectedSize === '36' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">36</button>
                        <button @click="selectedSize = '37'; showError = false" :class="selectedSize === '37' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">37</button>
                        <button @click="selectedSize = '38'; showError = false" :class="selectedSize === '38' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">38</button>
                        <button @click="selectedSize = '39'; showError = false" :class="selectedSize === '39' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">39</button>
                        <button @click="selectedSize = '40'; showError = false" :class="selectedSize === '40' ? 'border-black border-2' : 'border-gray-300'" class="border py-1.5 text-[9px] hover:border-black transition-colors">40</button>
                    </div>
                    <button @click="if(selectedSize) { window.addToHermesCart('Impulse sneaker', 'Noir', 5800, selectedSize, 'https://images.unsplash.com/photo-1605348532760-6753d2c43329?auto=format&fit=crop&w=300&q=80', 'H261010Z 44444'); $dispatch('add-to-cart'); showQuickAdd = false; selectedSize = null; } else { showError = true; }" class="w-full bg-black text-white text-[9px] font-bold tracking-widest uppercase py-3 hover:bg-gray-800 transition-colors flex justify-center items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-start mt-3">
                <a href="product.php" class="block">
                    <h3 class="text-[11px] md:text-xs font-medium text-gray-900 mb-0.5">Impulse sneaker</h3>
                    <p class="text-[10px] md:text-[11px] text-gray-600">RM 5,800</p>
                </a>
                <button @click="showQuickAdd = true" class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center hover:border-black transition-colors shrink-0">
                    <svg class="w-2.5 h-2.5 md:w-3 md:h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </button>
            </div>
        </div>

    </div>
</main>

<?php include 'footer.php'; ?>
