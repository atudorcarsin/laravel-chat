<script setup>
const props = defineProps({
    message: String,
})
</script>

<template v-show="message">
    <div>
        <p class="text-green-600 text-sm">
            {{ message }}
        </p>
    </div>
</template>
