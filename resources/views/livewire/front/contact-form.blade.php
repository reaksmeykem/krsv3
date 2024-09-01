<div class="mb-[60px]">
    <div class="pt-4 flex flex-wrap items-center justify-between">
        <h2 class="text-2xl font-black text-[#2196f3]">
            ទំនាក់ទំនង
        </h2>
        <div class="breadcrumbs text-xs">
            <ul>
                <li><a class="text-xs" href="{{ route('home') }}">ទំព័រដើម</a></li>
                <li class="text-xs">ទំនាក់ទំនង</li>
            </ul>
        </div>
    </div>
    <form wire:submit.prevent="store" class="my-6">
        <div class="grid sm:grid-cols-2 gap-8">
            <x-input label="នាមខ្លួន" class="mb-3" wire:model="first_name" />
            <x-input label="នាមត្រកូល" class="mb-3" wire:model="last_name" />
        </div>
        <div class="grid sm:grid-cols-2 gap-8">
            <x-input label="អ៊ីម៉ែល" class="mb-3" wire:model="email" />

            <x-input label="លេខទូរស័ព្ទ" class="mb-3" wire:model="phone" />

        </div>

        <label for="" class="mb-2">គោលបំណង</label>
        <x-textarea
        wire:model="message"
        rows="5"
        class="mb-3 mt-2"
        inline />

        @if (session()->has('error'))
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
          </div>
        @endif
        <!-- hCaptcha Widget -->
        {{-- <div class="h-captcha mb-4" data-sitekey="{{ env('HCAPTCHA_SITE_KEY') }}" data-callback="setCaptchaToken"></div> --}}

        <button type="submit"
            class="btn bg-[#1d80d1] hover:bg-[#2196f3] text-white px-8">
            បញ្ជូន
      </button>
    </form>


    {{-- <script>
        function setCaptchaToken(token) {
            // Set the token to Livewire component
            @this.set('captcha', token);
        }
        // Listen for Livewire events to reset CAPTCHA
        window.addEventListener('reset-captcha', () => {
            resetCaptcha();
        });

        function resetCaptcha() {
            if (typeof hcaptcha !== 'undefined') {
                hcaptcha.reset();
            }
        }
    </script> --}}

</div>

