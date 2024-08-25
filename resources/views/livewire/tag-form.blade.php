<div>
    <!-- HEADER -->
    <x-header title="Tag List" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
        <x-slot:actions>
            <x-button label="Create" @click="$wire.openModal()"   spinner class=" btn-success" />
        </x-slot:actions>
    </x-header>

    <x-modal persistent wire:model="tagModal"  class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[600px]">
        <x-header class="mb-3" title="{{ $editing ? 'Edit' :'Create' }} Tag" separator progress-indicator ... />
        <div>
            <div class="col-span-2">
                <x-input label="Name" class="mb-3" wire:model.live="name" />
                <x-input label="Slug" class="mb-3" wire:model="slug" />
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

    <x-modal title="Are you sure?" wire:model="tagModalConfirm" class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[600px]">
        <div>Click "cancel" or press ESC to exit.</div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.tagModalConfirm = false" />
            <x-button label="Delete" wire:click="delete" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$tags" :sort-by="$sortBy">
            @scope('actions', $tag)
                <x-button icon="c-pencil-square"  wire:click="edit({{ $tag['id'] }})" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="deleteConfirm({{ $tag['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
        <div class="mt-4">
            {{ $tags->links() }}
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
</div>
