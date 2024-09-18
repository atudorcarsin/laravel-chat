<script setup>
    import Layout from '@/Components/Layout.vue';
    import Field from '@/Components/AuthenticationFormField.vue';
    import Csrf from "@/Components/Csrf.vue";
</script>

<template>
    <Layout>
        <form method="POST" action="/login">
            <Csrf />
            <div class="bg-slate-800 w-96 pb-4 pt-8 px-2 m-auto mt-24 rounded-lg flex flex-col justify-between items-center gap-5">
                <Field type="email" name="email" placeholder="johndoe@example.com">
                    Email
                </Field>
                <Field type="password" name="password">
                    Password
                </Field>
                <button type="submit" class="text-white transition text-xl rounded-lg p-2 m-3 bg-blue-600 hover:bg-blue-800">Log In</button>
            </div>
        </form>
    </Layout>
</template>