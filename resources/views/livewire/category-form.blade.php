<div>
    <!-- HEADER -->
    <x-header title="User" separator progress-indicator>
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

    <x-modal persistent wire:model="categoryModal"  class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[600px]">
        <x-header class="mb-3" title="{{ $editing ? 'Edit' :'Create' }} User" separator progress-indicator ... />
        <div>
            <div class="col-span-2">
                <x-input label="Name" class="mb-3" wire:model.live="name" />
                <x-input label="Slug" class="mb-3" wire:model="slug" />
                <x-select
                label="Parent Category"
                option-value="id"
                :options="$parentCategories"
                placeholder="Select a category"
                placeholder-value="0"
                wire:model="parentId" />
                <div class="my-3">
                    <x-toggle label="State" class="my-3" wire:model="state" :checked="$state === 1"/>
                    <x-toggle label="isShow" wire:model="isShow" :checked="$isShow === 1" />
                </div>
                <x-textarea
                    label="Description"
                    wire:model="description"
                    rows="5"
                   />
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

    <x-modal title="Are you sure?" wire:model="categoryModalConfirm" class="backdrop-blur" box-class="bg-red-50 p-10 w-1200">
        <div>Click "cancel" or press ESC to exit.</div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.categoryModalConfirm = false" />
            <x-button label="Delete" wire:click="delete" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$categories" :sort-by="$sortBy">
            @scope('actions', $category)
                <x-button icon="c-pencil-square"  wire:click="edit({{ $category['id'] }})" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="deleteConfirm({{ $category['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
            @scope('cell_parent_id', $category)
                <x-badge :value="$category->parent ? $category->parent->name : 'Root'" />
            @endscope
            @scope('cell_state', $category)
                <x-badge :value="$category->state == 1 ? 'Active': 'Inactive'" class="{{$category->state == 1 ? 'badge-primary': 'badge-error' }}" />
            @endscope
            @scope('cell_is_show', $category)
                <x-badge :value="$category->is_show == 1 ? 'Show': 'Hide'" class="{{$category->is_show == 1 ? 'badge-primary': 'badge-error' }}" />
            @endscope
        </x-table>
        <div class="mt-4">
            {{ $categories->links() }}
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

