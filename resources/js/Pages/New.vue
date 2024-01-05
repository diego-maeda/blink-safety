<script setup>
import {Head} from '@inertiajs/vue3';
import logo from '/resources/img/blink-safety-logo.svg';
import axios from 'axios';
import {reactive} from 'vue'

// Favicon import
import appleTouchIcon from '/resources/img/apple-touch-icon.png';
import favicon32 from '/resources/img/favicon-32x32.png'
import favicon16 from '/resources/img/favicon-16x16.png'
import favicon from '/resources/img/favicon.ico'
import siteManifest from '/resources/img/site.webmanifest';


//Locale imports
import {useI18n} from "vue-i18n";

const {t, locale} = useI18n({useScope: "global"});
import en from '/resources/img/icons/en.png';
import es from '/resources/img/icons/es.png';
import pt from '/resources/img/icons/pt.png';

import moment from "moment";
import 'moment/dist/locale/pt-br';
import 'moment/dist/locale/es.js';

moment.locale('es')
moment.locale('pt-br')

const props = defineProps({
        last_incident: Object,
        last_run: Object
    }
)

const data = reactive({
    // Blink1 Status
    connected: false,
    // Incident options
    incident: props.last_incident,
    time_incident_elapsed: '',
    // Last run options
    last_run: props.last_run,
    time_elapsed: '',
    next_update: '',
    // Dialog options - Prev/Next Functions
    dialog: false,
    dialog_message: '',
    // Language selector
    lang: 0,
})

// Device status
let device_status = 'No device detected';

// Purple Color
let purple_color = [255, 0, 255];

// Pink Color
let pink_color = [255, 56, 152];

// Red Color
let red_color = [255, 0, 0];

// Off Color
let black_color = [0, 0, 0];

/**
 * Handle the connection with the blink1 device
 * @returns {Promise<void>}
 */
async function handleConnectClick() {
    // Try to open the device
    let device = await openDevice();

    // Signal to the user that the device connected
    await fadeToColor(device, purple_color);
    await sleep(500);
    await fadeToColor(device, black_color);
    await sleep(500);
    await fadeToColor(device, purple_color);
    await sleep(500);
    await fadeToColor(device, black_color);
    await sleep(500);
}

/**
 * Handle the disconnect with the blink1 device
 * @returns {Promise<void>}
 */
async function handleDisconnectClick() {
    let device = await openDevice();
    if (!device) return;

    console.log('Disconnecting...')

    await fadeToColor(device, red_color);
    await sleep(500);
    await fadeToColor(device, black_color);
    await sleep(500);
    await fadeToColor(device, red_color);
    await sleep(500);
    await fadeToColor(device, black_color);
    await device.close();

    data.connected = false;
}

/**
 * Open the device connection preparing it for the next connection
 * @returns {Promise<*|null>}
 */
async function openDevice() {
    const vendorId = 0x27b8; // blink1 vid
    const productId = 0x01ed;  // blink1 pid

    // Await the devices connected to the navigator
    const device_list = await navigator.hid.getDevices();

    // List all the devices
    let device = device_list.find(d => d.vendorId === vendorId && d.productId === productId);

    if (!device) {
        // This returns an array now
        let devices = await navigator.hid.requestDevice({
            filters: [{vendorId, productId}],
        });

        // Selects the first device on the list
        device = devices[0];

        // If no device is found
        if (!device) return null;
    }

    // Open the device if no device is open
    if (!device.opened) {
        await device.open();
    }

    data.connected = true;

    // Update the device status
    console.log('Blink(1) device connected!');
    device_status = 'Blink(1) device connected!';

    // Returns the device selected
    return device;
}

/**
 * This function converts the color to send to the device
 * @param device
 * @param r
 * @param g
 * @param b
 * @returns {Promise<void>}
 */
async function fadeToColor(device, [r, g, b]) {
    if (!device) return;
    const reportId = 1;
    const data = Uint8Array.from([0x63, r, g, b, 0x00, 0x10, 0x00, 0x00]);
    try {
        await device.sendFeatureReport(reportId, data);
    } catch (error) {
        console.error('fadeToColor: failed:', error);
    }
}

/**
 * Detects new changes on the specific channel, when it detects a new event it will trigger a random color blink.
 */
Echo.channel(`police-department.33705`).listen('DomesticAbuseDetected', async (event) => {
    console.log('Connected to the channel #33705')

    data.incident.id = event.id;
    data.incident.since = event.since;
    data.incident.time = event.time;
    data.incident.type = event.type;
    data.incident.display_address = event.display_address;
    calculateElapsedIncident();

    let device = await openDevice();
    if (!device) return;
    await fadeToColor(device, purple_color);
    await sleep(1000);
    await fadeToColor(device, black_color);
    await sleep(1000);
    await fadeToColor(device, purple_color);
    await sleep(1000);
    await fadeToColor(device, black_color);
    await sleep(1000);
    await fadeToColor(device, purple_color);

}).listen('EmptyResultsDetected', async (event) => {
    //If no results are detected
    let device = await openDevice();
    if (!device) return;
    await fadeToColor(device, black_color);
    await sleep(1000);
});

/**
 * Everytime the database is updated we update the clock countdown
 */
Echo.channel('run').listen('DatabaseUpdated', async (event) => {
    console.log('Database has been updated!');

    // Update the last run data
    data.last_run.created_at = event.run.created_at;
    data.last_run.next_run = event.run.next_run;

    // Recalculate the elapsed time
    calculateElapsedTime();
    calculateNextRunTime();
})

/**
 * Creates a new sleep function which stops the app from closing
 * @param ms
 * @returns {Promise<unknown>}
 */
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

/**
 * Loads the previous event
 * @returns {Promise<void>}
 */
async function previousEvent() {
    // Load last event feed and replace the data on last_incident
    let last_id = Number(data.incident['id']);

    let id_search = last_id - 1

    if (id_search !== 0) {
        axios.get('/api/find-event/' + id_search)
            .then(async (response) => {
                data.incident.id = response.data.last_incident.id;
                data.incident.since = response.data.last_incident.since;
                data.incident.time = response.data.last_incident.time;
                data.incident.type = response.data.last_incident.type;
                data.incident.display_address = response.data.last_incident.display_address;

                let device = await openDevice();
                if (!device) return;
                await fadeToColor(device, pink_color);
                await sleep(1000);
                await fadeToColor(device, black_color);
                await sleep(1000);
                await fadeToColor(device, pink_color);
                await sleep(1000);
                await fadeToColor(device, black_color);

            }).catch(function (error) {
                if (error.response) {
                    data.dialog_message = t('message.first_event');
                    data.dialog = true;
                }
            }
        );
    }
}

/**
 * Loads the next event
 * @returns {Promise<void>}
 */
async function nextEvent() {
    // Load last event feed and replace the data on last_incident
    let last_id = Number(data.incident['id']);

    let id_search = last_id + 1

    if (id_search !== 0) {
        axios.get('/api/find-event/' + id_search)
            .then(async (response) => {
                data.incident.id = response.data.last_incident.id;
                data.incident.since = response.data.last_incident.since;
                data.incident.time = response.data.last_incident.time;
                data.incident.type = response.data.last_incident.type;
                data.incident.display_address = response.data.last_incident.display_address;

                let device = await openDevice();
                if (!device) return;
                await fadeToColor(device, pink_color);
                await sleep(1000);
                await fadeToColor(device, black_color);
                await sleep(1000);
                await fadeToColor(device, pink_color);
                await sleep(1000);
                await fadeToColor(device, black_color);

            }).catch(function (error) {
                if (error.response) {
                    data.dialog_message = t('message.last_event');
                    data.dialog = true;
                }
            }
        );
    }
}

/**
 * Calculate the elapsed time since the last incident
 */
function calculateElapsedIncident() {
    data.time_incident_elapsed = moment.utc(props.last_incident.since).fromNow(true);
}

calculateElapsedIncident();
setInterval(calculateElapsedTime, 60 * 1000);

/**
 * Calculate the elapsed time from the last run
 */
function calculateElapsedTime() {
    data.time_elapsed = moment.utc(props.last_run.created_at).fromNow();
}

calculateElapsedTime();
setInterval(calculateElapsedTime, 60 * 1000);

/**
 * Calculate the time for the next run
 */
function calculateNextRunTime() {
    data.next_update = moment.utc(props.last_run.next_run).fromNow();
}

calculateNextRunTime();
setInterval(calculateNextRunTime, 60 * 1000);

/**
 * Updates the translation according to the selected country flag
 * @param lang
 */
function updateLocale(lang) {
    console.log('Updating locale to: ' + lang);
    locale.value = lang;
    moment.locale(lang);
    calculateElapsedIncident();
    calculateElapsedTime();
    calculateNextRunTime();
}
</script>

<template>
    <Head>
        <title>Welcome to</title>
        <meta head-key="description" name="description" content="Blink-Safety bringing awareness to Domestic Violence"/>
        <link rel="apple-touch-icon" sizes="180x180" :href="appleTouchIcon">
        <link rel="icon" type="image/png" sizes="32x32" :href="favicon32">
        <link rel="icon" type="image/png" sizes="16x16" :href="favicon16">
        <link rel="icon" type="image/png" sizes="16x16" :href="favicon">
        <link rel="manifest" :href="siteManifest">
    </Head>

    <v-app>
        <!-- MAIN -->
        <v-main>
            <v-menu>
                <template v-slot:activator="{ props }">
                    <v-btn
                        icon
                        flat
                        v-bind="props"
                    >
                        <img :src="en" alt="USA flag" height="25" width="25" v-if="$i18n.locale === 'en'">
                        <img :src="pt" alt="Brazilian flag" height="25" width="25" v-else-if="$i18n.locale === 'pt-br'">
                        <img :src="es" alt="Mexican flag" height="25" width="25" v-else-if="$i18n.locale === 'es'">
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item class="border-b border-gray-100" @click="updateLocale('en')">
                        <template v-slot:prepend>
                            <img :src="en" alt="USA flag" height="25" width="25" class="mr-3">
                        </template>
                        <v-list-item-title><strong>{{$t('message.english')}}</strong></v-list-item-title>
                    </v-list-item>
                    <v-list-item class="border-b border-gray-100" @click="updateLocale('pt-br')">
                        <template v-slot:prepend>
                            <img :src="pt" alt="Brazilian flag" height="25" width="25" class="mr-3">
                        </template>
                        <v-list-item-title><strong>{{$t('message.portuguese')}}</strong></v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="updateLocale('es')">
                        <template v-slot:prepend>
                            <img :src="es" alt="Mexican flag" height="25" width="25" class="mr-3">
                        </template>
                        <v-list-item-title><strong>{{$t('message.spanish')}}</strong></v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
<!--            <select v-model="$i18n.locale" @change="updateLocale(locale)">-->
<!--                <option v-for="locale in $i18n.availableLocales" :key="`locale-${locale}`" :value="locale">-->
<!--                    <img :src="locale" alt="">{{ locale }}-->
<!--                </option>-->
<!--            </select>-->

            <div class="h-full w-full flex flex-col justify-center items-center">
                <img :src="logo" height="80" width="177" class="mb-7" alt="Blink-Safety Logo">

                <p class="max-w-60 text-center text-lg"><strong>{{ data.time_incident_elapsed }}</strong>
                    {{ $t('message.since_the_last') }}
                    <a href="https://stat.stpete.org/Government/St-Petersburg-Police-Department-Calls-for-Service-/6nse-tdf4"
                       target="_blank" class="underline">{{ $t('message.police_report') }}</a>
                    {{ $t('message.domestic_violence_in_st_petersburg') }}</p>


                <div class="bg-purple-300 p-6 rounded-lg max-w-72 my-5">
                    <p>{{ data.incident['time'] }}</p>
                    <p>{{ data.incident['type'] }}</p>
                    <p>{{ data.incident['display_address'] }}</p>
                </div>

                <div class="mb-3 ">
                    <v-btn color="purple" class="mr-1" tonal rounded @click="previousEvent">&lt; {{
                            $t('message.prev')
                        }}
                    </v-btn>
                    <v-btn color="purple" class="ml-1" tonal rounded @click="nextEvent">{{ $t('message.next') }} &gt;
                    </v-btn>
                </div>

                <div class="text-purple-900">
                    <a href="https://github.com/diego-maeda/blink-safety" target="_blank">{{ $t('message.about') }}</a>
                    |
                    <a @click="handleDisconnectClick" class="cursor-pointer" v-if="data.connected">{{$('message.disconnect')}}</a>
                    <a @click="handleConnectClick" class="cursor-pointer"
                       v-if="!data.connected">{{ $t('message.connect') }}</a>
                </div>

                <div class="text-gray-600 text-center mt-3">
                    <p>{{ $t('message.last_updated') }} {{ data.time_elapsed }}</p>
                    <p>{{ $t('message.updating_next') }} {{ data.next_update }}</p>
                </div>
            </div>
            <v-dialog
                v-model="data.dialog"
                width="auto"
            >
                <v-card>
                    <v-toolbar color="primary">
                        <v-toolbar-title>Blink-Safety</v-toolbar-title>

                        <v-spacer></v-spacer>

                        <v-btn icon="true" @click="data.dialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <div class="text-lg pa-12"> {{ data.dialog_message }}</div>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </v-main>
        <!-- MAIN -->
    </v-app>
</template>
