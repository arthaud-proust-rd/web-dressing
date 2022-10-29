<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {ArrowSmallLeftIcon, ChevronLeftIcon} from '@heroicons/vue/24/outline';

const props = defineProps(['href', 'text', 'showIcon']);

const goBackIfNoHref = function () {
    if (props.href) return false;

    history.back();
    return false;
}

</script>
<template>
    <Link v-if="false" class="text-gray-400 flex flex-row items-center gap-2 py-2" href="#"
          onclick="history.back();return false;">
        <ChevronLeftIcon class="h-4 w-4"/>
        {{ text || 'Retour' }}
    </Link>
    <Link
        :href="href"
        @click="goBackIfNoHref"
        class="flex flex-row gap-2 items-center text-neutral-600 mr-auto"
    >
        <ArrowSmallLeftIcon v-if="showIcon!==false" class="h-5 w-5 mb-px"/>
        {{ text || 'Retour' }}
    </Link>
</template>
