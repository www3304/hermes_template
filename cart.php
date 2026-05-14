<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Hermès Malaysia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
        body { font-family: 'Inter', "Helvetica Neue", Helvetica, sans-serif; -webkit-font-smoothing: antialiased; background-color: #fbfbf9; }
        .hermes-radio { appearance: none; border-radius: 50%; }
        .hermes-radio:checked { border: 4px solid black; }
        .hermes-checkbox:checked { background-color: white; border-color: black; }
        .hermes-checkbox:checked::after { content: '✓'; color: black; font-size: 12px; position: absolute; left: 3px; top: -2px; }
    </style>
</head>

<body class="min-h-screen flex flex-col" 
      x-data="{ 
          cartItems: [],
          showGifting: false,
          
          init() {
              // 页面加载时获取本地数据
              this.cartItems = JSON.parse(localStorage.getItem('hermes_cart')) || [];
          },
          
          updateCart() {
              // 数量变更或删除后，保存回本地
              localStorage.setItem('hermes_cart', JSON.stringify(this.cartItems));
          },

          removeItem(index) {
              this.cartItems.splice(index, 1);
              this.updateCart();
          },

          get subtotal() {
              return this.cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
          }
      }">

    <header class="w-full pt-12 pb-8">
        <div class="max-w-[1400px] mx-auto px-8 relative flex justify-center items-center">
            <a href="index.php" class="absolute left-8 flex items-center space-x-2 text-[13px] font-medium hover:text-gray-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back</span>
            </a>
            <div class="flex flex-col items-center">
                <h1 class="text-3xl tracking-[0.1em] font-medium uppercase leading-none">HERMÈS</h1>
                <span class="text-[9px] tracking-[0.3em] font-medium mt-1">PARIS</span>
            </div>
        </div>

        <div class="max-w-[1200px] mx-auto mt-16 px-8">
            <div class="relative flex justify-between text-[10px] font-bold tracking-[0.15em] uppercase text-gray-300">
                <div class="absolute top-1/2 left-0 w-full h-[1px] bg-gray-200 -translate-y-1/2 -z-10"></div>
                <div class="flex flex-col items-center bg-[#fbfbf9] px-6 text-black">
                    <div class="w-2.5 h-2.5 bg-black rounded-full mb-3"></div>
                    <span>CART</span>
                </div>
                <div class="flex flex-col items-center bg-[#fbfbf9] px-6">
                    <div class="w-2.5 h-2.5 border border-gray-300 rounded-full mb-3 bg-[#fbfbf9]"></div>
                    <span>CHECKOUT</span>
                </div>
                <div class="flex flex-col items-center bg-[#fbfbf9] px-6">
                    <div class="w-2.5 h-2.5 border border-gray-300 rounded-full mb-3 bg-[#fbfbf9]"></div>
                    <span>CONFIRMATION</span>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-[1200px] mx-auto w-full px-8 py-10 flex flex-col lg:flex-row gap-16 relative">
        
        <div class="flex-1">
            
            <div x-show="cartItems.length === 0" class="bg-white h-[400px] flex flex-col items-center justify-center shadow-sm" style="display: none;">
                <svg class="w-8 h-8 text-black mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <p class="text-[13px] font-medium text-gray-800 mb-8">Your cart is empty</p>
                <a href="index.php" class="bg-black text-white text-[11px] font-bold tracking-[0.15em] uppercase px-10 py-4 hover:bg-gray-800 transition-colors">
                    CONTINUE SHOPPING
                </a>
            </div>

            <div x-show="cartItems.length > 0">
                <h2 class="text-[14px] tracking-[0.15em] uppercase mb-10 font-medium">
                    YOU HAVE <span x-text="cartItems.length"></span> ITEM(S) IN YOUR CART.
                </h2>
                
                <template x-for="(item, index) in cartItems" :key="index">
                    <div class="flex justify-between border-b border-gray-200 pb-8 mb-8">
                        <div class="flex space-x-6">
                            <div class="w-28 h-28 bg-[#ebe9e4] flex items-center justify-center p-2">
                                <img :src="item.image" class="w-full h-auto mix-blend-multiply">
                            </div>
                            <div>
                                <h3 class="text-[13px] font-medium mb-1" x-text="item.name"></h3>
                                <p class="text-[12px] text-gray-500 mb-0.5" x-text="'Color: ' + item.color"></p>
                                <p class="text-[12px] text-gray-500 mb-0.5" x-text="'Size: ' + item.size"></p>
                                <p class="text-[12px] text-gray-500 mb-4" x-text="'Ref: ' + item.ref"></p>
                                
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300">
                                        <button @click="if(item.quantity > 1) { item.quantity--; updateCart(); }" class="px-3 py-1 text-gray-500 hover:text-black transition-colors">-</button>
                                        <span class="px-3 text-[12px]" x-text="item.quantity"></span>
                                        <button @click="item.quantity++; updateCart();" class="px-3 py-1 text-gray-500 hover:text-black transition-colors">+</button>
                                    </div>
                                    <button @click="removeItem(index)" class="text-[11px] text-gray-500 underline underline-offset-4 hover:text-black transition-colors">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-[12px] text-gray-500">
                            RM <span x-text="(item.price * item.quantity).toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                        </div>
                    </div>
                </template>

                <div class="space-y-4 mb-16">
                    <div class="flex justify-between text-[13px]">
                        <span>Subtotal</span>
                        <span class="text-gray-500">
                            RM <span x-text="subtotal.toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                        </span>
                    </div>
                    <div class="flex justify-between text-[13px]">
                        <div>
                            <p>Shipping</p>
                            <p class="text-gray-400 text-[11px] mt-1">Shipping costs will be calculated during checkout</p>
                        </div>
                        <span class="text-gray-500">-</span>
                    </div>
                    <div class="flex justify-between text-[13px] font-medium pt-4 border-t border-gray-200">
                        <span class="tracking-widest uppercase">TOTAL</span>
                        <span>
                            RM <span x-text="subtotal.toLocaleString('en-US', {minimumFractionDigits: 2})"></span>
                        </span>
                    </div>
                </div>

                <div class="bg-white border border-transparent shadow-sm p-8 mb-10 transition-all duration-300">
                    <div class="flex justify-between items-center" :class="showGifting ? 'mb-6 border-b border-gray-100 pb-4' : ''">
                        <span class="text-[12px] font-bold tracking-[0.15em] uppercase">GIFTING</span>
                        <input type="checkbox" x-model="showGifting" class="hermes-checkbox appearance-none w-4 h-4 border border-gray-300 relative cursor-pointer hover:border-black transition-colors">
                    </div>
                    
                    <div x-show="showGifting" x-transition.opacity.duration.300ms class="space-y-5" style="display: none;">
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="radio" name="gift_type" checked class="hermes-radio w-4 h-4 border border-gray-400 group-hover:border-black transition-colors">
                            <span class="text-[13px] group-hover:text-black">Blank card</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="radio" name="gift_type" class="hermes-radio w-4 h-4 border border-gray-400 group-hover:border-black transition-colors">
                            <span class="text-[13px] group-hover:text-black">Personal message</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer pt-2 group">
                            <input type="checkbox" class="hermes-checkbox appearance-none w-4 h-4 border border-gray-400 relative group-hover:border-black transition-colors">
                            <span class="text-[13px] group-hover:text-black">Hide price on invoice</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button class="w-1/2 bg-black text-white text-[11px] font-bold tracking-[0.15em] uppercase py-4 hover:bg-gray-800 transition-colors">
                        CHECKOUT
                    </button>
                    <button class="w-1/2 bg-white border border-black flex justify-center items-center py-4 hover:bg-gray-50 transition-colors">
                        <span class="text-[15px] font-bold tracking-tighter"> Pay</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[380px] space-y-6">
            <div class="bg-white p-8 shadow-sm">
                <h3 class="text-[12px] font-bold tracking-[0.15em] uppercase mb-6">THE ORANGE BOX</h3>
                <div class="flex space-x-4 items-start">
                    <div class="w-16 h-16 shrink-0 bg-orange-500 flex items-center justify-center p-1">
                        <div class="w-full h-full border border-black/20 relative">
                            <div class="absolute top-1/2 left-0 w-full h-[2px] bg-[#3a2f2d] -translate-y-1/2 transform -rotate-45"></div>
                            <div class="absolute top-1/2 left-0 w-full h-[2px] bg-[#3a2f2d] -translate-y-1/2 transform rotate-45"></div>
                        </div>
                    </div>
                    <p class="text-[12px] text-gray-700 leading-relaxed">
                        All orders are delivered in an orange box tied with a Bolduc ribbon, with the exception of <a href="#" class="underline hover:text-black">certain items</a>
                    </p>
                </div>
            </div>

            <div class="bg-white p-8 shadow-sm">
                <h3 class="text-[12px] font-bold tracking-[0.15em] uppercase mb-6">CUSTOMER SERVICE</h3>
                <p class="text-[11px] text-gray-500 mb-1">Whatsapp Malaysia <a href="#" class="text-black underline">+65 6933 3206</a> Monday to Saturday 09:00 am - 09:00 pm, Sunday 12:00 pm - 09:00 pm :</p>
                <a href="#" class="text-[11px] font-medium text-black underline mb-8 inline-block">1800 819255</a>
                
                <div class="flex justify-between border-t border-gray-100 pt-6">
                    <div class="text-center flex-1">
                        <svg class="w-6 h-6 mx-auto mb-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span class="text-[10px] text-gray-600 block leading-tight">Free standard<br>delivery</span>
                    </div>
                    <div class="text-center flex-1 border-l border-gray-100">
                        <svg class="w-6 h-6 mx-auto mb-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span class="text-[10px] text-gray-600 block leading-tight">Returns &<br>exchanges</span>
                    </div>
                    <div class="text-center flex-1 border-l border-gray-100">
                        <svg class="w-6 h-6 mx-auto mb-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span class="text-[10px] text-gray-600 block leading-tight">Shop securely</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="w-full bg-[#fbfbf9] border-t border-gray-200 mt-auto">
        <div class="max-w-[1400px] mx-auto px-8 py-8 flex justify-between items-center text-[10px] text-gray-600">
            <div class="flex space-x-6">
                <a href="#" class="hover:text-black hover:underline underline-offset-4">General Terms and Conditions of Sale</a>
                <a href="#" class="hover:text-black hover:underline underline-offset-4">General Terms and Conditions of Use</a>
                <a href="#" class="hover:text-black hover:underline underline-offset-4">Privacy & cookies</a>
                <a href="#" class="hover:text-black hover:underline underline-offset-4">Legal issues</a>
                <a href="#" class="hover:text-black hover:underline underline-offset-4">Accessibility</a>
                <a href="#" class="hover:text-black hover:underline underline-offset-4">Site map</a>
            </div>
            <div>© Hermès 2026. All rights reserved.</div>
        </div>
    </footer>
</body>
</html>