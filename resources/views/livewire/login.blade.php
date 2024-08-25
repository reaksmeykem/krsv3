<div class="flex justify-center overflow-y-hidden items-center h-screen">

<div>
    <form style="max-width:400px;min-width:400px;" class="bg-white min-w-[620px] max-w-[620px] shadow-md rounded  px-8 py-8 mb-4">
        <div class="text-center text-black font-black mb-5 text-2xl">
            LOGIN
        </div>
        <div class="mb-4">
            <x-input label="Email" wire:model="email" placeholder="Your email" icon="o-user" />
            @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>
        <div class="mb-4">
            <x-input label="Password" wire:model="password" placeholder="Your password" icon="o-eye" type="password" />
            @error('password') <small class="text-red-500">{{ $message }}</small> @enderror

        </div>
        <div class="mb-4">
            <x-checkbox label="Remember me" wire:model="remember"/>
        </div>
        <x-button wire:click.prevent="submit" class="btn-primary w-full">
            Login <span role="status" wire:loading wire:target="submit" class="ml-2"><x-loading /></span>
        </x-button>

        <div class="inline-flex text-center items-center justify-center w-full">
            <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span class="absolute text-center px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2">or</span>
        </div>
        <div>
            <x-button link="{{ route('auth.google') }}" no-wire-navigate class="btn-success w-full">
                Sign in with Google
            </x-button>
        </div>
        <div class="mt-4">
            <x-button link="{{ route('auth.github') }}" no-wire-navigate class="btn-warning w-full">
                Sign in with GitHub
            </x-button>

        </div>
    </form>
</div>
</div>
