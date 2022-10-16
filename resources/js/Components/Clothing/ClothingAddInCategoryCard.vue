<script setup>
import {PlusIcon} from "@heroicons/vue/24/outline";
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
    dressing: Object,
    category: Number,
});
</script>
<template>
    <div class="card p-0 gap-0 snap-start bg-opacity-0">
        <Link :href="route('dressing.add-clothing', {dressing, category})"
              class="h-full w-full flex flex-col items-center justify-center">
            <PlusIcon class="h-8 w-8 text-amber-600"/>
        </Link>
    </div>
</template>
