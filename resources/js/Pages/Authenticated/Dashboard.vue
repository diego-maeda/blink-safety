<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import {CheckIcon, ChevronRightIcon} from "@heroicons/vue/24/solid/index.js";

const steps = [
    {id: '1', name: 'Collect your access information', href: '#', status: 'current'},
    {id: '2', name: 'Set your access key', href: '#', status: 'upcoming'},
    {id: '3', name: 'Select your lamps', href: '#', status: 'upcoming'},
]

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
            <section id="step-01" aria-labelledby="gather-your-info">
                <div class="mx-4 my-4 pb-4 border-b border-gray-300">
                    <h2 id="gather your info" class="text-xl font-medium text-gray-900">Gather your info</h2>
                    <p class="text-base text-gray-600">Are you new here? We created this video to help you setup your
                        account on
                        Lifx.</p>

                </div>
                <div class="mx-4 my-4">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/eeSCOkIBVyQ?si=kXER6L1RLNlVqqIG"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                </div>

                <div id="step-footer" class="flex justify-end mx-4">
                    <Link href="/dashboard/access-token"
                          as="button"
                          class="inline-flex items-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                        Next
                        <ChevronRightIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                    </Link>
                </div>

            </section>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
