<div>
    <!-- HEADER -->
    <x-header title="Content List" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
        <x-slot:actions>
            {{-- <x-button label="Create" @click="$wire.openModal()" spinner class=" btn-success" /> --}}
            <x-button label="Create" link="{{ route('post.create') }}" no-wire-navigate spinner class=" btn-success" />
        </x-slot:actions>
    </x-header>

    <x-modal persistent wire:model="postModal"  class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[1200px]">
        <x-header class="mb-3" title="{{ $editing ? 'Edit' :'Create' }} Post" separator progress-indicator ... />

        <div class="grid lg:grid-cols-4 lg:gap-8">
            <div class="col-span-3">
                <div class="grid lg:grid-cols-2 lg:gap-8">
                    <div>
                        <x-input label="Title" class="mb-3" wire:model.live="title" />
                    </div>
                    <div>
                        <x-input label="Slug" class="mb-3" wire:model="slug" />
                    </div>
                </div>
                <x-textarea
                    label="Description"
                    wire:model="description"
                    rows="3"
                    />
                <div class="mb-3">
                    {{-- <x-tags label="Tags" wire:model="tags" hint="Hit enter to create a new tag" /> --}}
                    <x-choices
                    label="Tags"
                    wire:model="tagsIds"
                    :options="$listTags"
                    search-function="searchTags"
                    no-result-text="Ops! Nothing here ..."
                    searchable multiple>
                        <x-slot:append>
                            <x-button label="Create" icon="o-plus" class="rounded-s-none btn-primary" />
                        </x-slot:append>
                    </x-choices>
                </div>

                <div class="mb-4" wire:ignore>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Body</label>
                    <textarea
                    wire:ignore
                    wire:model="body"
                    rows="3"
                    id="body"
                    class="form-control my-editor block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>




            </div>
            <div>
                <x-datetime label="Schedule" wire:model="published_at" icon="o-calendar" />
                <x-select
                label="Category"
                option-value="id"
                :options="$categories"
                placeholder="Select a category"
                placeholder-value="0"
                wire:model="categoryId" />
                <div class="my-3">
                    <x-toggle label="State" class="my-3" wire:model="state" :checked="$status === 1"/>
                    <x-toggle label="Featured" class="my-3" wire:model="featured" :checked="$featured === 1"/>
                    <x-toggle label="isComment?" class="my-3" wire:model="isComment" :checked="$isComment === 1"/>
                </div>

                <div class="mt-3">
                    <x-input label="Ordering" class="mb-3" wire:model="ordering" />
                    <x-input label="Meta Title" class="mb-3" wire:model="metaTitle" />
                </div>
                <x-textarea
                    label="Meta Description"
                    wire:model="metaDescription"
                    rows="3"
                    />
                    <div class="mb-4" progress-indicator>
                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Thumbnail</label>
                        <div class="flex space-x-6 items-center">
                            <div class="shrink-0">
                                @if($editing)
                                    @if($tempUrl)
                                    <div class="mt-2">
                                        <img src="{{ $tempUrl }}" alt="Preview"
                                            class="h-16 w-16 object-cover rounded">
                                    </div>
                                    @else
                                    <img class="h-16 w-16 object-cover rounded" src="{{ $thumbnailExists }}"
                                        alt="Current profile photo" />
                                    @endif
                                @else
                                    @if($tempUrl)
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
                                <input type="file" wire:model.live="thumbnail"
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

        <div class="mt-4 space-x-4 flex justify-end">
            <x-button label="Close" @click="$wire.closeModal()"  spinner class=" btn-primary" />
            @if($editing)
            <x-button label="Update" wire:click="update" spinner class=" btn-success" />
            @else
            <x-button label="Create" wire:click="create" spinner class=" btn-success" />
            @endif
        </div>
    </x-modal>

    <x-modal title="Are you sure?" wire:model="postModalConfirm" class="backdrop-blur" box-class="bg-red-50 p-10 w-1200">
        <div>Click "cancel" or press ESC to exit.</div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.postModalConfirm = false" />
            <x-button label="Delete" wire:click="delete" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$posts" :sort-by="$sortBy">
            @scope('actions', $post)
                <x-button icon="c-pencil-square" link="{{ route('post.edit', $post['id']) }}" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="deleteConfirm({{ $post['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
            @scope('cell_category_id', $post)
                <x-badge :value="$post->category ? $post->category->name : 'Root'" />
            @endscope
            @scope('cell_status', $post)
                <x-badge :value="$post->status == 1 ? 'Active': 'Inactive'" class="{{$post->status == 1 ? 'badge-primary': 'badge-error' }}" />
            @endscope

            @scope('cell_thumbnail_path', $post)
                <x-avatar image="{{ Storage::url($post->thumbnail_path) ?? '/empty-user.jpg' }}" class="!w-10 !rounded-lg" />
            @endscope
        </x-table>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    {{-- Include TinyMCE script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.9/tinymce.min.js"
        integrity="sha512-y1l3DKVl9YKQjMEsJOdhEsHrvcm7anV9XjiHxXbjO0qojCnro9pbUPvJtobOTtK+eZjaAGXKBG/XhWnrTgV34Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var editor_config = {
            path_absolute: "/",
            selector: '#body',
            relative_urls: false,
            height: '740px',
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern codesample"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | codesample",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            },
            setup: function(editor) {
                editor.on('change', function(e) {
                    @this.set('body', editor.getContent());
                });
            }

        };

        initializeTinymce();

        function initializeTinymce() {
            tinymce.remove('textarea.my-editor'); // Remove any existing instance
            tinymce.init(editor_config);// Initialize with config

        }

        document.addEventListener('livewire:load', function() {
            initializeTinymce(); // Initialize TinyMCE on page load

            Livewire.hook('message.processed', (message, component) => {
                initializeTinymce();
            });

            window.addEventListener('clear-tinymce', function () {
                tinymce.get('mytextarea').setContent(''); // Clear the editor content
            });
        });
    </script>

</div>

