<template>
    <div v-show="message">
        <p class="text-sm text-gray-600 dark:gray-400">
            {{ message }}
        </p>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>
