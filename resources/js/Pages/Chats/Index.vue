<script setup>
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const inviteFormIsActive = ref(false);

    const toggleInviteForm = () => {
        inviteFormIsActive.value = !inviteFormIsActive.value;
    }

    const form = useForm({
        username: '',
    });
</script>

<template>
    <Head title="Chats" />

    <AuthenticatedLayout>
        <div class="m-5 p-3 max-w-full bg-gray-800 rounded-lg flex min-h-[88vh]">
            <div class="grow-[1] max-w-80 flex flex-col border-solid border-2 border-gray-600 rounded-lg p-2 mr-1">

                <div class="flex justify-between items-start">
                    <h1 class="text-2xl text-white font-bold mb-2 ml-3">My Chats</h1>
                    <button v-if="!inviteFormIsActive" @click="toggleInviteForm" class="bg-white rounded-lg px-1 h-9 text-black">New Chat</button>
                    <button v-else @click="toggleInviteForm" class="bg-white rounded-lg px-1 h-9 text-black">Cancel</button>
                </div>

                <div v-if="inviteFormIsActive" class="flex flex-col items-center border-2 border-gray-700 mt-2 py-2 rounded-xl">
                    <form>
                        <div>
                            <InputLabel class="pl-1" for="username" value="Username" />

                            <TextInput 
                                id="username"
                                type="text"
                                v-model="form.username"
                                class="mt-1 block min-w-full"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>
                        <PrimaryButton class="mt-4">
                            Send
                        </PrimaryButton>
                    </form>
                </div>

                <!-- Chats -->
                <a href="#" class="hover:bg-gray-700 transition rounded-3xl m-1 p-1">
                    <div class="flex items-center">
                        <img src="https://dummyimage.com/48/48" alt="User profile picture" class="rounded-3xl mr-3">
                        <p class="text-white text-lg overflow-hidden text-ellipsis whitespace-nowrap max-w-64">Person Name</p>
                    </div>
                </a>

                <a href="#" class="hover:bg-gray-700 transition rounded-3xl m-1 p-1">
                    <div class="flex items-center">
                        <img src="https://dummyimage.com/48/48" alt="User profile picture" class="rounded-3xl mr-3">
                        <p class="text-white text-lg overflow-hidden text-ellipsis whitespace-nowrap max-w-64">Person Name</p>
                    </div>
                </a>

            </div>

            <div class="grow-[6] border-solid border-2 border-gray-600 rounded-lg p-2 ml-1">
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>