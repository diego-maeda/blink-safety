<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import {CheckIcon, ChevronRightIcon} from "@heroicons/vue/24/solid/index.js";

//Locale imports
import {useI18n} from "vue-i18n";

const {t} = useI18n();

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
                        <a class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                            <span
                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-purple-600">
                                <span class="text-purple-600">1</span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-purple-600">
                                {{ $t('dashboard.first_section_title') }}
                            </span>
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
                        <a class="group flex items-center">
                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                <span
                                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                    <span class="text-gray-500 group-hover:text-gray-900">2</span>
                                </span>
                                <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                    {{ $t('dashboard.second_section_title') }}
                                </span>
                          </span>
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
                        <a class="group flex items-center">
                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                <span
                                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                    <span class="text-gray-500 group-hover:text-gray-900">3</span>
                                </span>
                                <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                    {{ $t('dashboard.third_section_title') }}
                                </span>
                          </span>
                        </a>
                    </li>
                    <!-- Step 3-->
                </ol>
            </nav>
        </div>
        <!-- Steps -->
        <!-- Step Container-->
        <div id="steps-container" class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
            <section id="step-01" aria-labelledby="gather-your-info">
                <div class="mx-4 my-4 pb-4 border-b border-gray-300">
                    <h2 id="gather your info" class="text-xl font-medium text-gray-900">
                        {{ $t('dashboard.first_section_title') }}</h2>
                    <p class="text-base text-gray-600">{{ $t('dashboard.first_section_subtitle') }}</p>

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
                        {{ $t('dashboard.next_button') }}
                        <ChevronRightIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                    </Link>
                </div>

            </section>
        </div>
        <!-- Step Container-->
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
