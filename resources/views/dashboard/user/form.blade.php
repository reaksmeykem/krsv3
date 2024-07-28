<div x-data="{ open: @entangle('isOpen') }" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div> --}}

    <div class="flex justify-between items-center">
        <div>បញ្ជីអ្នកប្រើប្រាស់</div>
        <button @click="open = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fa-solid fa-plus"></i> បង្កើតថ្មី
          </button>
    </div>
    <div
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 overflow-y-auto bg-gray-900/50 ">
        <div class="flex items-end justify-center min-w-full min-h-full p-4 text-center sm:items-center sm:p-0">
            <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            style="min-width:600px;" class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 min-w-screen-lg sm:p-6">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">

                    <button type="button" wire:click="closeModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create User
                    </h3>
                    <div>

                        <form wire:ignore.self wire:submit.prevent="save" class="w-full">

                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">

                                <div class="grid gird-cols-1 gap-2">
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" wire:model="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter name" />
                                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                        <input type="text" wire:model="username"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter username" />
                                        @error('username') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="text" wire:model="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter email" />
                                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>


                                    <div class="mb-4">
                                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                        <select wire:model="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected>Choose a role</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->name }}" @if($role->name == $userRole) selected @endif >{{ $role->name }}</option>
                                            @endforeach
                                          </select>
                                          @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4 {{ $passwordDisabled ? 'hidden' : '' }}">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                        <input type="text" wire:model="password" {{ $passwordDisabled ? 'disabled' : '' }}
                                            class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter name" />
                                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4 {{ $passwordDisabled ? 'hidden' : '' }}">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                        <input type="text" wire:model="confirm_password" {{ $passwordDisabled ? 'disabled' : '' }}
                                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Enter name" />
                                        @error('confirm_password') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Upload Photo</label>
                                        <input type="file" wire:model="photo" class="form-input w-full border border-gray-300 rounded-md rounded-s-none">

                                        @if($editing)
                                            <img class="w-[80px]" src="{{ $existPhoto }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    {{ $editing ? 'Update' : 'Create' }}</button>
                                <button wire:click="closeModal()" data-modal-hide="create-permission-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
