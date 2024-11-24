<script setup>
import {Head, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {ref} from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormSuccess from "@/Components/FormSuccess.vue";
import Chats from "@/Pages/Chats/Partials/Chats.vue";
import SimplePaginate from "@/Components/SimplePaginate.vue";
import axios from "axios";

const page = usePage();

const props = defineProps({
    hasIncomingInvites: Boolean,
    chats: Object,
    currentUser: Object,
});

const pageLength = 10;

const chatData = ref(null);
const messages = ref([]);
const message = ref([]);

const inviteFormIsActive = ref(false);

const toggleInviteForm = () => {
    inviteFormIsActive.value = !inviteFormIsActive.value;
}

const inviteForm = useForm({
    username: '',
});

const messageForm = useForm({
    chat_id: '',
    text_content: '',
});

const sendMessage = () => {
    messageForm.post(route('messages.store'));
    messageForm.text_content = '';
};

const setChatId = (id) => {
    messageForm.chat_id = id;
}

const getChat = (chat) => {
    axios.get(route('chats.show', [chat.id, messages.value.length, pageLength]))
        //axios.get(`chats/${chat.id}/${messages.value.length}/${pageLength}`)
        .then(({data}) => {
            chatData.value = data;
            console.log(data);
            messages.value.push(...data.messages);
            //nextTick(scroll);
            //nextTick(() => message.value[message.value.length - 1].scrollIntoView());

        });
};

const getUsername = (userId) => {
    return (chatData.value.user_one.id == userId) ? chatData.value.user_one.username : chatData.value.user_two.username;
};

</script>

<template>
    <Head title="Chats"/>

    <AuthenticatedLayout>
        <div class="m-5 p-3 max-w-full bg-gray-800 rounded-lg flex min-h-[88vh]">
            <div class="grow-[1] max-w-80 flex flex-col border-solid border-2 border-gray-600 rounded-lg p-2 mr-1">

                <div class="flex justify-between items-start">
                    <h1 class="text-2xl text-white font-bold mb-2 ml-3">My Chats</h1>
                    <button v-if="!inviteFormIsActive" class="bg-white rounded-lg px-1 h-9 text-black"
                            @click="toggleInviteForm">New Chat
                    </button>
                    <button v-else class="bg-white rounded-lg px-1 h-9 text-black" @click="toggleInviteForm">Cancel
                    </button>
                </div>


                <div v-if="inviteFormIsActive"
                     class="flex flex-col items-center border-2 border-gray-700 mt-2 py-2 rounded-xl">
                    <form @submit.prevent="inviteForm.post(route('chatinvites.store'))">
                        <div>
                            <InputLabel class="pl-1" for="username" value="Username"/>

                            <TextInput
                                id="username"
                                v-model="inviteForm.username"
                                autocomplete="username"
                                autofocus
                                class="mt-1 block min-w-full"
                                required
                                type="text"
                            />

                            <InputError :message="inviteForm.errors.username" class="mt-2"/>

                            <FormSuccess :message="page.props.flash.message" class="mt-2"/>
                        </div>

                        <PrimaryButton>
                            Send
                        </PrimaryButton>
                    </form>
                </div>

                <div v-if="hasIncomingInvites">
                    <a :href="route('chatinvites.index')"
                       class="text-blue-600 underline text-center ml-2 hover:text-blue-400 transition">
                        New chat invites! Click here to view
                    </a>
                </div>

                <!-- Chats -->
                <Chats :chats="chats" :currentUser="currentUser" @loadChat="getChat"/>

                <SimplePaginate :data="chats"/>

            </div>

            <div
                v-if="chatData"
                class="grow-[6] border-solid border-2 border-gray-600 rounded-lg p-2 ml-1 flex flex-col-reverse">

                <div>
                    <form class="flex justify-between"
                          @submit.prevent="sendMessage()">
                        <input id="chat_id" v-model="messageForm.chat_id" name="chat_id"
                               type="hidden"
                        />

                        <InputLabel class="hidden" for="text_content" value="Text Content"/>
                        <input id="text_content"
                               v-model="messageForm.text_content"
                               class="bg-gray-800 py-2 w-auto min-w-[95%] rounded-xl text-lg caret-gray-300 text-gray-300"
                               name="text_content" placeholder="Type a new message" type="text">
                        <PrimaryButton class="ml-2 rounded-xl py-0" type="submit" @click="setChatId(chatData.id)">
                            Send
                        </PrimaryButton>

                        <InputError :message="messageForm.errors.text_content"></InputError>
                        <InputError :message="messageForm.errors.chat_id"></InputError>

                    </form>
                </div>

                <div class="max-h-[80vh] overflow-scroll flex flex-col-reverse">
                    <div v-for="(message,index) in messages"
                         :key="message.id"
                         ref="message"
                         :class="'message-'+index"
                         class="chat-message border-gray-700 border rounded-lg p-1 my-2">
                        <p class="text-white text-lg font-bold">
                            {{ getUsername(message.user_id) }} - {{ message.created_at }}
                        </p>
                        <p class="text-white">{{ message.text_content }}</p>
                    </div>

                    <button v-if="chatData"
                            class="bg-white text-black text-lg w-48 rounded-xl self-center hover:bg-gray-300 transition"
                            @click="getChat({ id: chatData.id})"
                    >Load More
                    </button>
                </div>
            </div>

            <div
                v-else
                class="grow-[6] border-solid border-2 border-gray-600 rounded-lg p-2 ml-1 flex justify-center items-center">
                <p class="text-xl text-white">Select a chat or create a new chat</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
