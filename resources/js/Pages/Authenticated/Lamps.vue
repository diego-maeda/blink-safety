<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import {CheckIcon, ExclamationTriangleIcon, LightBulbIcon} from "@heroicons/vue/24/solid/index.js";
import {LightBulbIcon as LightBulbIconOutline, BellAlertIcon, BellSnoozeIcon} from "@heroicons/vue/24/outline/index.js" ;

defineProps({lamps: Object})

const steps = [
    {id: '1', name: 'Collect your access information', href: '#', status: 'complete'},
    {id: '2', name: 'Set your access key', href: '#', status: 'complete'},
    {id: '3', name: 'Select your lamps', href: '#', status: 'current'},
]

/**
 * This method will trigger the token removal process and will disable all the lamps
 */
function deleteToken() {
    router.delete(route('delete-access-token'));
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
            <nav aria-label="Progress">
                <ol role="list"
                    class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
                    <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative md:flex md:flex-1">
                        <a v-if="step.status === 'complete'" :href="step.href" class="group flex w-full items-center">
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span
                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-600 group-hover:bg-purple-800">
              <CheckIcon class="h-6 w-6 text-white" aria-hidden="true"/>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ step.name }}</span>
          </span>
                        </a>
                        <a v-else-if="step.status === 'current'" :href="step.href"
                           class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
          <span
              class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-purple-600">
            <span class="text-purple-600">{{ step.id }}</span>
          </span>
                            <span class="ml-4 text-sm font-medium text-purple-600">{{ step.name }}</span>
                        </a>
                        <a v-else :href="step.href" class="group flex items-center">
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span
                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
              <span class="text-gray-500 group-hover:text-gray-900">{{ step.id }}</span>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ step.name }}</span>
          </span>
                        </a>
                        <template v-if="stepIdx !== steps.length - 1">
                            <!-- Arrow separator for lg screens and up -->
                            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                     preserveAspectRatio="none">
                                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </template>
                    </li>
                </ol>
            </nav>
        </div>
        <div id="steps-container" class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
            <section id="step-03" aria-labelledby="setup-your-lamps">
                <div class="mx-4 my-4 sm:flex sm:items-center pb-4 border-b border-gray-300">
                    <div class="sm:flex-auto">
                        <h2 id="setup-your-lamps" class="text-lg font-medium text-gray-900">Setup your lamps</h2>
                        <p class="text-base text-gray-600">Are you new here? We created this video to help you setup
                            your
                            account on
                            Lifx.</p>
                    </div>
                    <div class="flex mt-4 sm:mt-0">
                        <button
                            @click="deleteToken"
                            type="button"
                            class="flex mr-1 rounded-md bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                            Reset my token
                            <ExclamationTriangleIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                        </button>
                    </div>
                </div>
                <div class="mx-4 my-4">
                    {{lamps}}
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300" v-if="lamps.length > 0">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                            Id
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Label
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Power
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                            <span class="sr-only">Edit</span>
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
                                                <span class="font-medium">On</span>
                                            </div>
                                            <div v-else class="flex items-center">
                                                <LightBulbIconOutline
                                                    class="h-5 w-5 mr-3 text-gray-600"></LightBulbIconOutline>
                                                <span class="font-medium">Off</span>
                                            </div>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                            <Link :href="route('set-lamp', lamp.lamp_id)"
                                                  class="text-purple-600 hover:text-purple-900 flex justify-end" v-if="!lamp.blink_safety_connected">
                                                <BellAlertIcon class="h-5 w-5 mr-3"></BellAlertIcon>
                                                Connect to Blink-safety
                                            </Link>
                                            <Link :href="route('unset-lamp', lamp.lamp_id)"
                                                  class="text-purple-600 hover:text-purple-900 flex justify-end" v-else>
                                                <BellSnoozeIcon class="h-5 w-5 mr-3"></BellSnoozeIcon>
                                                Disconnect from Blink-safety
                                            </Link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="flex items-center justify-center" v-else>
                                    <span class="text-gray-600">Sorry. We were not able to detect any new lights for now. Did you connect to Lifx lights?</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
