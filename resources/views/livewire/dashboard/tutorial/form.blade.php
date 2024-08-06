{{-- form --}}
<div x-cloak x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-40">
    <div class="fixed inset-0 bg-slate-900 bg-opacity-75" wire:click="closeModal()"></div>
    <div x-show="open" x-transition
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
                    {{-- <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">ប្រភេទមេ</label>
                        <select wire:model="parent_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option selected>Choose a category</option>
                            @foreach($parent_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
