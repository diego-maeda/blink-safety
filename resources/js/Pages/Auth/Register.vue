<script setup>
import logo from "../../../img/blink-safety-logo.svg";
import {Head, Link, useForm} from "@inertiajs/vue3";
import appleTouchIcon from "../../../img/apple-touch-icon.png";
import favicon32 from "../../../img/favicon-32x32.png";
import favicon16 from "../../../img/favicon-16x16.png";
import favicon from "../../../img/favicon.ico";
import siteManifest from "../../../img/site.webmanifest";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    password_type: 'password',
    password_confirmation_type: 'password'
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

function togglePassword(){
    if(form.password_type === 'password'){
        form.password_type = 'text';
    } else {
        form.password_type = 'password';
    }
}

function toggleConfirmationPassword(){
    if(form.password_confirmation_type === 'password'){
        form.password_confirmation_type = 'text';
    } else {
        form.password_confirmation_type = 'password';
    }
}
</script>

<template>
    <Head>
        <title>Sign Up</title>
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
                    <h2 class="mt-10 text-center text-2xl font-semibold leading-9 tracking-tight text-gray-900">Sign up </h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" autocomplete="email" required
                                       v-model="form.name"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                <span class="mt-1">{{form.errors.email}}</span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       v-model="form.email"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                <span class="mt-1">{{form.errors.email}}</span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                       class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            </div>
                            <div class="mt-1">
                                <div class="flex items-center w-full bg-white rounded-md border-0 py-px text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <input id="password" name="password" :type="form.password_type" autocomplete="current-password"
                                           required v-model="form.password"
                                           class="h-full flex-fill  mx-px rounded-md">
                                    <Transition name="fade" mode="out-in" class="mr-3">
                                        <v-icon color="grey" @click.prevent="togglePassword" v-if="form.password_type === 'password'">mdi-eye-outline</v-icon>
                                        <v-icon color="grey" @click.prevent="togglePassword" v-else-if="form.password_type === 'text'">mdi-eye-closed</v-icon>
                                    </Transition>
                                    <span class="mt-1">{{form.errors.email}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                       class="block text-sm font-medium leading-6 text-gray-900">Password Confirmation</label>
                            </div>
                            <div class="mt-1">
                                <div class="flex items-center w-full bg-white rounded-md border-0 py-px text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <input id="password" name="password" :type="form.password_confirmation_type" autocomplete="current-password"
                                           required v-model="form.password_confirmation"
                                           class="h-full flex-fill  mx-px rounded-md">
                                    <Transition name="fade" mode="out-in" class="mr-3">
                                        <v-icon color="grey" @click.prevent="toggleConfirmationPassword" v-if="form.password_confirmation_type === 'password'">mdi-eye-outline</v-icon>
                                        <v-icon color="grey" @click.prevent="toggleConfirmationPassword" v-else-if="form.password_confirmation_type === 'text'">mdi-eye-closed</v-icon>
                                    </Transition>
                                    <span class="mt-1">{{form.errors.email}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit"
                                    class="flex w-full justify-center rounded-md bg-purple-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Sign up
                            </button>
                        </div>
                    </form>

                    <p class="mt-10 text-center text-sm text-gray-500">
                        Already registered?
                        <Link :href="route('login')" class="font-semibold text-purple-600 hover:text-purple-500">Sign in now!</Link>
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
