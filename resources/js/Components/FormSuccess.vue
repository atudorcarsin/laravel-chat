<script setup>
const props = defineProps({
    message: String,
})
</script>

<template v-if="message">
    <div>
        <p class="mt-2 text-green-600 text-sm">
            {{ message }}
        </p>
    </div>
</template>
