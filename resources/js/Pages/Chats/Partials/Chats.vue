<script setup>
import {defineEmits} from "vue";

const props = defineProps({
    chats: Object,
    currentUser: Object,
});

const emit = defineEmits(['loadChat']);

const getUsername = (chat) => {
    return (chat.user_one.id === props.currentUser.id) ? chat.user_two.username : chat.user_one.username;
}


</script>

<template>
    <a v-for="chat of chats.data"
       :key="chat.id"
       class="hover:bg-gray-700 transition rounded-3xl m-1 p-1"
       @click="emit('loadChat', chat)">

        <div class="flex items-center">
            <img alt="User profile picture" class="rounded-3xl mr-3" src="https://dummyimage.com/48/48">
            <p class="text-white text-lg overflow-hidden text-ellipsis whitespace-nowrap max-w-64">
                {{ getUsername(chat) }}
            </p>
        </div>
    </a>
</template>
