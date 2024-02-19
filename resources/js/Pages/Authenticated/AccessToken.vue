<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {CheckIcon, ChevronLeftIcon, ChevronRightIcon} from "@heroicons/vue/24/solid/index.js";
import axios from "axios";

const steps = [
    {id: '1', name: 'Collect your access information', href: '#', status: 'complete'},
    {id: '2', name: 'Set your access key', href: '#', status: 'current'},
    {id: '3', name: 'Select your lamps', href: '#', status: 'upcoming'},
]

let form = useForm({
    access_token: ''
});

function submitAccessToken() {
    form.post(route('set-access-token'), {
        onSuccess: () => {

            return form.reset('access_token');
        }
    })
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
            <form @submit.prevent="submitAccessToken" id="step-02" aria-labelledby="setup-access-token">
                <div class="mx-4 my-4 pb-4 border-b border-gray-300">
                    <h2 id="setup-access-token" class="text-lg font-medium text-gray-900">Setup access token</h2>
                    <p class="text-base text-gray-600">Are you new here? We created this video to help you setup your
                        account on
                        Lifx.</p>

                </div>
                <div class="mx-4 my-4">
                    <label for="access-token" class="block text-sm font-medium text-gray-700">Access Token</label>
                    <div class="mt-1">
                        <input type="password" id="access-token" name="access-token" v-model="form.access_token"
                               class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm"/>
                        <div v-if="form.errors.access_token">{{ form.errors.access_token }}</div>
                    </div>
                </div>

                <div id="step-footer" class="flex justify-between mx-4">
                    <Link href="/dashboard"
                          as="button"
                          class="inline-flex items-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                        <ChevronLeftIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true"/>
                        Previous
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                        Next
                        <ChevronRightIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
