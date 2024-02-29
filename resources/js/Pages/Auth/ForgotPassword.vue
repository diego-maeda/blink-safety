<script setup>
import logo from "../../../img/blink-safety-logo.svg";
import {Head, Link, useForm} from "@inertiajs/vue3";
import appleTouchIcon from "../../../img/apple-touch-icon.png";
import favicon32 from "../../../img/favicon-32x32.png";
import favicon16 from "../../../img/favicon-16x16.png";
import favicon from "../../../img/favicon.ico";
import siteManifest from "../../../img/site.webmanifest";

defineProps({
    status: {
        type: String,
    },
});


const form = useForm({
    email: 'maeda.diego@gmail.com',
});

const submit = () => {
    form.post(route('password.email'), {
        onFinish: () => form.reset('email'),
    });
};
</script>

<template>
    <Head>
        <title>Forgot Password</title>
        <meta head-key="description" name="description" content="Blink-Safety bringing awareness to Domestic Violence"/>
        <link rel="apple-touch-icon" sizes="180x180" :href="appleTouchIcon">
        <link rel="icon" type="image/png" sizes="32x32" :href="favicon32">
        <link rel="icon" type="image/png" sizes="16x16" :href="favicon16">
        <link rel="icon" type="image/png" sizes="16x16" :href="favicon">
        <link rel="manifest" :href="siteManifest">
    </Head>
    <v-app>
        <v-main>
            <div class="flex min-h-dvh flex-col justify-center px-6 py-12 lg:px-8 bg-[#fbf2fe]">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img :src="logo" height="80" width="177" class="mb-7 mx-auto" alt="Blink-Safety Logo">
                    <h2 class="mt-10 text-center text-2xl font-semibold leading-9 tracking-tight text-gray-900">Forgot password</h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
                                       v-model="form.email"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                <span class="text-red-500 text-sm">{{form.errors.email}}</span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit"
                                    class="flex w-full justify-center rounded-md bg-purple-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Send me a reset email
                            </button>
                        </div>
                    </form>

                    <p class="mt-10 text-center text-sm text-gray-500">
                        Want to log in?
                        <Link href="/login" class="font-semibold text-purple-600 hover:text-purple-500">Sign in now!</Link>
                    </p>
                </div>
            </div>
        </v-main>
    </v-app>

</template>


<style scoped>
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
