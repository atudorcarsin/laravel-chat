<script setup>
    defineProps(['name', 'type', 'placeholder'])
</script>

<template>
    <div class="flex flex-col justify-between items-center gap-1">
        <label :for="name" class="text-white text-lg">
            <slot></slot>
        </label>
        <input :type="type" :name="name" :id="name" :placeholder="placeholder" class="rounded-2xl bg-white py-1 px-3">
    </div>
</template>