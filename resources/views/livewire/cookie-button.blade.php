<div>
    <button type="button" wire:click.prevent="openModal()" class="font-bold cursor-pointer underline text-[15px]">ស្វែង​យល់​បន្ថែម</button>

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
                <h2 class="text-3xl font-bold mb-4">គោលការណ៍ Cookie Policy</h2>
                <p>ប្រភេទនៃ Cookies ដែលយើងប្រើ</p>
                <p>នៅក្នុងគេហទំព័ររបស់យើង, យើងប្រើប្រាស់ cookies ដើម្បីធ្វើឲ្យការប្រើប្រាស់របស់អ្នកមានភាពងាយស្រួល និងប្រសើរឡើង។ cookies គឺជាឯកសារតូចៗដែលត្រូវបានផ្ទុកនៅលើឧបករណ៍របស់អ្នក។</p>
                <h5 class="font-bold">១. Essential Cookies:</h5>
                <p>Cookies ទាំងនេះត្រូវការសម្រាប់ការប្រើប្រាស់គេហទំព័រដោយសម្រួល និងឧបត្ថម្ភបច្ចេកទេសដូចជាការចូលប្រើប្រាស់សេវាកម្ម។</p>
                <h5 class="font-bold">២. Analytics Cookies:</h5>
                <p>យើងប្រើប្រាស់ Cookies សម្រាប់ការវិភាគដើម្បីប្រមូលព័ត៌មានអំពីការប្រើប្រាស់គេហទំព័ររបស់អ្នក។ វាជួយយើងក្នុងការយល់ដឹងអំពីរបៀបដែលអ្នកប្រើប្រាស់គេហទំព័រ និងការកែលម្អបទពិសោធន៍របស់អ្នក។</p>
                <h5 class="font-bold">ការកំណត់ cookies</h5>
                <p>អ្នកអាចចាត់ចែងការប្រើប្រាស់ cookies បានតាមការកំណត់នៅក្នុងកម្មវិធីរុករករបស់អ្នក។ យើងសូមអនុញាតឱ្យអ្នកទំនាក់ទំនងមកកាន់យើងប្រសិនបើអ្នកមានសំណួរឬការចងចាំទាក់ទងនឹងគោលការណ៍ cookies នេះ។</p>
                <h5 class="font-bold">ការប្រតិបត្តិការណ៍កែប្រែ</h5>
                <p>យើងអាចធ្វើការកែប្រែគោលការណ៍ cookies នេះនៅពេលណាមួយដោយមិនប្រកាសជាផ្លូវការ។ សូមពិនិត្យមើលទំព័រនេះជាប្រចាំដើម្បីទទួលបានព័ត៌មានបច្ចុប្បន្នភាព។</p>
                <h5 class="font-bold">ទំនាក់ទំនង</h5>
                <p>សម្រាប់ព័ត៌មានបន្ថែមអំពីគោលការណ៍ cookies របស់យើង, សូមទំនាក់ទំនងមកកាន់: kemreaksmey444@gmail.com</p>
            </div>
        </div>
    </div>

</template>
</div>
