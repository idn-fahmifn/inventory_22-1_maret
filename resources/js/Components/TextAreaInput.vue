<!-- silakan buka github yang simple layout -->
<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: false,
    },
    rows: {
        type: [String, Number],
        default: 4,
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        :rows="rows"
        class="border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm transition-colors w-full"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    ></textarea>
</template>