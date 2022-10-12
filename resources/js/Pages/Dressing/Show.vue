<script setup>
import {PlusIcon} from '@heroicons/vue/24/outline';
import {Head, Link} from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Clothes from "@/Components/Dressing/DressingClothes.vue";
import BackLink from "@/Components/BackLink.vue";

const props = defineProps({
    dressing: {
        type: Object,
    },
    categories: {
        type: Object,
    },
});
</script>

<template>
    <Head :title="'Dressing '+dressing.name"/>

    <AuthenticatedLayout>
        <template #navigation>
            <BackLink/>
        </template>

        <template #header>
            <h1 class="h1">Dressing {{ dressing.name }}</h1>
        </template>

        <div class="mb-6 flex flex-wrap gap-2">
            <Link class="btn-primary" :href="route('dressing.add-clothing', dressing)">
                <PlusIcon class="h-6 w-6"/>
                Vêtement
            </Link>
            <Link class="btn-secondary" :href="route('dressing.edit', dressing)">
                Modifier le dressing
            </Link>
        </div>
        <Clothes :dressing="dressing" :categories="categories"/>
    </AuthenticatedLayout>
</template>
