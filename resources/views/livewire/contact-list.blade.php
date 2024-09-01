<div>
    <!-- HEADER -->
    <x-header title="Contact List" separator progress-indicator>
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

    <x-modal persistent wire:model="contactModal"  class="backdrop-blur" box-class="bg-red-50 p-10 max-w-[600px]">
        <x-header class="mb-3" title="Show Contact" separator progress-indicator ... />
        <div>
            <div class="col-span-2">
                <x-input label="First Name" readonly class="mb-3" wire:model="firstName" />
                <x-input label="Last Name" readonly class="mb-3" wire:model="lastName" />
                <x-input label="Email" readonly class="mb-3" wire:model="email" />
                <x-input label="Phone" readonly class="mb-3" wire:model="phone" />
                <div class="mt-3">
                <label for="" class="pb-3">Message</label>
                    <x-textarea class="mt-2"
                    readonly
                    wire:model="message"
                    rows="5"
                    inline />
                </div>
            </div>

        </div>

        <div class="mt-4 space-x-4 flex justify-end">
            <x-button label="Close" @click="$wire.contactModal = false"  spinner class=" btn-primary" />
        </div>
    </x-modal>


    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$contacts" :sort-by="$sortBy">
            @scope('actions', $contact)
                <x-button icon="c-pencil-square"  wire:click="show({{ $contact['id'] }})" spinner class="btn-ghost btn-sm text-blue-500" />
            @endscope
        </x-table>
        <div class="mt-4">
            {{ $contacts->links() }}
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
