<div>
    <div class="flex flex-row flex-wrap gap-2" x-data="{ areFiltersOpen: true}">
        <button x-bind:class="areFiltersOpen?'btn-primary':'btn-secondary'" @click="areFiltersOpen = !areFiltersOpen">
            <x-icon.funnel/>
        </button>
        <div x-show="areFiltersOpen" class="flex flex-wrap gap-2">
            <select wire:model="orderBy" class="btn-secondary" id="">
                <option value="note:asc">Note - à +</option>
                <option value="note:desc">Note + à -</option>
                <option value="created_at:asc">Date - à +</option>
                <option value="created_at:desc">Date + à -</option>
            </select>

            <div class="flex flex-row bg-neutral-100 rounded-md">
                <button class="{{ $view==='list' ? 'btn-primary' : 'btn-secondary' }}" wire:click="setView('list')">
                    <x-icon.list/>
                </button>
                <button class="{{ $view==='grid' ? 'btn-primary' : 'btn-secondary' }}" wire:click="setView('grid')">
                    <x-icon.squares/>
                </button>
            </div>
        </div>
    </div>
    @if($view === "grid")
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 my-4">
            @foreach($this->filteredClothes()->get() as $clothing)
                <livewire:clothing.card :clothing="$clothing" :key="now()->timestamp . $clothing->id"/>
            @endforeach
        </div>
    @else
        @foreach($categories as $categoryName => $categoryInt)
            @if($this->filteredClothes()->categoryInt($categoryInt)->count() > 0)
                <div class="mt-6">
                    <h2 class="h2">{{ $categoryName }}</h2>
                    <div class="overflow-auto grid grid-flow-col auto-cols-[40vw] sm:auto-cols-[35vw] md:auto-cols-[20vw] grid-rows-1 gap-4 my-4">
                        @foreach($this->filteredClothes()->categoryInt($categoryInt)->get() as $clothing)
                            <livewire:clothing.card :clothing="$clothing" :key="now()->timestamp . $clothing->id"/>
                        @endforeach
                    </div>
                </div>
            @endif

        @endforeach
    @endif
</div>
