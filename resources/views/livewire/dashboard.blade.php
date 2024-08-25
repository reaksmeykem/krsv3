<div>
     <!-- HEADER -->
     <x-header title="Hello" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 lg:gap-8">
        <x-stat
        title="Posts"
        value="{{ $countPost }}"
        icon="o-envelope"
        tooltip="Hello"
        class="bg-slate-200" />
        <x-stat
            title="Categories"
            {{-- description="This month" --}}
            value="{{ $countCategory }}"
            icon="o-arrow-trending-up"
            tooltip-bottom="There"
            class="bg-slate-200"
            />

        <x-stat
            title="Users"
            {{-- description="This month" --}}
            value="{{ $countUser }}"
            icon="o-arrow-trending-down"
            class="bg-slate-200"
            tooltip-left="Ops!" />

        <x-stat
            title="Tags"
            {{-- description="This month" --}}
            value="{{ $countTag }}"
            icon="o-arrow-trending-down"
            class="text-orange-500 bg-slate-200"
            color="text-pink-500"
            tooltip-right="Gosh!" />
        </div>
        <div class="grid grid-cols-4 mt-6">
            <!-- Chart component from Mary UI -->
            <x-chart
                id="myChart"
                wire:model="myChart"
                class="col-span-3"
            />
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

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', (message, component) => {
                if (component.name === 'chart-component') {
                    const chartElement = document.getElementById('myChart');
                    if (chartElement) {
                        const ctx = chartElement.getContext('2d');
                        new Chart(ctx, {
                            type: @this.myChart.type,
                            data: @this.myChart.data,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
</div>
