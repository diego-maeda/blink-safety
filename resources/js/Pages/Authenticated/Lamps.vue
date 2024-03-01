<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import {CheckIcon, ExclamationTriangleIcon, LightBulbIcon} from "@heroicons/vue/24/solid/index.js";
import {
    LightBulbIcon as LightBulbIconOutline,
    BellAlertIcon,
    BellSnoozeIcon
} from "@heroicons/vue/24/outline/index.js" ;

//Locale imports
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: "global"});

defineProps({lamps: Object})

/**
 * This method will trigger the token removal process and will disable all the lamps
 */
function deleteToken() {
    router.delete(route('delete-access-token'));
}
</script>

<template>
    <Head :title="$t('dashboard.page_title')"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $t('dashboard.page_title') }}</h2>
        </template>
        <!-- Steps -->
        <div class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
            <nav aria-label="Progress">
                <ol role="list"
                    class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
                    <!-- Step 1-->
                    <li class="relative md:flex md:flex-1">
                        <a class="group flex w-full items-center">
                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-600 group-hover:bg-purple-800">
                                    <CheckIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                                </span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-gray-900"> {{ $t('dashboard.first_section_title') }}</span>
                        </a>
                        <!-- Arrow separator for lg screens and up -->
                        <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                            <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                 preserveAspectRatio="none">
                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </li>
                    <!-- Step 1-->
                    <!-- Step 2-->
                    <li class="relative md:flex md:flex-1">
                        <a class="group flex w-full items-center">
                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-600 group-hover:bg-purple-800">
                                    <CheckIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                                </span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-gray-900"> {{ $t('dashboard.second_section_title') }}</span>
                        </a>
                        <!-- Arrow separator for lg screens and up -->
                        <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                            <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                 preserveAspectRatio="none">
                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </li>
                    <!-- Step 2-->
                    <!-- Step 3 -->
                    <li class="relative md:flex md:flex-1">
                        <a class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                            <span
                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-purple-600">
                                <span class="text-purple-600">3</span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-purple-600">
                                {{ $t('dashboard.third_section_title') }}
                            </span>
                        </a>
                    </li>
                    <!-- Step 3-->
                </ol>
            </nav>
        </div>
        <!-- Steps -->
        <!-- Step Container -->
        <div id="steps-container" class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
            <section id="step-03" aria-labelledby="setup-your-lamps">
                <div class="mx-4 my-4 sm:flex sm:items-center pb-4 border-b border-gray-300">
                    <div class="sm:flex-auto">
                        <h2 id="setup-your-lamps" class="text-lg font-medium text-gray-900">{{ $t('dashboard.third_section_title') }}</h2>
                        <p class="text-base text-gray-600">{{ $t('dashboard.third_section_subtitle') }}</p>
                    </div>
                    <div class="flex mt-4 sm:mt-0">
                        <button
                            @click="deleteToken"
                            type="button"
                            class="flex mr-1 rounded-md bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                            {{ $t('dashboard.reset_my_token_button') }}
                            <ExclamationTriangleIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                        </button>
                    </div>
                </div>
                <div class="mx-4 my-4">
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300" v-if="lamps.length > 0">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                            {{ $t('dashboard.light_id_th') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            {{ $t('dashboard.light_label_th') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            {{ $t('dashboard.light_power_th') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">
                                            {{ $t('dashboard.light_actions_th') }}
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    <tr v-for="lamp in lamps" :key="lamp.uuid" class="even:bg-gray-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                            {{ lamp.lamp_id }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ lamp.label }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                            <div v-if="lamp.power" class="flex items-center">
                                                <LightBulbIcon class="h-5 w-5 mr-3 text-purple-600"></LightBulbIcon>
                                                <span class="font-medium">{{ $t('dashboard.light_power_on_td') }}</span>
                                            </div>
                                            <div v-else class="flex items-center">
                                                <LightBulbIconOutline
                                                    class="h-5 w-5 mr-3 text-gray-600"></LightBulbIconOutline>
                                                <span class="font-medium">{{ $t('dashboard.light_power_off_td') }}</span>
                                            </div>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                            <Link :href="route('set-lamp', lamp.lamp_id)"
                                                  class="text-purple-600 hover:text-purple-900 flex justify-end"
                                                  v-if="!lamp.blink_safety_connected">
                                                <BellAlertIcon class="h-5 w-5 mr-3"></BellAlertIcon>
                                                {{ $t('dashboard.light_connect_td') }}
                                            </Link>
                                            <Link :href="route('unset-lamp', lamp.lamp_id)"
                                                  class="text-purple-600 hover:text-purple-900 flex justify-end" v-else>
                                                <BellSnoozeIcon class="h-5 w-5 mr-3"></BellSnoozeIcon>
                                                {{ $t('dashboard.light_disconnect_td') }}
                                            </Link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="flex items-center justify-center" v-else>
                                    <span class="text-gray-600">
                                        {{ $t('dashboard.light_no_row_td') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Step Container -->
    </AuthenticatedLayout>
</template>
