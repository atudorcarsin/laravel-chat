<script setup>
    import { usePage } from '@inertiajs/vue3';

    const _token = usePage().props._token;
</script>

<template>
    <input type="hidden" name="_token" id="csrf-token" :value="_token">
</template>