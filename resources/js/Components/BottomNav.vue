<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {UserIcon} from '@heroicons/vue/24/outline';
import {HangerIcon} from '@/Components/customHeroIcon.js';</script>
<template>
    <nav class="z-50 bg-neutral-50 fixed bottom-0 w-full border border-top">
        <div class="container px-3 mx-auto flex justify-evenly items-center ">
            <Link class="py-3 px-4" :href="route('dressing.index')"
                  :class="{'text-amber-600': route().current('dressing.index')}">
                <HangerIcon class="h-8 w-8"/>
            </Link>
            <Link class="py-3 px-4">
                <UserIcon class="h-8 w-8"/>
            </Link>
        </div>
    </nav>
</template>
