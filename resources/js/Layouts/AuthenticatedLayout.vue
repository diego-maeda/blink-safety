<script setup>
import {ref} from 'vue';
import {Link} from '@inertiajs/vue3';
import logo from "../../img/blink-safety-logo.svg";
import {ComputerDesktopIcon, UserCircleIcon, ShieldCheckIcon, ArrowRightStartOnRectangleIcon} from "@heroicons/vue/24/outline";
const showingNavigationDropdown = ref(false);


//Locale imports
import {useI18n} from "vue-i18n";
import { usePage } from '@inertiajs/vue3';

const {t, locale} = useI18n({useScope: "global"});

const page = usePage();
locale.value = page.props.language.language;
</script>

<template>
    <div>
        <div class="min-h-screen bg-[#fbf2fe]">
            <nav class="bg-white border-b border-gray-100 ">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <img :src="logo" height="45" width="100" alt="Blink-Safety Logo">

                                </Link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <v-menu>
                                    <template v-slot:activator="{ props }">
                                        <button v-bind="props" type="button"
                                                class="relative flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-purple-800"
                                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                            <span class="absolute -inset-1.5"></span>
                                            <span class="sr-only">Open user menu</span>
                                            <img class="h-8 w-8 rounded-full"
                                                 :src="($page.props.auth.user.photo)? '/storage/' + $page.props.auth.user.photo : '/storage/images/blink-safety.jpeg'"
                                                 :alt="$page.props.auth.user.name + ' photo'">
                                            <span class="ml-3 mr-2">{{ $page.props.auth.user.name }}</span>
                                        </button>

                                    </template>
                                    <v-list density="compact" class="w-56">
                                        <v-list-item>
                                            <Link :href="route('dashboard')"
                                                  class="flex items-center px-4 py-2 !text-sm text-gray-700 cursor-pointer">
                                                <ComputerDesktopIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                                                {{$t('general.navigation.dashboard')}}
                                            </Link>
                                            <Link :href="route('profile')"
                                                  class="flex items-center px-4 py-2 !text-sm text-gray-700 cursor-pointer">
                                                <UserCircleIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                                                {{$t('general.navigation.profile')}}
                                            </Link>
                                            <Link :href="route('security')" :active="route().current('security')"
                                                  class="flex items-center px-4 py-2 !text-sm text-gray-700 cursor-pointer">
                                                <ShieldCheckIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                                                {{$t('general.navigation.security')}}
                                            </Link>
                                        </v-list-item>
                                        <v-list-item class="border-t border-gray-100">
                                            <Link :href="route('logout')" method="post"
                                                  class="flex items-center px-4 py-2 !text-sm text-gray-700 cursor-pointer" as="button">
                                                <ArrowRightStartOnRectangleIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                                                {{$t('general.navigation.log_out')}}
                                            </Link>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </div>
                        </div>
                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <img class="h-10 w-10 rounded-full bg-gray-50"
                                 :src="($page.props.auth.user.photo)? '/storage/' + $page.props.auth.user.photo : '/storage/images/blink-safety.jpeg'"
                                 :alt="$page.props.auth.user.name + ' photo'">
                            <div class="ml-3">
                                <div class="font-medium text-base text-gray-800">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-3 px-3 border-t border-gray-200 flex flex-col">
                        <Link :href="route('dashboard')" :active="route().current('dashboard')" class="flex items-center">
                            <ComputerDesktopIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                            {{$t('general.navigation.dashboard')}}
                        </Link>
                        <Link :href="route('profile')" :active="route().current('profile')" class="flex items-center">
                            <UserCircleIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                            {{$t('general.navigation.profile')}}
                        </Link>
                        <Link :href="route('security')" :active="route().current('security')" class="flex items-center">
                            <ShieldCheckIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                            {{$t('general.navigation.security')}}
                        </Link>
                        <Link :href="route('logout')" method="post" as="button" class="flex items-center">
                            <ArrowRightStartOnRectangleIcon class="mr-3 h-5 w-5 text-gray-500" aria-hidden="true"/>
                            {{$t('general.navigation.log_out')}}
                        </Link>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>
