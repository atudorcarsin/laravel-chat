<script setup>
const props = defineProps(['data']);
</script>

<template>
    <div class="flex justify-end">
        <a v-if="data.prev_page_url" :href="data.first_page_url"
           class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">First</a>
        <span v-else
              class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">First</span>

        <a v-if="data.prev_page_url" :href="data.prev_page_url"
           class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Previous</a>
        <span v-else
              class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Previous</span>

        <a v-if="data.next_page_url" :href="data.next_page_url"
           class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Next</a>
        <span v-else
              class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Next</span>
    </div>
</template>
