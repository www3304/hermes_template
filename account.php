<?php include 'header.php'; ?>

<style>
    /* Custom Checkbox */
    .hermes-custom-checkbox {
        appearance: none;
        width: 16px;
        height: 16px;
        border: 1px solid #9ca3af;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background-color: transparent;
        transition: all 0.2s;
    }
    .hermes-custom-checkbox:checked {
        border-color: #000;
    }
    .hermes-custom-checkbox:checked::after {
        content: '✓';
        color: #000;
        font-size: 12px;
        font-weight: bold;
    }
</style>

<main class="min-h-[70vh] bg-[#fbfbf9] pt-[120px] pb-24" 
      x-data="{ 
          step: 1, 
          email: '', 
          verificationCode: '',
          title: '',
          firstName: '',
          lastName: '',
          phone: '',
          password: '',
          isAgreed: false,
          passwordVisible: false,

          get isEmailValid() {
              const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
              return re.test(this.email);
          },

          get passwordRules() {
              return {
                  length: this.password.length >= 10,
                  number: /\d/.test(this.password),
                  upper: /[A-Z]/.test(this.password),
                  lower: /[a-z]/.test(this.password),
                  special: /[!@#$%^&*(),.?&quot;:{}|<>]/.test(this.password)
              }
          },

          get isPasswordStrong() {
              return Object.values(this.passwordRules).every(Boolean);
          },

          get isFormValid() {
              return this.isEmailValid && 
                     this.verificationCode.length > 0 &&
                     this.isPasswordStrong && 
                     this.title && 
                     this.firstName && 
                     this.lastName && 
                     this.phone.length >= 8 && 
                     this.isAgreed;
          }
      }">

    <div x-show="step === 1" 
         x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         class="max-w-[700px] mx-auto bg-white p-12 md:p-16 shadow-sm mt-8">
        
        <h2 class="text-[13px] tracking-[0.15em] uppercase mb-12 font-medium">ACCOUNT</h2>
        <p class="text-[13px] text-gray-800 mb-8">Please enter your email below to access or create your account</p>
        
        <div class="mb-10">
            <label class="block text-[11px] text-gray-500 mb-1">E-mail *</label>
            <input type="email" x-model="email" 
                   class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] transition-colors"
                   :class="email && !isEmailValid ? 'border-red-400' : ''">
            <p class="text-[11px] mt-2" :class="email && !isEmailValid ? 'text-red-500' : 'text-gray-500'">
                Expected format: yourname@domain.com
            </p>
        </div>
        
        <div class="flex justify-center">
            <button @click="if(isEmailValid) step = 2" 
                    :disabled="!isEmailValid"
                    class="bg-black text-white text-[11px] font-bold tracking-[0.15em] uppercase px-16 py-4 transition-all"
                    :class="!isEmailValid ? 'opacity-30 cursor-not-allowed' : 'hover:bg-gray-800'">
                CONTINUE
            </button>
        </div>
    </div>

    <div x-show="step === 2" 
         x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         class="max-w-[1200px] mx-auto px-8 mt-8" style="display: none;">
        
        <h2 class="text-[15px] tracking-[0.15em] uppercase mb-4 font-medium">CREATE AN ACCOUNT</h2>
        <p class="text-[12px] text-gray-800 mb-12 leading-relaxed">
            By creating an account, you agree to accept the <a href="#" class="underline hover:text-gray-500">General Terms and Conditions of Use</a> and that your data will be processed in compliance with the <a href="#" class="underline hover:text-gray-500">Privacy Policy</a> of Hermès.
        </p>
        
        <div class="flex flex-col md:flex-row gap-x-20 gap-y-12">
            
            <div class="w-full md:w-1/2">
                <h3 class="text-[14px] font-bold mb-8 uppercase">Login information</h3>
                
                <div class="flex items-end gap-4 mb-6">
                    <div class="flex-1">
                        <label class="block text-[11px] text-gray-500 mb-1">E-mail *</label>
                        <input type="email" x-model="email" readonly class="w-full bg-transparent border-0 border-b border-gray-200 outline-none py-2 text-[13px] text-gray-600">
                    </div>
                    <button @click="verificationCode = '123456'" type="button" class="bg-black text-white text-[10px] font-bold tracking-[0.1em] uppercase px-6 py-[14px] shrink-0 hover:bg-gray-800 transition-colors">
                        SEND CODE
                    </button>
                </div>

                <div class="bg-[#fbfbf9] p-4 mb-6 border-b border-gray-200">
                    <label class="block text-[11px] text-gray-500 mb-1">Verification code *</label>
                    <input type="text" x-model="verificationCode" class="w-full bg-transparent border-none outline-none py-1 text-[13px]">
                    <p class="text-[11px] text-gray-500 mt-1">Expected format: 123456</p>
                </div>

                <div class="mb-4 relative">
                    <label class="block text-[11px] text-gray-500 mb-1">Password *</label>
                    <input :type="passwordVisible ? 'text' : 'password'" x-model="password"
                           class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] pr-12 transition-colors">
                    <button @click="passwordVisible = !passwordVisible" class="absolute right-0 top-6 text-[11px] font-medium underline hover:text-gray-500">
                        <span x-text="passwordVisible ? 'Hide' : 'Show'"></span>
                    </button>
                </div>

                <div class="bg-[#fbfbf9] p-4 text-[11px] text-gray-500 leading-relaxed">
                    <p class="mb-3">For your security, we invite you to fill your password according to the following criteria:</p>
                    <div class="grid grid-cols-2 gap-y-2">
                        <span class="transition-colors" :class="passwordRules.length ? 'text-green-600' : ''">At least 10 characters</span>
                        <span class="transition-colors" :class="passwordRules.number ? 'text-green-600' : ''">At least 1 number</span>
                        <span class="transition-colors" :class="passwordRules.upper ? 'text-green-600' : ''">At least 1 uppercase letter</span>
                        <span class="transition-colors" :class="passwordRules.special ? 'text-green-600' : ''">At least 1 special character</span>
                        <span class="transition-colors" :class="passwordRules.lower ? 'text-green-600' : ''">At least 1 lowercase letter</span>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-[14px] font-bold">Personal information</h3>
                    <span class="text-[11px] text-gray-500">* Required information</span>
                </div>

                <div class="mb-6 relative">
                    <label class="block text-[11px] text-gray-500 mb-1">Title *</label>
                    <select x-model="title" class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] appearance-none cursor-pointer">
                        <option value=""></option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                    </select>
                    <svg class="w-3 h-3 absolute right-0 top-7 pointer-events-none text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>

                <div class="mb-6">
                    <label class="block text-[11px] text-gray-500 mb-1">First name *</label>
                    <input type="text" x-model="firstName" class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px]">
                </div>
                
                <div class="mb-6">
                    <label class="block text-[11px] text-gray-500 mb-1">Last name *</label>
                    <input type="text" x-model="lastName" class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px]">
                </div>

                <div class="flex gap-4 mb-6">
                    <div class="w-1/3 relative">
                        <label class="block text-[11px] text-gray-500 mb-1">Area code *</label>
                        <select class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] appearance-none">
                            <option>🇲🇾 MY +60</option>
                        </select>
                        <svg class="w-3 h-3 absolute right-0 top-7 pointer-events-none text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="w-2/3">
                        <label class="block text-[11px] text-gray-500 mb-1">Telephone number *</label>
                        <input type="tel" x-model="phone" 
                               @input="phone = phone.replace(/[^0-9]/g, '')"
                               class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px]">
                        <p class="text-[11px] text-gray-500 mt-2">Expected format: phone number with at least 8 digits</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[11px] text-gray-500 mb-1">Date of birth</label>
                    <div class="flex gap-4">
                        <div class="w-1/3 relative">
                            <select class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] text-gray-500 appearance-none">
                                <option value="" disabled selected>Month</option>
                                <option>01</option><option>02</option><option>03</option><option>04</option><option>05</option><option>06</option>
                                <option>07</option><option>08</option><option>09</option><option>10</option><option>11</option><option>12</option>
                            </select>
                            <svg class="w-3 h-3 absolute right-0 top-3 pointer-events-none text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        <div class="w-1/3">
                            <input type="text" placeholder="Day" class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] placeholder-gray-500">
                        </div>
                        <div class="w-1/3">
                            <input type="text" placeholder="Year" class="w-full bg-transparent border-0 border-b border-gray-300 focus:border-black outline-none py-2 text-[13px] placeholder-gray-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <label class="flex items-start space-x-4 cursor-pointer mb-2">
                <input type="checkbox" x-model="isAgreed" class="hermes-custom-checkbox mt-0.5 shrink-0">
                <span class="text-[12px] text-gray-800 leading-relaxed">
                    I agree to receive information by email about offers, services, products and events from Hermes or other group companies, in accordance with the <a href="#" class="underline hover:text-gray-500">Privacy Policy</a>.
                </span>
            </label>
            <p class="text-[12px] text-gray-500 mb-12 pl-[32px]">
                You can unsubscribe from email marketing communications via the "Unsubscribe" link at the bottom of each of our email promotional communications.
            </p>

            <div class="flex justify-center border-t border-gray-200 pt-12">
                <button @click="if(isFormValid) step = 3"
                        :disabled="!isFormValid"
                        class="text-white text-[11px] font-bold tracking-[0.15em] uppercase px-16 py-4 transition-all"
                        :class="!isFormValid ? 'bg-gray-300 cursor-not-allowed' : 'bg-black hover:bg-gray-800'">
                    CREATE AN ACCOUNT
                </button>
            </div>
        </div>
    </div>

    <div x-show="step === 3" 
         x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
         class="max-w-[600px] mx-auto text-center bg-white p-16 shadow-sm mt-8" style="display: none;">
        <div class="mb-8 flex justify-center">
            <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h2 class="text-3xl font-light mb-4 italic font-serif" style="font-family: 'Times New Roman', Times, serif;">Welcome, <span x-text="firstName"></span></h2>
        <p class="text-[13px] text-gray-500 mb-12 leading-relaxed">Your account has been successfully created. You can now track your orders and manage your personal information.</p>
        
        <a href="index.php" class="inline-block border border-black text-black text-[11px] font-bold tracking-[0.15em] uppercase px-16 py-4 hover:bg-black hover:text-white transition-colors">
            RETURN TO HOMEPAGE
        </a>
    </div>

</main>

<?php include 'footer.php'; ?>