<script setup>
import {computed} from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    label: {
        type: String
    },
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        default: null,
    },
});

const inputId = computed(() => btoa(props.label))

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <div>
        <input type="checkbox" :value="value" v-model="proxyChecked" class="hidden peer" :id="inputId">
        <label class="select-none btn-secondary peer-checked:btn-primary" :for="inputId">
            <slot/>
            {{ label }}
        </label>
    </div>
</template>
