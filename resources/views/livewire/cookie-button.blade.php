<div>
    <button type="button" wire:click.prevent="openModal()" class="font-bold cursor-pointer underline text-[15px]">Learn More</button>

<template x-teleport="body">


    <div x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 p-8 flex items-center justify-center z-40">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-75" wire:click="closeModal()"></div>
        <div x-cloak x-show="open"
        x-transition.scale
            class="bg-white p-6 rounded shadow-lg z-40 w-full max-w-[800px] h-full max-h-[720px] scrollbar-custom overflow-y-auto">
            <div class="flex justify-end w-full">
                <button @click="open = false" class=" text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="prose prose-slate prose-xl">
                <h2 class="text-3xl font-bold mb-4">Cookie Policy</h2>
                <p>Types of Cookies We Use</p>
                <p>On our website, we use cookies to make your experience more convenient and improved. Cookies are small files that are stored on your device.</p>
                <h5 class="font-bold">Essential Cookies:</h5>
                <p>These cookies are necessary for the website to function efficiently. We do not collect information from users; we only want to improve our website.</p>
                <h5 class="font-bold">Cookie Settings</h5>
                <p>You can manage the use of cookies through your browser settings. Please feel free to contact us if you have any questions or concerns regarding this cookie policy.</p>
                <h5 class="font-bold">Policy Changes</h5>
                <p>We may update this cookie policy at any time without prior notice. Please check this page regularly to stay informed of any updates.</p>
                <h5 class="font-bold">Contact</h5>
                <p>For more information about our cookie policy, please contact: kemreaksmey444@gmail.com</p>
            </div>
        </div>
    </div>

</template>
</div>
