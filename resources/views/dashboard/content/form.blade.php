
    <form wire:ignore.self wire:submit.prevent="save" class="w-full">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                បង្កើតសៀវភៅ
            </h3>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 ">
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ចំណងជើង</label>
                    <input type="text" wire:model="title" id="title" oninput="generateSlug()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter title" />
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ស្លក</label>
                    <input type="text" wire:model="slug" id="slug"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter slug" />
                    @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">អ្នកនិពន្ធ</label>
                    <input type="text" wire:model="author"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter author name" />
                    @error('author') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">កាលបរិច្ឆេទផ្សព្វផ្សាយ</label>
                    <input type="date" wire:model="publication_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter slug" />
                    @error('publication_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">សៀភៅ PDF</label>
                        <input wire:model="pdf_path" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                        {{-- <input type="file" wire:model="pdf_path"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter slug" /> --}}
                    @error('pdf_path') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <div class="mb-4">
                        <label
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">គម្របសៀវភៅ</label>
                        <input wire:model="cover_image_path" wire:model="pdf_path" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            {{-- <input type="file" wire:model="cover_image_path"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter slug" /> --}}
                        @error('cover_image_path') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    @if($editing == true)
                        <div>
                            <label for="">រូបថតដែលមានស្រាប់</label>
                            <img class="w-10 rounded-xl" src="{{ $exist_cover_image_path }}" alt="">
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                    <input type="text" wire:model="isbn"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter slug" />
                    @error('isbn') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ភាសា</label>
                    <input type="text" wire:model="language"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter language" />
                    @error('language') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">អ្នកដាក់ផ្សាយ</label>
                    <input type="text" wire:model="publisher"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter language" />
                    @error('publisher') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                    <input type="text" wire:model="genre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter language" />
                    @error('genre') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ចំនួនទំព័រ</label>
                    <input type="text" wire:model="page_count"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter language" />
                    @error('page_count') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">តម្លៃ</label>
                    <input type="text" wire:model="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter language" />
                    @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ប្រភេទ</label>
                <select wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <fieldset>
                    <legend class="mb-2">ស្ថានភាព</legend>
                    <div class="flex space-x-4">
                        <div class="flex items-center mb-4">
                            <input id="state" checked type="radio" wire:model="state" value="1" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                            <label for="state" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                              Active
                            </label>
                          </div>

                          <div class="flex items-center mb-4">
                            <input id="is_show" type="radio" wire:model="state" value="0" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_show" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                              Inactive
                            </label>
                          </div>

                    </div>
                  </fieldset>
            </div>
            <div class="mb-4">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ការពិពណ៌នា</label>
                    <textarea wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description.."></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ $editing ? 'Update' : 'រក្សាទុក' }}</button>
            <button wire:click="closeModal()" data-modal-hide="create-permission-modal" type="button"
                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
        </div>
    </form>


{{-- generate slug --}}
<script>
    function generateSlug() {
        var name = document.getElementById('title').value;
        var slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
            .replace(/^-+|-+$/g, ''); // Trim leading and trailing hyphens

        @this.set('slug', slug);
    }
</script>

