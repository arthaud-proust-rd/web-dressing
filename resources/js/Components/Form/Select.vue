<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'options']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <option
            v-for="option of options"
            :value="option.value"
            :selected="option.value === modelValue"
        >
            {{ option.label }}
        </option>
    </select>
</template>
