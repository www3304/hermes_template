<?php 
include 'header.php'; 

// ==========================================
// 模拟数据库：根据不同 ID 渲染不同商品
// ==========================================
$products_db = [
    'jet-sneaker' => [
        'name' => 'Jet sneaker',
        'price' => '5,900',
        'raw_price' => 5900,
        'color' => 'Kraft',
        'ref' => 'H261010Z 98400',
        'main_img' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=1200&q=80',
        'model_img' => 'https://images.unsplash.com/photo-1552346154-21d32810baa3?auto=format&fit=crop&w=1200&q=80',
        'thumbnails' => [
            'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=200&q=80'
        ],
        'desc' => 'Sneaker in stitched suede goatskin with contrasting design and iconic "H" detail.<br>For a bold retro look.'
    ],
    'bouncing-sneaker' => [
        'name' => 'Bouncing sneaker',
        'price' => '5,600',
        'raw_price' => 5600,
        'color' => 'Blanc / Noir',
        'ref' => 'H202143Z 02360',
        'main_img' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=1200&q=80',
        'model_img' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=1200&q=80',
        'thumbnails' => [
            'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1605348532760-6753d2c43329?auto=format&fit=crop&w=200&q=80'
        ],
        'desc' => 'Sneaker in technical canvas and suede goatskin with light sole.'
    ],
    'master-sneaker' => [
        'name' => 'Master sneaker',
        'price' => '5,200',
        'raw_price' => 5200,
        'color' => 'Noir',
        'ref' => 'H261010Z 00000',
        'main_img' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=1200&q=80',
        'model_img' => 'https://images.unsplash.com/photo-1552346154-21d32810baa3?auto=format&fit=crop&w=1200&q=80',
        'thumbnails' => [
            'https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=200&q=80'
        ],
        'desc' => 'Sneaker in calfskin with "H" detail.'
    ]
];

// 获取当前 URL 里的 id，如果在数据库找不到，默认显示 jet-sneaker
$product_id = isset($_GET['id']) && array_key_exists($_GET['id'], $products_db) ? $_GET['id'] : 'jet-sneaker';
$product = $products_db[$product_id];
?>

<div x-data="{ 
        showStickyBar: false,
        openDetail: 'product_details',
        isSizeSelectorOpen: false,
        isSizeGuideOpen: false,
        sizeGuideTab: 'find',
        unit: 'cm',
        selectedSize: null,
        showError: false,
        
        // 动态图库：记录当前显示的大图
        activeImage: '<?php echo $product['main_img']; ?>',

        sizes: [
            {h: '34', eu: '34', cm: '21.80 cm', in: '8.58 inches'},
            {h: '34.5', eu: '34.5', cm: '22.14 cm', in: '8.71 inches'},
            {h: '35', eu: '35', cm: '22.47 cm', in: '8.84 inches'},
            {h: '35.5', eu: '35.5', cm: '22.80 cm', in: '8.97 inches'},
            {h: '36', eu: '36', cm: '23.13 cm', in: '9.10 inches'},
            {h: '36.5', eu: '36.5', cm: '23.47 cm', in: '9.24 inches'},
            {h: '37', eu: '37', cm: '23.80 cm', in: '9.37 inches'},
            {h: '37.5', eu: '37.5', cm: '24.13 cm', in: '9.50 inches'},
            {h: '38', eu: '38', cm: '24.47 cm', in: '9.63 inches'},
            {h: '38.5', eu: '38.5', cm: '24.80 cm', in: '9.76 inches'},
            {h: '39', eu: '39', cm: '25.13 cm', in: '9.89 inches'},
            {h: '39.5', eu: '39.5', cm: '25.47 cm', in: '10.02 inches'},
            {h: '40', eu: '40', cm: '25.80 cm', in: '10.15 inches'}
        ],

        addToCart() {
            if (!this.selectedSize) {
                this.showError = true;
                this.isSizeSelectorOpen = true; 
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }
            
            let cart = JSON.parse(localStorage.getItem('hermes_cart')) || [];
            let existingItem = cart.find(i => i.name === '<?php echo $product['name']; ?>' && i.size === this.selectedSize);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ 
                    name: '<?php echo $product['name']; ?>', 
                    color: '<?php echo $product['color']; ?>', 
                    price: <?php echo $product['raw_price']; ?>, 
                    size: this.selectedSize, 
                    quantity: 1, 
                    image: '<?php echo $product['thumbnails'][0]; ?>', 
                    ref: '<?php echo $product['ref']; ?>' 
                });
            }
            localStorage.setItem('hermes_cart', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('add-to-cart'));
            
            this.showError = false;
            this.isSizeSelectorOpen = false;
        }
     }" 
     @scroll.window="showStickyBar = (window.pageYOffset > 800)">

    <div x-show="isSizeGuideOpen" class="fixed inset-0 z-50 flex justify-end" style="display: none;">
        <div x-show="isSizeGuideOpen" x-transition.opacity @click="isSizeGuideOpen = false" class="absolute inset-0 bg-black/20"></div>
        <div x-show="isSizeGuideOpen" 
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
             class="relative w-full max-w-[500px] bg-white h-full flex flex-col shadow-2xl">
            
            <div class="px-8 py-6 flex justify-between items-center border-b border-gray-200">
                <span class="text-[13px] font-bold uppercase tracking-[0.15em]">Size Guide</span>
                <button @click="isSizeGuideOpen = false" class="text-gray-400 hover:text-black">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex text-[11px] font-medium text-gray-500 border-b border-gray-200">
                <button @click="sizeGuideTab = 'find'" class="flex-1 py-4 flex flex-col items-center gap-2 hover:text-black transition-colors" :class="sizeGuideTab === 'find' ? 'text-black border-b-2 border-black' : ''">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                    Find the right size
                </button>
                <button @click="sizeGuideTab = 'measure'" class="flex-1 py-4 flex flex-col items-center gap-2 hover:text-black transition-colors" :class="sizeGuideTab === 'measure' ? 'text-black border-b-2 border-black' : ''">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                    Measurement guide
                </button>
            </div>

            <div class="flex-1 overflow-y-auto px-8 py-6">
                <div x-show="sizeGuideTab === 'find'">
                    <div class="mb-6 relative">
                        <label class="block text-[10px] text-gray-500 mb-1">Select a location *</label>
                        <select class="w-full bg-transparent border-0 border-b border-gray-300 outline-none py-2 text-[13px] appearance-none">
                            <option>EU</option><option>US</option><option>UK</option>
                        </select>
                        <svg class="w-4 h-4 absolute right-0 top-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <div x-show="sizeGuideTab === 'measure'" style="display: none;">
                    <h4 class="text-[13px] font-bold mb-2">Taking the appropriate measures!</h4>
                    <p class="text-[11px] text-gray-600 mb-6 leading-relaxed">To find the perfect size, use a measuring tape to measure yourself following the steps explained below. We recommend that you keep the measuring tape loose and that you size up if you are in-between sizes.</p>
                    <ol class="list-decimal pl-4 space-y-4 text-[12px] text-gray-800 mb-8 font-medium">
                        <li class="pl-2">Place the tip of your bare foot against the wall.</li>
                        <li class="pl-2">Place your foot on a piece of paper on a flat and solid surface and draw a line at the tip of your biggest toe using a pencil.</li>
                        <li class="pl-2">Measure the length between the two lines.</li>
                        <li class="pl-2">Refer to the chart below to find the corresponding shoe size.</li>
                    </ol>
                    <p class="text-[10px] text-gray-500 mb-6 leading-relaxed">Our tip: Following the instructions, measure both feet and take into account the maximum length when selecting your shoe size.</p>
                </div>

                <div class="mt-4">
                    <div class="flex items-center gap-4 mb-4">
                        <label class="flex items-center space-x-2 text-[12px] cursor-pointer">
                            <input type="radio" value="cm" x-model="unit" class="w-3 h-3 appearance-none border border-black rounded-full checked:bg-black ring-2 ring-transparent checked:ring-white checked:ring-inset">
                            <span>cm</span>
                        </label>
                        <label class="flex items-center space-x-2 text-[12px] cursor-pointer">
                            <input type="radio" value="inches" x-model="unit" class="w-3 h-3 appearance-none border border-gray-400 rounded-full checked:bg-black checked:border-black ring-2 ring-transparent checked:ring-white checked:ring-inset">
                            <span>inches</span>
                        </label>
                    </div>

                    <table class="w-full text-center text-[11px]">
                        <thead>
                            <tr class="bg-gray-200 font-bold text-gray-800">
                                <th class="py-3">Hermès Size</th>
                                <th class="py-3">EU</th>
                                <th class="py-3">Foot length</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="s in sizes">
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-3 text-gray-800" x-text="s.h"></td>
                                    <td class="py-3 text-gray-500" x-text="s.eu"></td>
                                    <td class="py-3 text-gray-500" x-text="unit === 'cm' ? s.cm : s.in"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <main class="relative bg-[#ebe9e4] min-h-screen pt-[120px]">
        <a href="index.php" class="absolute top-[140px] left-8 flex items-center space-x-2 bg-white px-5 py-2.5 text-[10px] font-bold tracking-[0.15em] uppercase rounded-full shadow-sm hover:opacity-70 transition-opacity z-10">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back</span>
        </a>

        <div class="flex flex-col md:flex-row w-full h-full min-h-[85vh]">
            
            <div class="w-full md:w-1/2 flex flex-col justify-center items-center relative py-10 px-8">
                <img :src="activeImage" alt="Sneaker" class="w-[85%] h-auto object-contain mb-8 mix-blend-multiply transition-opacity duration-300">
                
                <div class="absolute bottom-8 left-8 flex space-x-3">
                    <?php foreach($product['thumbnails'] as $thumb): ?>
                        <button @click="activeImage = '<?php echo $thumb; ?>'" 
                                class="w-12 h-12 bg-white/50 border p-1 transition-colors"
                                :class="activeImage === '<?php echo $thumb; ?>' ? 'border-black' : 'border-transparent hover:border-gray-400'">
                            <img src="<?php echo $thumb; ?>" class="w-full h-full object-contain mix-blend-multiply">
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="w-full md:w-1/2 relative bg-[#ebe9e4]">
                <img src="<?php echo $product['model_img']; ?>" alt="Model wearing Sneaker" class="w-full h-full object-cover">
                
                <div class="absolute bottom-10 right-10 w-[400px] bg-white shadow-xl z-10">
                    
                    <div x-show="!isSizeSelectorOpen" class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <h1 class="text-[15px] font-medium text-gray-900"><?php echo $product['name']; ?></h1>
                            <button class="text-gray-400 hover:text-black"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg></button>
                        </div>
                        
                        <div class="flex justify-between text-[11px] mb-3">
                            <span class="text-gray-500">Color</span>
                            <span class="font-medium"><?php echo $product['color']; ?></span>
                        </div>
                        
                        <div class="grid grid-cols-5 gap-2 mb-8">
                            <button class="aspect-square bg-[#ebe9e4] border border-black p-1"><img src="<?php echo $product['thumbnails'][0]; ?>" class="w-full h-full object-contain mix-blend-multiply"></button>
                            <button class="aspect-square bg-[#ebe9e4] border border-transparent hover:border-gray-400 p-1"><img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-contain mix-blend-multiply"></button>
                            <button class="aspect-square bg-[#ebe9e4] border border-transparent hover:border-gray-400 p-1"><img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-contain mix-blend-multiply"></button>
                            <button class="aspect-square bg-[#ebe9e4] border border-transparent hover:border-gray-400 p-1"><img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-contain mix-blend-multiply"></button>
                            <button class="aspect-square bg-[#ebe9e4] border border-transparent hover:border-gray-400 p-1"><img src="https://images.unsplash.com/photo-1552346154-21d32810baa3?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-contain mix-blend-multiply"></button>
                        </div>

                        <div x-show="showError" class="text-red-500 text-[10px] mb-2 font-medium" style="display: none;">Please select a size!</div>

                        <button @click="isSizeSelectorOpen = true" 
                                class="w-full flex justify-between items-center pb-3 mb-6 transition-colors"
                                :class="showError ? 'border-b-2 border-red-500 text-red-500' : 'border-b border-black hover:text-gray-600'">
                            <span class="text-[13px] font-medium" x-text="selectedSize ? 'Size: ' + selectedSize : 'Select a size'"></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
                        </button>

                        <p class="text-right text-[13px] font-medium mb-6">RM <?php echo $product['price']; ?></p>
                        
                        <div class="flex space-x-3">
                            <button class="w-1/3 border border-black flex items-center justify-center hover:bg-gray-50 transition-colors">
                                <span class="text-sm font-bold tracking-tighter"> Pay</span>
                            </button>
                            <button @click="addToCart()" class="w-2/3 bg-black text-white text-[11px] font-bold tracking-[0.15em] uppercase py-4 hover:bg-gray-800 transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <span>Add to cart</span>
                            </button>
                        </div>
                    </div>

                    <div x-show="isSizeSelectorOpen" style="display: none;" class="p-8 h-[550px] flex flex-col relative bg-white">
                        <div class="flex justify-center border-b border-black pb-4 mb-4 relative">
                            <span class="text-[13px] font-bold uppercase tracking-widest">Size</span>
                            <button @click="isSizeSelectorOpen = false" class="absolute right-0 top-0 text-gray-400 hover:text-black">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <div class="flex-1 overflow-y-auto space-y-6 text-[13px]">
                            <template x-for="s in sizes.slice(4, 13)">
                                <button @click="selectedSize = s.h; isSizeSelectorOpen = false; showError = false;" 
                                        class="w-full text-left hover:text-gray-500 transition-colors flex justify-between">
                                    <span x-text="s.h" :class="selectedSize === s.h ? 'font-bold' : ''"></span>
                                    <span x-show="selectedSize === s.h">✓</span>
                                </button>
                            </template>
                            <div class="flex justify-between text-gray-300">
                                <span>41</span><span>Unavailable</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button @click="isSizeGuideOpen = true" class="flex items-center space-x-2 text-[11px] font-bold tracking-widest uppercase hover:text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                                <span class="underline underline-offset-4">Size Guide</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="max-w-[1400px] mx-auto px-8 py-24 bg-[#fbfbf9] flex flex-col md:flex-row gap-20 border-b border-gray-200">
        <div class="w-full md:w-1/2 text-[13px] leading-relaxed text-gray-800 space-y-6">
            <p><?php echo $product['desc']; ?></p>
            <p>A second pair of shoelaces is included.</p>
            <p>We recommend choosing your usual size for this model.</p>
            <p>Made in Italy<br>Sole height: 2.2 cm</p>
            <div class="pt-4 text-[11px] text-gray-500">
                <p>Product reference: <?php echo $product['ref']; ?></p>
                <p class="mt-1">Like to know more? <a href="#" class="underline hover:text-black">Contact Customer Service</a></p>
            </div>
        </div>
        
        <div class="w-full md:w-1/2">
            <div class="border-b border-gray-200">
                <button @click="openDetail = openDetail === 'product_details' ? null : 'product_details'" class="w-full flex justify-between items-center py-5">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Product Details</span>
                    <svg class="w-4 h-4 transform transition-transform" :class="openDetail === 'product_details' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openDetail === 'product_details'" class="pb-6 text-[13px] text-gray-800 leading-relaxed">
                    <ul class="list-disc pl-4 space-y-1">
                        <li>Honey rubber sole</li>
                        <li>White rubber midsole</li>
                        <li>Dark natural leather welt</li>
                        <li>Alabaster beige lambskin insole and lining</li>
                        <li>Alabaster beige fabric ribbon</li>
                        <li>One pair of white and one pair of alabaster beige shoelaces</li>
                    </ul>
                </div>
            </div>
            <div class="border-b border-gray-200">
                <button @click="openDetail = openDetail === 'care' ? null : 'care'" class="w-full flex justify-between items-center py-5">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Care</span>
                    <svg class="w-4 h-4 transform transition-transform" :class="openDetail === 'care' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
            <div class="border-b border-gray-200">
                <button @click="openDetail = openDetail === 'delivery' ? null : 'delivery'" class="w-full flex justify-between items-center py-5">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Delivery & Returns</span>
                    <svg class="w-4 h-4 transform transition-transform" :class="openDetail === 'delivery' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
            <div class="border-b border-gray-200">
                <button @click="openDetail = openDetail === 'gifting' ? null : 'gifting'" class="w-full flex justify-between items-center py-5">
                    <span class="text-[11px] font-bold uppercase tracking-widest">Gifting</span>
                    <svg class="w-4 h-4 transform transition-transform" :class="openDetail === 'gifting' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </section>

    <section class="max-w-[800px] mx-auto px-8 py-24 text-center bg-[#fbfbf9]">
        <h2 class="text-3xl italic font-serif text-gray-900 mb-8" style="font-family: 'Times New Roman', Times, serif;">The story behind</h2>
        <p class="text-[13px] text-gray-800 leading-loose">
            The <?php echo $product['name']; ?> skillfully blends style and color. Its discreetly retro design is enhanced by the "H en biais" motif, giving it a unique allure. It's available in various shades and materials to suit all tastes.
        </p>
    </section>

    <section class="max-w-[1800px] mx-auto px-8 py-16 bg-[#fbfbf9]">
        <div class="mb-24">
            <h2 class="text-3xl italic font-serif text-gray-900 mb-10" style="font-family: 'Times New Roman', Times, serif;">The Perfect Partner</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="product.php?id=bouncing-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-square flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1605100804763-247f67b2548e?auto=format&fit=crop&w=500&q=80" alt="Olympe ear cuff" class="w-[70%] h-auto mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Olympe ear cuff, small model</h3>
                    <p class="text-[11px] text-gray-500">RM 1,950</p>
                </a>
                <a href="product.php?id=master-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-square flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1620799140188-3b2a02fd9a77?auto=format&fit=crop&w=500&q=80" alt="Sweater" class="w-[100%] h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">"Chaine d'Ancre" long-sleeve sweater</h3>
                    <p class="text-[11px] text-gray-500">RM 9,000</p>
                </a>
                <a href="product.php?id=jet-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-square flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=500&q=80" alt="Twilly" class="w-[100%] h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Cheval de Coeur Bandana Twilly</h3>
                    <p class="text-[11px] text-gray-500">RM 1,250</p>
                </a>
                <a href="product.php?id=bouncing-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-square flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&w=500&q=80" alt="Passport holder" class="w-[70%] h-auto mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Tarmac passport holder</h3>
                    <p class="text-[11px] text-gray-500">RM 1,800</p>
                </a>
            </div>
        </div>

        <div>
            <h2 class="text-3xl italic font-serif text-gray-900 mb-10" style="font-family: 'Times New Roman', Times, serif;">Keep exploring</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="product.php?id=bouncing-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-[4/3] flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=600&q=80" alt="Sneaker" class="w-[90%] h-auto mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Bouncing sneaker</h3>
                    <p class="text-[11px] text-gray-500">RM 4,700</p>
                </a>
                <a href="product.php?id=jet-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-[4/3] flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=600&q=80" alt="Sneaker" class="w-[90%] h-auto mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Kid sneaker</h3>
                    <p class="text-[11px] text-gray-500">RM 4,700</p>
                </a>
                <a href="product.php?id=master-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-[4/3] flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=600&q=80" alt="Sandal" class="w-[90%] h-auto mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Lipari 70 sandal</h3>
                    <p class="text-[11px] text-gray-500">RM 4,750</p>
                </a>
                <a href="product.php?id=bouncing-sneaker" class="group block">
                    <div class="bg-[#ebe9e4] aspect-[4/3] flex items-center justify-center overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=600&q=80" alt="Sneaker" class="w-[90%] h-auto mix-blend-multiply group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[11px] text-gray-900 mb-1">Match sneaker</h3>
                    <p class="text-[11px] text-gray-500">RM 4,750</p>
                </a>
            </div>
        </div>
    </section>

    <div x-show="showStickyBar" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-[0_-10px_20px_rgba(0,0,0,0.05)] z-40 py-3 px-8 flex justify-between items-center" style="display: none;">
        
        <div class="flex items-center space-x-4">
            <img src="<?php echo $product['thumbnails'][0]; ?>" alt="Thumbnail" class="w-10 h-10 object-contain bg-[#ebe9e4] mix-blend-multiply">
            <div>
                <h4 class="text-[11px] font-bold text-gray-900"><?php echo $product['name']; ?></h4>
                <p class="text-[11px] text-gray-500 font-medium">RM <?php echo $product['price']; ?></p>
            </div>
        </div>

        <div class="flex space-x-3 w-[400px]">
            <button class="w-1/3 border border-black flex items-center justify-center hover:bg-gray-50 transition-colors py-3">
                <span class="text-sm font-bold tracking-tighter"> Pay</span>
            </button>
            <button @click="addToCart()" class="w-2/3 bg-black text-white text-[11px] font-bold tracking-[0.15em] uppercase py-4 hover:bg-gray-800 transition-colors flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span>Add to cart</span>
            </button>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>