<div class="relative mb-4">

    <input type="text" wire:model.defer="textInput" wire:keydown.enter="addTag"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="Enter some tags and press enter">
    <button wire:click.prevent="addTag" class="absolute right-0 top-0 mt-2 mr-2 bg-blue-500 text-white px-3 py-1 rounded">
        Add
    </button>

</div>

<div class="flex flex-wrap mt-2">
    @if($editing)
        @foreach($existTags as $index => $tag)
            <div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
                <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs">{{ $tag->name }}</span>
                <button wire:click.prevent="removeExistTag({{ $tag->id }})"
                        class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"/>
                    </svg>
                </button>
            </div>
        @endforeach
    @endif
    @foreach($tags as $index => $tag)
        <div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
            <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs">{{ $tag }}</span>
            <button wire:click.prevent="removeTag({{ $index }})"
                    class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                          d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"/>
                </svg>
            </button>
        </div>
    @endforeach
</div>
