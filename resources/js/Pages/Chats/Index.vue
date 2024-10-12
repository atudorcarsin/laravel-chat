<script setup>
import {Head, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {ref} from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormSuccess from "@/Components/FormSuccess.vue";

const page = usePage();

const props = defineProps({
    hasIncomingInvites: Boolean,
})

const inviteFormIsActive = ref(false);

const toggleInviteForm = () => {
    inviteFormIsActive.value = !inviteFormIsActive.value;
}

const form = useForm({
    username: '',
});
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
                    <form @submit.prevent="form.post(route('chatinvites.store'))">
                        <div>
                            <InputLabel class="pl-1" for="username" value="Username"/>

                            <TextInput
                                id="username"
                                v-model="form.username"
                                autocomplete="username"
                                autofocus
                                class="mt-1 block min-w-full"
                                required
                                type="text"
                            />

                            <InputError :message="form.errors.username" class="mt-2"/>

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
                <a class="hover:bg-gray-700 transition rounded-3xl m-1 p-1" href="#">
                    <div class="flex items-center">
                        <img alt="User profile picture" class="rounded-3xl mr-3" src="https://dummyimage.com/48/48">
                        <p class="text-white text-lg overflow-hidden text-ellipsis whitespace-nowrap max-w-64">Person
                            Name</p>
                    </div>
                </a>

                <a class="hover:bg-gray-700 transition rounded-3xl m-1 p-1" href="#">
                    <div class="flex items-center">
                        <img alt="User profile picture" class="rounded-3xl mr-3" src="https://dummyimage.com/48/48">
                        <p class="text-white text-lg overflow-hidden text-ellipsis whitespace-nowrap max-w-64">Person
                            Name</p>
                    </div>
                </a>

            </div>

            <div class="grow-[6] border-solid border-2 border-gray-600 rounded-lg p-2 ml-1">

            </div>
        </div>
    </AuthenticatedLayout>
</template>
