<div>
    {{-- breadcrumb --}}
    <nav class="flex my-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    ផ្ទាំងគ្រប់គ្រង
                </a>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">ការអនុញ្ញាត</span>
                </div>
            </li>
        </ol>
    </nav>
    {{-- end breadcrumb --}}

    {{-- form --}}
    <div x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-40">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-75" wire:click="closeModal()"></div>
        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="bg-white p-6 rounded shadow-lg z-40 my-8 w-full lg:w-1/3 overflow-y-auto max-h-screen">
            <div>
                <form class="w-full">
                    <div>
                        បង្កើតការអនុញ្ញាត
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">

                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900">ឈ្មោះ</label>
                            <input type="text" wire:model="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Enter name" />
                            @error('name')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </form>
                <div class="sm:flex sm:flex-row-reverse">
                    <button type="submit" wire:click.prevent="save"
                        class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">{{ $editing ? 'រក្សាទុក' : 'រក្សាទុក' }}</button>
                    <button type="button" wire:click="closeModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">ចាកចេញ</button>
                </div>
            </div>
        </div>
    </div>
    {{-- endform --}}

    <div class="bg-white p-8 rounded-xl">
        <div class="flex justify-between items-center">
            <div>បញ្ជីការអនុញ្ញាត</div>
            <button wire:click="openModal()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                បង្កើតថ្មី
            </button>
        </div>

        {{-- table --}}
        <div class="relative overflow-x-auto sm:rounded-lg mt-8">
            <table class="w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th>ID</th>
                        <th scope="col" class="px-6 py-3">
                            ឈ្មោះ
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody wire:poll.2s="loadPermissions" id="permission-container">
                    @foreach ($permissions as $permission)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $permission->id }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $permission->name }}
                            </td>


                            <td class="px-6 py-4 text-right space-x-2">
                                @can('edit permission')
                                    <button wire:click="edit({{ $permission->id }})"
                                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded"
                                        data-tooltip-target="tooltip-edit" data-tooltip-placement="left">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <div id="tooltip-edit" role="tooltip"
                                        class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Edit
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                @endcan
                                @can('delete permission')
                                    <button onclick="confirmDelete({{ $permission->id }})"
                                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-3 border border-red-500 hover:border-transparent rounded"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:load', function() {
            var chatContainer = document.getElementById('permissions-container');

            Livewire.hook('message.processed', (message, component) => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            });
        });
    </script>
    <script>
        function confirmDelete(permissionId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', permissionId);
                }
            })
        }
    </script>

</div>
