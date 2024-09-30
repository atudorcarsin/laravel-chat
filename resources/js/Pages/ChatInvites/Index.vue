<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(['incomingInvites']);

const acceptedInviteForms = {};
const declinedInviteForms = {};

// TODO: Replace forms with buttons that perform the necessary requests
for (const incomingInvite of props.incomingInvites.data) {
    acceptedInviteForms[incomingInvite.id] = useForm({
        userOne: incomingInvite.sender.id,
        userTwo: incomingInvite.receiver.id,
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

            <div class="flex justify-end">
                <a v-if="incomingInvites.prev_page_url" :href="incomingInvites.first_page_url"
                   class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">First</a>
                <span v-else
                      class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">First</span>

                <a v-if="incomingInvites.prev_page_url" :href="incomingInvites.prev_page_url"
                   class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Previous</a>
                <span v-else
                      class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Previous</span>

                <a v-if="incomingInvites.next_page_url" :href="incomingInvites.next_page_url"
                   class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Next</a>
                <span v-else
                      class="text-gray-300 bg-slate-600 rounded-md p-2 m-2 hover:bg-slate-700 transition">Next</span>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
