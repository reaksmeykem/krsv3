<div x-data="{ open: @entangle('showChangePasswordModal') }" class="relative" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity" aria-hidden="true"></div>
    <button wire:click="changePassword({{ $user->id }})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded">
        <i class="fa-solid fa-lock"></i>
    </button>
    <div x-show="open" class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-w-full min-h-full p-4 text-center sm:items-center sm:p-0">
            <div x-show="open" style="min-width:600px;" class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 min-w-[350px] sm:min-w-[600px] sm:p-6">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button type="button" wire:click="closeChangePasswordModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        កំណត់ពាក្យសម្ងាត់ឡើងវិញ
                    </h3>
                    <div>

                        <form wire:ignore.self wire:submit.prevent="resetPassword()" class="w-full">

                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">

                                <div class="grid gird-cols-1 gap-2">
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ពាក្យសំងាត់​បច្ចុប្បន្ន</label>
                                        <input type="password" wire:model="current_password"
                                            class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter current password" />
                                        @error('current_password') <small class="text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ពាក្យសំងាត់​ថ្មី</label>
                                        <input type="password" wire:model="new_password"
                                            class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter new password" />
                                        @error('new_password') <small class="text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ផ្ទៀងផ្ទាត់​ពាក្យសំងាត់ថ្មី</label>
                                        <input type="password" wire:model="confirm_new_password"
                                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter confirm new password" />
                                        @error('confirm_new _password') <small class="text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Reset</button>
                                <button wire:click="closeChangePasswordModal()" data-modal-hide="create-permission-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">ចាកចេញ</button>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
