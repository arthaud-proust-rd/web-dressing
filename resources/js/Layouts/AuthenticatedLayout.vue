<script setup>
import BottomNav from "@/Components/BottomNav.vue";


defineProps({
    withback: {
        default: false
    }
})
</script>
<template>
    <div>
        <BottomNav/>

        <div class="bg-neutral-50 min-h-screen container mx-auto py-4 px-3 flex flex-col pb-24">
            <nav class="flex justify-between items-center pb-2" v-if="$slots.navigation">
                <slot name="navigation"/>
            </nav>

            <!-- Page Heading -->
            <header class="" v-if="$slots.header">
                <slot name="header"/>
            </header>

            <!-- Page Content -->
            <main class="">
                <slot/>
            </main>

        </div>
    </div>
</template>
