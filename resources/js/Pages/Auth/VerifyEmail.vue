<script setup>
import logo from "../../../img/blink-safety-logo.svg";
import {Head, Link, useForm} from "@inertiajs/vue3";
import appleTouchIcon from "../../../img/apple-touch-icon.png";
import favicon32 from "../../../img/favicon-32x32.png";
import favicon16 from "../../../img/favicon-16x16.png";
import favicon from "../../../img/favicon.ico";
import siteManifest from "../../../img/site.webmanifest";

const form = useForm({
    email: '',
});

const submit = () => {
  form.post(route('verification.send'));
};

</script>

<template>
  <Head>
    <title>Email Verification</title>
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
          <h2 class="mt-10 text-center text-2xl font-semibold leading-9 tracking-tight text-gray-900">Verify your
            email</h2>
          <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
            we just emailed to you? If you didn't receive the email, we will gladly send you another.
          </div>
        </div>

        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400" v-if="verificationLinkSent">
          A new verification link has been sent to the email address you provided during registration.
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
                <span class="text-red-500 text-sm">{{ form.errors.email }}</span>
              </div>
            </div>

            <div class="mt-2">
              <div class="mt-4 flex items-center justify-between">
                <v-btn :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Resend Verification Email
                </v-btn>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >Log Out</Link>
              </div>
            </div>
          </form>
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
