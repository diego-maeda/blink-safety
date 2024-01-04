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

import moment from "moment";


const props = defineProps({
        last_incident: Object,
        last_run: Object
    }
)

const data = reactive({
    connected: false,
    last_run: props.last_run,
    incident: props.last_incident,
    time_elapsed: '',
})

// Device status
let device_status = 'No device detected';

// Purple Color
let purple_color = [255, 0, 255];

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

    let device = await openDevice();
    if (!device) return;
    await fadeToColor(device, [255, 0, 255]);
    await sleep(1000);
    await fadeToColor(device, [0, 0, 0]);
    await sleep(1000);
    await fadeToColor(device, [255, 0, 255]);
    await sleep(1000);
    await fadeToColor(device, [0, 0, 0]);

});

/**
 * Everytime the database is updated we update the clock countdown
 */
Echo.channel('run').listen('DatabaseUpdated', async(event) => {
    console.log('Database has been updated!');

    // Update the last run data
    data.last_run.created_at = event.run.created_at;
    data.last_run.next_run = event.run.next_run;

    // Recalculate the elapsed time
    calculateElapsedTime();
})

/**
 * Creates a new sleep function which stops the app from closing
 * @param ms
 * @returns {Promise<unknown>}
 */
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function previousEvent() {
    // Load last event feed and replace the data on last_incident
    let last_id = Number(data.incident['id']);

    let id_search = last_id - 1

    if (id_search !== 0) {
        axios.get('/api/previous/' + id_search)
            .then((response) => {
                data.incident.id = response.data.last_incident.id;
                data.incident.since = response.data.last_incident.since;
                data.incident.time = response.data.last_incident.time;
                data.incident.type = response.data.last_incident.type;
                data.incident.display_address = response.data.last_incident.display_address;

            }).catch((error) => console.log(error));

        let device = await openDevice();
        if (!device) return;
        await fadeToColor(device, purple_color);
        await sleep(1000);
        await fadeToColor(device, black_color);
        await sleep(1000);
        await fadeToColor(device, purple_color);
        await sleep(1000);
        await fadeToColor(device, black_color);
    } else {
        console.log(`You have reached the first event`);
    }
}

// TODO This function needs to be re-triggered by pusher when a new event is run on the server

function calculateElapsedTime() {
    data.time_elapsed = moment.utc(props.last_run.created_at).fromNow();
}

calculateElapsedTime();
setInterval(calculateElapsedTime, 60 * 1000);

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
            <div class="h-full w-full flex flex-col justify-center items-center">
                <img :src="logo" height="80" width="177" class="mb-7" alt="Blink-Safety Logo">

                <p class="max-w-60 text-center text-lg"><strong>{{ data.incident['since'] }}</strong> since the last
                    <a href="https://stat.stpete.org/Government/St-Petersburg-Police-Department-Calls-for-Service-/6nse-tdf4" target="_blank" class="underline">police report</a> of a domestic violence incident in St. Peterburg FL</p>

                <div class="bg-purple-300 p-6 rounded-lg max-w-72 my-5">
                    <p>{{ data.incident['time'] }}</p>
                    <p>{{ data.incident['type'] }}</p>
                    <p>{{ data.incident['display_address'] }}</p>
                </div>

                <div class="text-purple-900">
                    <a href="https://github.com/diego-maeda/blink-safety" target="_blank">About</a> |
                    <a @click="handleDisconnectClick" class="cursor-pointer" v-if="data.connected">Disconnect</a>
                    <a @click="handleConnectClick" class="cursor-pointer" v-if="!data.connected">Connect</a>
                    <a @click="previousEvent" class="cursor-pointer" v-if="data.connected"> | Previous</a>
                </div>

                <div class="text-gray-600 text-center mt-3">
                    <p>Last updated: {{ data.time_elapsed }}</p>
                    <p>Updating next at {{ data.last_run['next_run'] }}</p>
                </div>
            </div>
        </v-main>
        <!-- MAIN -->
    </v-app>
</template>
