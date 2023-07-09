<script setup>


defineProps({
    withback: {
        default: false
    },
    bottomNav: {
        default: true
    }
})
</script>
<template>
    <div>
        <div class="bg-neutral-50 min-h-screen container mx-auto py-4 px-3 flex flex-col pb-24">
            <nav class="flex justify-between items-center pb-2" v-if="$slots.navigation">
                <slot name="navigation"/>
            </nav>

            <!-- Page Heading -->
            <header class="" v-if="$slots.header">
                <slot name="header"/>
            </header>

            <!-- Page Content -->
            <main class="h-max flex-grow flex flex-col">
                <slot/>
            </main>

        </div>

        <nav class="z-50 bg-neutral-50 fixed bottom-0 w-full border border-top" v-if="$slots.bottomNavigation">
            <slot name="bottomNavigation"/>
        </nav>
    </div>
</template>
