<script setup>
import {Head} from "@inertiajs/vue3";
import {computed} from 'vue'
import error from '/resources/img/errors/error.webp';

const props = defineProps({status: Number})

const title = computed(() => {
    return {
        503: '503 Service Unavailable',
        500: '500 Server Error',
        404: '404 Page Not Found',
        403: '403 Forbidden',
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
})
</script>

<template>
    <Head>
        <title>{{title}}</title>
    </Head>
    <div class="flex justify-center flex-col items-center p-8">

        <v-img :height="250" :width="446" :src="error"></v-img>
        <h1 class="text-purple-800 text-4xl font-black uppercase subpixel-antialiased tracking-tight text-center mt-4">
            {{ title }}</h1>
        <div class="text-gray-500 mt-4 text-center">{{ description }}</div>
        <v-btn variant="outlined" color="primary" class="mt-4 max-w-14" href="/">Go back</v-btn>

    </div>
</template>
