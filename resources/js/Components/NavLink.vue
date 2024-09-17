<script setup>
    defineProps('href');
</script>

<template>
    <a :href="href" class="bg-gray-900 transition px-3 py-2 rounded-lg hover:bg-gray-700">
        <slot></slot>
    </a>
</template>