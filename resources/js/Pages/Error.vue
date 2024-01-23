<script setup>
import {Head} from "@inertiajs/vue3";
import {computed} from 'vue'
import error from '/resources/img/errors/error.webp';

//Locale imports
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: "global"});

const props = defineProps({status: Number})

const title = computed(() => {
    return {
        503: t('error.503_title'),
        500: t('error.500_title'),
        404: t('error.404_title'),
        403: t('error.403_title'),
    }[props.status]
})

const description = computed(() => {
    return {
        503: t('error.503_description'),
        500: t('error.500_description'),
        404: t('error.404_description'),
        403: t('error.503_description'),
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
