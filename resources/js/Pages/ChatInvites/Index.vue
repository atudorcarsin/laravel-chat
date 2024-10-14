<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SimplePaginate from "@/Components/SimplePaginate.vue";

const props = defineProps(['incomingInvites']);

const acceptedInviteForms = {};
const declinedInviteForms = {};

for (const incomingInvite of props.incomingInvites.data) {
    acceptedInviteForms[incomingInvite.id] = useForm({
        senderId: incomingInvite.sender.id,
        receiverId: incomingInvite.receiver.id,
    });

    declinedInviteForms[incomingInvite.id] = useForm({});
}

</script>

<template>
    <Head title="Chat Invites"/>
    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 my-4">
            <h1 class="text-white text-2xl font-bold">Incoming Chat Invites</h1>

            <div v-if="!incomingInvites.data[0]" class="bg-gray-800 p-2 my-5 rounded-lg">
                <p class="text-white text-lg">You currently have no incoming invites.</p>
            </div>

            <div v-for="incomingInvite of incomingInvites.data" :key="incomingInvite.id"
                 class="mt-2 p-3 border-gray-800 rounded-lg border-solid border-2 flex items-center justify-between">
                <div>
                    <p class="text-white text-lg">{{ incomingInvite.sender.username }} invited you to chat</p>
                </div>
                <div class="flex items-center">
                    <form @submit.prevent="acceptedInviteForms[incomingInvite.id].post(route('chats.store'))">
                        <button
                            class="rounded-xl p-2 m-1 border-gray-800 bg-blue-700 text-white hover:bg-blue-500 transition duration-200 ease-in-out"
                            type="submit">Accept
                        </button>
                    </form>
                    <form
                        @submit.prevent="declinedInviteForms[incomingInvite.id].delete(route('chatinvites.destroy', incomingInvite.id))">
                        <button
                            class="rounded-xl p-2 m-1 border-gray-800 bg-gray-500 text-white hover:bg-gray-400 transition duration-200 ease-in-out"
                            type="submit">Decline
                        </button>
                    </form>
                </div>
            </div>


            <SimplePaginate :data="incomingInvites"/>
        </div>
    </AuthenticatedLayout>
</template>
