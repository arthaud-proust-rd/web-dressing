<div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 my-4">
        @foreach($dressing->clothes as $clothing)
            <livewire:clothing.card :clothing="$clothing" />
        @endforeach
    </div>
</div>
