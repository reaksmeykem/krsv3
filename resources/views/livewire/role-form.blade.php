<div>
    <!-- HEADER -->
    <x-header title="Role" separator progress-indicator>
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

    <x-modal persistent wire:model="roleModal"  class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[600px]">
        <x-header class="mb-3" title="{{ $editing ? 'Edit' :'Create' }} Role" separator progress-indicator ... />
        <div>
            <div class="col-span-2">
                <x-input label="Name" class="mb-3" wire:model="name" />
            </div>
            <div>
                <label class="pb-3">Permissions</label>
                @foreach($permissions as $permission)
                    <x-toggle
                    class="my-2"
                    label="{{ $permission->name }}"
                    wire:model="selectedPermission"
                    value="{{ $permission->name }}"
                    :checked="in_array($permission->name, $selectedPermission)"
                    />
                @endforeach
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

    <x-modal title="Are you sure?" wire:model="roleModalConfirm" class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[600px]">
        <div>Click "cancel" or press ESC to exit.</div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.roleModalConfirm = false" />
            <x-button label="Delete" wire:click="delete" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$roles" :sort-by="$sortBy">
            @scope('actions', $role)
                <x-button icon="c-pencil-square"  wire:click="edit({{ $role['id'] }})" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="deleteConfirm({{ $role['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
            @scope('cell_permissions', $role)
                @foreach($role->permissions as $permission)
                    <x-badge :value="$permission->name" class="badge-primary my-2" />
                @endforeach
            @endscope
        </x-table>
        <div class="mt-4">
            {{ $roles->links() }}
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
