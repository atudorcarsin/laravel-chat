<script setup>
    defineProps('href');
</script>

<template>
    <a :href="href" class="hover:bg-gray-700 px-3 py-2 rounded-lg">
        <slot></slot>
    </a>
</template>