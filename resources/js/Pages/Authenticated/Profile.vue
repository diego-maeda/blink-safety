<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// Localization
import {useI18n} from "vue-i18n";

const {t, locale} = useI18n();

const props = defineProps({
    user: Object,
    language: Object,
    notifications: Object,
});

let profile = useForm({
    name: props.user.name,
    email: props.user.email,
    photo: '',
});

let language = useForm({
    language: props.language.language
});

let notifications = useForm({
    email: props.notifications?.email,
    push_pd_st_petersburg: props.notifications?.push_pd_st_petersburg,
    push_pd_orlando: props.notifications?.push_pd_orlando,
    lifx_pd_st_petersburg: props.notifications?.lifx_pd_st_petersburg,
    lifx_pd_orlando: props.notifications?.lifx_pd_orlando
});

let profile_delete = useForm({
    modal: false,
});

function submitProfile() {
    profile.post('/profile');
}

function submitLanguage() {
    language.put('/language', {
        onSuccess() {
            locale.value = language.language;
        },
    })
}

function submitNotifications() {
    notifications.put('/notifications');
}

function submitDeleteProfile() {
    profile.delete('/profile');
}


// Browser notifications
import * as PusherPushNotifications from "@pusher/push-notifications-web";

let browserInfo = navigator.userAgent;

if (browserInfo.includes('Opera') || browserInfo.includes('Opr') || browserInfo.includes('Edg') || browserInfo.includes('Chrome') || browserInfo.includes('Firefox')) {
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: import.meta.env.VITE_PUSHER_BEAMS_INSTANCE_ID,
    });

    checkForNotificationStatus(beamsClient);
    notifications.beamsClient = beamsClient
} else {
    notifications.notifications_not_available = true;
}

/**
 * Check if the user is subscribed to the pusher notification for this channel already
 */
function checkForNotificationStatus(beamsClient) {
    beamsClient.start();
    let interests = beamsClient.getDeviceInterests();
    interests.then(function (i) {
        notifications.notifications = i;
    });
}

/**
 * Toggle the notifications on and off
 */
function toggleNotification(value) {
    notifications.beamsClient.start();

    if (notifications.notifications.includes(value)) {
        notifications.beamsClient.removeDeviceInterest(value)
            .then(() => console.log('Unsubscribed @ ' + value + '!'))
    } else {
        notifications.beamsClient.addDeviceInterest(value)
            .then(() => console.log('Subscribed @ ' + value + '!'))

    }
}

</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $t('profile.page_title') }}</h2>
        </template>

        <div class="w-full mx-auto sm:px-6 py-12">
            <div class="rounded-lg border border-stroke bg-white px-7.5 py-6 shadow-default">
                <div class="space-y-12 px-15">
                    <!-- Profile -->
                    <form @submit.prevent="submitProfile" class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">
                            {{ $t('profile.profile.title') }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            {{ $t('profile.profile.subtitle') }}</p>
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="name"
                                       class="block text-sm font-medium leading-6 text-gray-900">{{
                                        $t('profile.profile.form_name_label')
                                    }}
                                    <small>[{{ $t('profile.profile.form_required_label') }}]</small></label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                           v-model="profile.name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="text-sm text-red-500"
                                          v-if="profile.errors.name">{{ profile.errors.name }}</span>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{
                                        $t('profile.profile.form_email_label')
                                    }} <small>[{{ $t('profile.profile.form_required_label') }}]</small></label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                           v-model="profile.email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="text-sm text-red-500"
                                          v-if="profile.errors.email">{{ profile.errors.email }}</span>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="photo"
                                       class="block text-sm font-medium leading-6 text-gray-900">{{
                                        $t('profile.profile.form_photo_label')
                                    }}</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <input type="file" @input="profile.photo = $event.target.files[0]"/>
                                    <span class="text-sm text-red-500"
                                          v-if="profile.errors.photo">{{ profile.errors.photo }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $t('profile.profile.cancel_button') }}
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                {{ $t('profile.profile.update_profile_button') }}
                            </button>
                        </div>
                    </form>
                    <!-- Profile -->

                    <!-- Language -->
                    <form @submit.prevent="submitLanguage" class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">{{
                                $t('profile.language.title')
                            }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ $t('profile.language.subtitle') }}</p>

                        <div class="mt-1 space-y-10">
                            <fieldset>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="english" name="english" type="radio"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               value="en" v-model="language.language">
                                        <label for="english"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.language.english')
                                            }}</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="spanish" name="spanish" type="radio"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               value="es" v-model="language.language">
                                        <label for="spanish"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.language.spanish')
                                            }}</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="portuguese" name="portuguese" type="radio"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               value="pt-br" v-model="language.language">
                                        <label for="portuguese"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.language.portuguese')
                                            }}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $t('profile.language.cancel_button') }}
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                {{ $t('profile.language.update_language_button') }}
                            </button>
                        </div>
                    </form>
                    <!-- Language -->

                    <!-- Notifications -->
                    <form class="border-b border-gray-900/10 pb-12" @submit.prevent="submitNotifications">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">{{
                                $t('profile.notifications.title')
                            }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ $t('profile.notifications.subtitle') }}</p>

                        <div class="mt-10 space-y-10">
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">
                                    {{ $t('profile.notifications.email_title') }}
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">{{
                                        $t('profile.notifications.email_subtitle')
                                    }}</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-everything" name="push-notifications" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               v-model="notifications.email">
                                        <label for="push-everything"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.notifications.form_email_label')
                                            }}</label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">
                                    {{ $t('profile.notifications.push_title') }}
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    {{ $t('profile.notifications.push_subtitle') }}</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-st-petersburg-pd" name="push-st-petersburg-pd" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               v-model="notifications.push_pd_st_petersburg">
                                        <label for="push-st-petersburg-pd"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.notifications.form_stpetersburg_label')
                                            }}</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="push-orlando-pd" name="push-orlando-pd" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               v-model="notifications.push_pd_orlando">
                                        <label for="push-orlando-pd"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.notifications.form_orlando_label')
                                            }}</label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">
                                    {{ $t('profile.notifications.lifx_title') }}
                                </legend>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    {{ $t('profile.notifications.lifx_subtitle') }}</p>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="lifx-st-petersburg-pd" name="lifx-st-petersburg-pd" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               v-model="notifications.lifx_pd_st_petersburg">
                                        <label for="lifx-st-petersburg-pd"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.notifications.form_stpetersburg_label')
                                            }}</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="lifx-orlando-pd" name="lifx-orlando-pd" type="checkbox"
                                               class="h-4 w-4 border border-gray-300 text-purple-600 focus:ring-purple-600"
                                               v-model="notifications.lifx_pd_orlando">
                                        <label for="lifx-orlando-pd"
                                               class="block text-sm font-medium leading-6 text-gray-900">{{
                                                $t('profile.notifications.form_orlando_label')
                                            }}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $t('profile.notifications.cancel_button') }}
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                {{ $t('profile.notifications.update_notification_button') }}
                            </button>
                        </div>
                    </form>
                    <!-- Notifications -->

                    <!-- Danger Zone -->
                    <div class="pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">{{ $t('profile.danger_zone.title') }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ $t('profile.danger_zone.subtitle') }}</p>

                        <div class="mt-10 space-y-10">
                            <fieldset class="flex items-center justify-between">
                                <div>
                                    <legend class="text-sm font-semibold leading-6 text-gray-900">
                                        {{ $t('profile.danger_zone.remove_account_title') }}
                                    </legend>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">
                                        {{ $t('profile.danger_zone.remove_account_subtitle') }}</p>
                                </div>
                                <div class="mt-6 space-y-6">
                                    <div>
                                        <button @click="profile_delete.modal = true"
                                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                            <v-icon class="pb-1">mdi-close</v-icon>
                                            {{ $t('profile.danger_zone.remove_my_account_button') }}
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <v-dialog max-width="620" v-model="profile_delete.modal">
                            <v-card class="rounded-lg">
                                <div class="flex px-6 pb-4 pt-5">
                                    <div class="mr-4">
                                        <div
                                            class="h-12 w-12 rounded-full bg-yellow-50 flex justify-center items-center">
                                            <v-icon color="yellow-darken-1">mdi-alert-outline</v-icon>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-sans font-semibold text-gray-900 leading-6 tracking-tight text-base">
                                            {{ $t('profile.danger_zone.modal.title') }}
                                        </p>
                                        <p class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-2">
                                            {{ $t('profile.danger_zone.modal.first_paragraph') }}
                                        </p>
                                        <p class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-2">
                                            {{ $t('profile.danger_zone.modal.second_paragraph') }}
                                        </p>
                                        <ul class="list-disc ml-5 mt-3">
                                            <li class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-1">
                                                <strong>{{$t('profile.danger_zone.modal.loss_access_title')}}</strong>:
                                                {{$t('profile.danger_zone.modal.loss_access_description')}}
                                            </li>
                                            <li class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-1">
                                                <strong>{{$t('profile.danger_zone.modal.potential_inconvenience_title')}}</strong>:
                                                {{$t('profile.danger_zone.modal.potential_inconvenience_description')}}

                                            </li>
                                            <li class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-1">
                                                <strong>{{$t('profile.danger_zone.modal.alternatives_title')}}</strong>:
                                                {{$t('profile.danger_zone.modal.alternatives_description')}}

                                            </li>
                                        </ul>
                                        <p class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-2">
                                            {{ $t('profile.danger_zone.modal.last_paragraph') }}
                                        </p>
                                    </div>
                                </div>

                                <v-card-actions class="bg-gray-100 px-6 py-3">
                                    <v-spacer></v-spacer>

                                    <button @click="profile_delete.modal = false"
                                        class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-500 border-gray-100 border
                                        shadow-sm mb-1 md:mr-1 hover:bg-gray-500 focus-visible:outline
                                        focus-visible:outline-2 focus-visible:outline-offset-2
                                        focus-visible:outline-gray-500 w-full max-w-48"
                                        style="height: 38px">
                                        {{ $t('profile.danger_zone.modal.cancel_button') }}
                                    </button>
                                    <button @click="submitDeleteProfile" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm mb-1 hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 w-full max-w-48" style="height: 38px">
                                        <v-icon class="pb-1">mdi-close</v-icon>
                                        {{ $t('profile.danger_zone.modal.confirm_button') }}
                                    </button>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </div>
                    <!-- Danger Zone -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
