<script setup>
import {router} from '@inertiajs/vue3'
import {useForm} from "@inertiajs/vue3";
import {useI18n} from "vue-i18n";

// Localization
const {t, locale} = useI18n({useScope: "global"});

// Notifications
import * as PusherPushNotifications from "@pusher/push-notifications-web";

const beamsClient = new PusherPushNotifications.Client({
    instanceId: 'f25f92d2-c8a5-42f2-92e7-d20701f3a6e8',
});

const props = defineProps({
    precinct: String
})

let form = useForm({
    dialog: false,
    notifications: false,
    language: locale.value
})

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
function checkForNotificationStatus() {
    let interests = beamsClient.getDeviceInterests();
    interests.then(function (i) {
        form.notifications = i.includes(props.precinct);
    })
}
checkForNotificationStatus()


/**
 * Toggle the notifications on and off
 */
function toggleNotification() {
    beamsClient.start();

    if (!form.notifications) {
        beamsClient.addDeviceInterest('debug-' + props.precinct)
            .then(() => console.log('Subscribed @ ' + props.precinct + '!'))
    } else {
        beamsClient.removeDeviceInterest('debug-' + props.precinct)
            .then(() => console.log('Unsubscribed @ ' + props.precinct + '!'))
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
            <v-list
                lines="two"
                subheader
            >
                <v-list-subheader>{{ $t('message.notifications') }}</v-list-subheader>
                <v-list-item :title="$t('message.push_notifications')" :subtitle="$t('message.receive_messages')">
                    <template v-slot:prepend>
                        <v-checkbox
                            v-model="form.notifications"
                            color="primary"
                            class="pt-3"
                            @click="toggleNotification"
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
                            href="https://github.com/diego-maeda/blink-safety"
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


