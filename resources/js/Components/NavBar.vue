<script setup>
    import { usePage } from '@inertiajs/vue3'
    import NavLink from '@/Components/NavLink.vue'

    const loggedIn = usePage().props.loggedIn;
</script>

<template>
    <div class="flex justify-between px-2 py-2 text-xl text-white bg-slate-950">
        <div>
            <a href=""></a>
        </div>

        <div v-if="!loggedIn" class="flex gap-4">
            <NavLink href="/login">Login</NavLink>
            <NavLink href="/register">Register</NavLink>
        </div>
        <div v-else class="flex gap-4">
            <!-- TODO: implement navlinks for authenticated users -->
            <NavLink href="#">Empty</NavLink>
        </div>

    </div>
</template>