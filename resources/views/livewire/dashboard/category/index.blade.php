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
                <form wire:ignore.self class="w-full">
                    <div>
                        បង្កើតប្រភេទថ្មី
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900">ឈ្មោះ</label>
                            <input type="text" wire:model="name" id="name" oninput="generateSlug()"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Enter name" />
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900">ស្លក</label>
                            <input type="text" wire:model="slug" id="slug"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Enter slug" />
                            @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">ប្រភេទមេ</label>
                            <select wire:model="parent_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option selected>Choose a category</option>
                                @foreach($parent_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900">ការពិព៍ណនា</label>
                                <textarea wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Description.."></textarea>
                            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <fieldset>
                                <legend class="mb-2">ស្ថានភាព</legend>
                                <div class="flex space-x-4">
                                    <div class="flex items-center mb-4">
                                        <input id="state" checked type="radio" wire:model="state" value="1" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 " checked>
                                        <label for="state" class="block ms-2  text-sm font-medium text-gray-900">
                                          សកម្ម
                                        </label>
                                      </div>

                                      <div class="flex items-center mb-4">
                                        <input id="is_show" type="radio" wire:model="state" value="0" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                        <label for="is_show" class="block ms-2 text-sm font-medium text-gray-900">
                                          អសកម្ម
                                        </label>
                                      </div>

                                </div>
                              </fieldset>

                        </div>
                        <div>
                            <fieldset>
                                <legend class="mb-2">បង្ហាញ?</legend>
                                <div class="flex space-x-4">
                                    <div class="flex items-center mb-4">
                                        <input id="country-option-1" type="radio" wire:model="is_show" value="1" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 " checked>
                                        <label for="country-option-1" class="block ms-2  text-sm font-medium text-gray-900">
                                          បាទ/ចាស៎
                                        </label>
                                      </div>

                                      <div class="flex items-center mb-4">
                                        <input id="country-option-2" type="radio" wire:model="is_show" value="0" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                        <label for="country-option-2" class="block ms-2 text-sm font-medium text-gray-900">
                                          ទេ
                                        </label>
                                      </div>

                                </div>
                              </fieldset>
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
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ឈ្មោះ
                        </th>
                        <th>ស្លក</th>
                        <th>ប្រភេទ</th>
                        <th>ស្ថានភាព</th>
                        <th>បង្ហាញ?</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">សកម្ម</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr
                        class="bg-white border-b hover:bg-gray-50 ">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $category->name }}
                        </td>
                        <td>
                            {{ $category->slug }}
                        </td>
                        <td>
                            @if($category->parent)
                            {{ $category->parent->name }}
                            @endif

                        </td>
                        <td>
                            @if($category->state == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                            @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Inactive</span>
                            @endif

                        </td>
                        <td>
                            @if($category->is_show == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Yes</span>
                            @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $category->id }})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded"><i class="fa-solid fa-pen-to-square"></i></button>
                            {{-- onclick="confirm('Are you sure to delete?')" wire:click="delete({{ $role->id }})" --}}
                            <button onclick="confirmDelete({{ $category->id }})"  class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-3 border border-red-500 hover:border-transparent rounded"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function confirmDelete(categoryId) {
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
                    @this.call('delete', categoryId);
                }
            })
        }

    </script>
    {{-- generate slug --}}
    <script>
        function generateSlug() {
            var name = document.getElementById('name').value;
            var slug = name.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                .replace(/^-+|-+$/g, ''); // Trim leading and trailing hyphens

            @this.set('slug', slug);
        }
    </script>

</div>

