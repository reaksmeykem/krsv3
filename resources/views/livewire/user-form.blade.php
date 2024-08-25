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

    <x-modal persistent wire:model="userModal"  class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[900px]">
        <x-header class="mb-3" title="{{ $editing ? 'Edit' :'Create' }} User" separator progress-indicator ... />
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <div class="col-span-2">
                <x-input label="Name" class="mb-3" wire:model="name" />
                <x-input label="Email" class="mb-3" wire:model="email" />
                <x-input type="password" label="Password" class="mb-3" wire:model="password" />
                <x-input type="password" label="Confirm Password" class="mb-3" wire:model="password_confirmation" />
                <x-select
                label="Role"
                wire:model="role"
                placeholder="Select a role"
                option-value="name"
                :options="$roles"
                single
                 />
                <x-file wire:model="photo" class="mb-3" label="Photo" />
            </div>
            <div>
                <div class="mt-6">
                    @if($photo || $editing)
                        @if($tempUrl)
                            <img class="w-full rounded-lg" src="{{ $tempUrl }}" alt="" />
                        @else
                            <img class="w-full rounded-lg" src="{{ $photo }}" alt="" />
                        @endif
                    @else
                        <img class="w-full rounded-lg" src="https://images.unsplash.com/photo-1576158114254-3ba81558b87d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" />
                    @endif
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

    <x-modal title="Are you sure?" wire:model="userModalConfirm" class="backdrop-blur" box-class="bg-red-50 p-10 w-1200">
        <div>Click "cancel" or press ESC to exit.</div>
        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.userModalConfirm = false" />
            <x-button label="Delete" wire:click="delete" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy">
            @scope('actions', $user)
                <x-button icon="c-pencil-square"  wire:click="edit({{ $user['id'] }})" spinner class="btn-ghost btn-sm text-blue-500" />
                <x-button icon="o-trash" wire:click="deleteConfirm({{ $user['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
            @endscope
            @scope('cell_roles', $user)
                @foreach($user->roles as $role)
                    <x-badge :value="$role->name" class="badge-primary my-2" />
                @endforeach
            @endscope

            @scope('cell_photo', $user)
                <x-avatar image="{{ Storage::url($user->photo) ?? '/empty-user.jpg' }}" class="!w-10" />
            @endscope

        </x-table>
        <div class="mt-4">
            {{ $users->links() }}
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
