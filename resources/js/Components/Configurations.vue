<script setup>
import {router} from '@inertiajs/vue3'

// Localization
import {useI18n} from "vue-i18n";
const {t, locale} = useI18n({useScope: "global"});

const props = defineProps({
    precinct: String
})

// Form
import {useForm} from "@inertiajs/vue3";
let form = useForm({
    dialog: false,
    notifications: [],
    language: locale.value
})


// Notifications
import * as PusherPushNotifications from "@pusher/push-notifications-web";

let browserInfo = navigator.userAgent;

if (browserInfo.includes('Opera') || browserInfo.includes('Opr') || browserInfo.includes('Edg') || browserInfo.includes('Chrome') || browserInfo.includes('Firefox')) {
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: import.meta.env.VITE_PUSHER_BEAMS_INSTANCE_ID,
    });
    checkForNotificationStatus(beamsClient);
    form.beamsClient = beamsClient
} else {
    alert('This feature is not allowed in your browser.');
}



// City config
/**
 * This function will redirect the user according to the city choosen
 * @param city
 */
function visit(city) {
    let url = `/${city}`;
    router.visit(url, {method: 'get'});
}

/**
 * Check if the user is subscribed to the pusher notification for this channel already
 */
function checkForNotificationStatus(beamsClient) {
    beamsClient.start();
    let interests = beamsClient.getDeviceInterests();
    interests.then(function (i) {
        form.notifications = i;
    });
}

/**
 * Toggle the notifications on and off
 */
function toggleNotification(value) {
    form.beamsClient.start();

    if (form.notifications.includes(value)) {
        form.beamsClient.removeDeviceInterest(value)
            .then(() => console.log('Unsubscribed @ ' + value + '!'))
    } else {
        form.beamsClient.addDeviceInterest(value)
            .then(() => console.log('Subscribed @ ' + value + '!'))

    }
}

// Language Config
import en from "../../img/icons/english.svg";
import pt from "../../img/icons/portuguese.svg";
import es from "../../img/icons/spanish.svg";

function changeLang(language) {
    locale.value = language;
}
</script>

<template>
    <v-dialog
        v-model="form.dialog"
        fullscreen
        :scrim="false"
        transition="dialog-bottom-transition"
    >
        <template v-slot:activator="{ props }">
            <v-btn
                color="purple-accent-2"
                variant="text"
                icon
                v-bind="props"
            >
                <v-icon>mdi-cog-outline</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-toolbar
                dark
                color="primary"
            >
                <v-btn
                    icon
                    dark
                    @click="form.dialog = false"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>{{ $t('message.settings') }}</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-list
                lines="two"
                subheader
            >
                <v-list-subheader>{{ $t('message.cities') }}</v-list-subheader>
                <v-list-item>
                    <v-chip-group>
                        <v-chip @click="visit('fl/st-petersburg')">
                            St. Petersburg
                        </v-chip>

                        <v-chip @click="visit('fl/orlando')">
                            Orlando
                        </v-chip>
                    </v-chip-group>
                </v-list-item>
            </v-list>
            <v-list
                lines="two"
                subheader
            >
                <v-list-subheader>{{ $t('message.language') }}</v-list-subheader>
                <v-list-item>
                    <v-chip-group
                        :value="form.language"
                        mandatory selected-class="text-primary">
                        <v-chip tag="en" @click="changeLang('en')">
                            {{ $t('message.english') }}
                            <img :src="en" alt="English" height="18" width="18" class="ml-2">
                        </v-chip>

                        <v-chip tag="es" @click="changeLang('es')">
                            {{ $t('message.spanish') }}
                            <img :src="es" alt="Spanish" height="18" width="18" class="ml-2">
                        </v-chip>

                        <v-chip tag="pt-br" @click="changeLang('pt-br')">
                            {{ $t('message.portuguese') }}
                            <img :src="pt" alt="Portuguese" height="18" width="18" class="ml-2">
                        </v-chip>
                    </v-chip-group>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list lines="two" density="compact">
                <v-list-subheader>{{ $t('message.notifications') }}</v-list-subheader>
                <v-list-item :title="$t('message.subscribe_st_petersburg_pd')" :subtitle="$t('message.receive_messages')">
                    <template v-slot:prepend>
                        <v-checkbox
                            v-model="form.notifications"
                            color="primary"
                            class="pt-4"
                            value="33705"
                            @click="toggleNotification('33705')"
                        ></v-checkbox>
                    </template>
                </v-list-item>
                <v-list-item :title="$t('message.subscribe_orlando_pd')" :subtitle="$t('message.receive_messages')">
                    <template v-slot:prepend>
                        <v-checkbox
                            v-model="form.notifications"
                            color="primary"
                            class="pt-4"
                            value="32803"
                            @click="toggleNotification('32803')"
                        ></v-checkbox>
                    </template>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-spacer></v-spacer>
            <v-footer class="flex justify-center px-4 py-2 text-center w-100">
                <v-row>
                    <v-col class="text-center text-gray-300 mt-4" cols="12">
                        <span class="text-gray-300">
                              Made with <v-icon class="text-red-600">mdi-heart</v-icon> by <a
                            href="https://github.com/saintpete/blink-safety"
                            target="_blank"><strong>Blink Safety</strong></a> in {{ new Date().getFullYear() }}
                        </span>
                    </v-col>
                </v-row>
            </v-footer>
        </v-card>
    </v-dialog>
</template>

<style>
.dialog-bottom-transition-enter-active,
.dialog-bottom-transition-leave-active {
    transition: transform .2s ease-in-out;
}
</style>


