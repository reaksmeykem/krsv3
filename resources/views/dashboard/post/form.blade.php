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
            <form wire:ignore class="w-full">
                <div>
                    បង្កើតប្លុកថ្មី
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-1 lg:grid-cols-1 gap-2">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900">ចំណងជើង</label>
                                <input type="text" id="title" wire:model="title" oninput="generateSlug()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter title" />
                                @error('title')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900">ស្លក</label>
                                <input type="text" wire:model="slug"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter slug" />
                                @error('slug')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6 ">

                            <div class="mb-4 col-span-2">
                                <div>

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900">ការពិពណ៍នា</label>
                                        <textarea wire:model="excerpt" id="message" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Enter excerpt..."></textarea>
                                        @error('excerpt')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4" wire:ignore>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">មាតិកា</label>
                                        <textarea wire:ignore wire:model="body" rows="3"
                                            class="form-control my-editor block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>

                                </div>

                            </div>
                            <div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">ប្រភេទ</label>
                                    <select id="category" wire:model="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected>ជ្រើសរើសប្រភេទ</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900">កាលបរិច្ឆេទផ្សព្វផ្សាយ</label>
                                    <div class="relative max-w-sm">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 00" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input wire:model="published_at" id="datepicker-actions" datepicker
                                            datepicker-buttons datepicker-autoselect-today type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                            placeholder="Select date">
                                    </div>
                                    @error('published_at')
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:model="allowComments" class="sr-only peer" checked>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">ផ្តល់មតិ</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:model="isFeatured" class="sr-only peer" checked>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">លក្ខណៈពិសេស</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">ស្ថានភាព</label>
                                    <select id="category" wire:model="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected>ជ្រើសរើស</option>
                                        <option value="Published">Published</option>
                                        <option value="Draft">Draft</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">លំដាប់</label>
                                    <input type="text" wire:model="order"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter order" />
                                    @error('order')
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">ពាក្យគន្លឺះ</label>
                                    @include('dashboard.post.tagsinput')
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">ចំណងជើង Meta</label>
                                    <input type="text" wire:model="metaTitle"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter meta title" />

                                </div>

                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">ការពិពណ៍នា Meta</label>
                                    <textarea id="message" wire:model="metaExcerpt" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter meta excerpt..."></textarea>

                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Thumbnail</label>
                                    <div class="flex space-x-6 items-center">
                                        <div class="shrink-0">

                                            @if ($editing)
                                                <img class="h-16 w-16 object-cover rounded" src="{{ $existPhoto }}"
                                                    alt="Current profile photo" />
                                            @else
                                                @if ($tempUrl)
                                                    <div class="mt-2">
                                                        <img src="{{ $tempUrl }}" alt="Preview"
                                                            class="h-16 w-16 object-cover rounded">
                                                    </div>
                                                @else
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/photos/13/defaultphoto/no-photo.jpg') }}"
                                                            alt="Preview" class="h-16 w-16 object-cover rounded">
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <label class="block">
                                            <span class="sr-only">Choose profile photo</span>
                                            <input type="file" wire:model="thumbnail"
                                                class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                " />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="sm:flex sm:flex-row-reverse">
                <button type="submit" wire:click.prevent="save()"
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">{{ $editing ? 'រក្សាទុក' : 'រក្សាទុក' }}</button>
                @if(!$editing)
                    <button type="submit" wire:click.prevent="save_and_new()"
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">រក្សាទុក និងបង្កើតថ្មី</button>
                @endif
                <button type="button" wire:click="closeModal()"
                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">ចាកចេញ</button>
            </div>
        </div>
    </div>
</div>


