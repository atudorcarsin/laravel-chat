<script setup>
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Chats" />

    <AuthenticatedLayout>
        <div class="m-5 p-3 max-w-full bg-gray-800 rounded-lg flex min-h-[88vh]">
            <div class="grow-[1] max-w-80 flex flex-col border-solid border-2 border-gray-600 rounded-lg p-2 mr-1">
                <h1 class="text-2xl text-white font-bold mb-2 ml-3">My Chats</h1>

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