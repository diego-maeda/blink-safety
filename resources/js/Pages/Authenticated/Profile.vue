<script setup>
import {Head, Link, useForm,} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

let profile = useForm({
    name: '',
    email: '',
    photo: '',
});

function submitProfile() {
    profile.post('/profile')
}

</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="w-full mx-auto sm:px-6 py-12">
            <div class="rounded-lg border border-stroke bg-white px-7.5 py-6 shadow-default">
                <div class="space-y-12 px-15">
                    <!-- Profile -->
                    <form @submit.prevent="submitProfile" class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Let's rewrite the narrative. Update your profile
                            to showcase your commitment to building a world free from domestic violence. Share actions,
                            resources and raise awareness with us. </p>
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="name"
                                       class="block text-sm font-medium leading-6 text-gray-900">Name
                                    <small>[required]</small></label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                           v-model="profile.name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address <small>[required]</small></label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                           v-model="profile.email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="photo"
                                       class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <input type="file" @input="profile.photo = $event.target.files[0]"/>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Update profile
                            </button>
                        </div>
                    </form>
                    <!-- Profile -->

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Languages</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">To get the best experience, tell us your
                            preferred language:</p>

                        <div class="mt-1 space-y-10">
                            <fieldset>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-everything" name="push-notifications" type="radio"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600">
                                        <label for="push-everything"
                                               class="block text-sm font-medium leading-6 text-gray-900">English</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-email" name="push-notifications" type="radio"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600">
                                        <label for="push-email"
                                               class="block text-sm font-medium leading-6 text-gray-900">Spanish</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-email" name="push-notifications" type="radio"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600">
                                        <label for="push-email"
                                               class="block text-sm font-medium leading-6 text-gray-900">Portuguese</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Update language
                            </button>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important
                            changes, but
                            you pick what else you want to hear about.</p>

                        <div class="mt-10 space-y-10">
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Email
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">If you would like to receive our
                                    newsletter just check the box bellow.</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-everything" name="push-notifications" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600">
                                        <label for="push-everything"
                                               class="block text-sm font-medium leading-6 text-gray-900">Subscribe to
                                            our newsletter</label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Push Notifications
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">We deliver the domestic violence
                                    notifications straight in your browser
                                    notification system, choose below which cities' police departaments you would like
                                    to receive.</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-everything" name="push-notifications" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600">
                                        <label for="push-everything"
                                               class="block text-sm font-medium leading-6 text-gray-900">Subscribe to
                                            St.Petersburg PD</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-email" name="push-notifications" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600">
                                        <label for="push-email"
                                               class="block text-sm font-medium leading-6 text-gray-900">Subscribe to
                                            Orlando PD</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Update notifications
                            </button>
                        </div>
                    </div>

                    <div class="pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Danger zone</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important
                            changes, but
                            you pick what else you want to hear about.</p>

                        <div class="mt-10 space-y-10">
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Remove account
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">If you would like to receive our
                                    newsletter just check the box bellow.</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <button type="submit"
                                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                            <v-icon class="pb-1">mdi-close</v-icon>
                                            Remove my account
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
