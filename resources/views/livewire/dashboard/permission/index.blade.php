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
    <div x-cloak x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-40">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-75" wire:click="closeModal()"></div>
        <div x-show="open" x-transition
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

    <div>
        <div class="flex justify-between items-center">
            <div>បញ្ជីការអនុញ្ញាត</div>
            <button wire:click="openModal()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                បង្កើតថ្មី
            </button>
        </div>


        {{-- table --}}
        <div>
            <div class="flex flex-wrap justify-between items-center my-6">
                <div class="flex items-center">
                   <select wire:model.live="perPage" class="px-2 border-gray-300 py-1 rounded-md">
                    @foreach($perPageOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                    </select> entries per page
                </div>

                <div>
                    <input
                    type="text"
                    wire:model.live="termSearch"
                    placeholder="Search..."
                    class="border border-gray-300 rounded-md"
                    >
                </div>
            </div>
            <div class="containerPermissions space-y-4">
                @foreach($permissions as $permission)
                    <div class="bg-white p-3 my-3 flex flex-wrap justify-between items-center rounded-lg border">
                        <div>{{ $permission->name }}</div>

                        <div class="flex space-x-3">
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
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between items-center mt-[30px]">
                <div>Showing {{ $countPermissions }} of {{ $totalPermissions }} entries </div>
                @if($countPermissions >= 10)
                    <div class="text-center flex justify-center">
                        @if($permissions->hasMorePages())
                            <div class="border px-6 py-2 bg-white rounded-md">
                                <span role="status" wire:loading wire:target="loadMorePermissions" class="ml-2">
                                    <svg aria-hidden="true" class="inline w-7 h-7 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </span>
                                <button wire:click.prevent="loadMorePermissions">Load more</button>
                            </div>
                        @else
                            <div class="text-slate-300">No more permissions</div>
                        @endif
                    </div>
                    @endif
            </div>

        </div>

    </div>


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
