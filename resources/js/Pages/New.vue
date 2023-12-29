<script setup>
import {Head} from '@inertiajs/vue3';
import logo from '/resources/img/blink-safety-logo.svg';

defineProps({ last_incident: Object })

// Is device connected
let connected = false;

// Device status
let device_status = 'No device detected';

// Purple Color
let purple_color = [255, 0, 255];

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
    await fadeToColor(device, black_color);
    await device.close();
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

    // Update the device status
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
Echo.channel(`police-department.33705`).listen('DomesticAbuseDetected', async (e) => {
    console.log('Connected to the channel #33705')

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
 * Creates a new sleep function which stops the app from closing
 * @param ms
 * @returns {Promise<unknown>}
 */
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function testBlink1(){
    let device = await openDevice();
    if (!device) return;
    await fadeToColor(device, [255, 0, 0]);
    await sleep(1000);
    await fadeToColor(device, [0, 255, 0]);
    await sleep(1000);
    await fadeToColor(device, [0, 0, 255]);
    await sleep(1000);
    await fadeToColor(device, [0, 0, 0]);
}

</script>

<template>
    <Head title="Welcome to"/>

    <v-app>
        <!-- MAIN -->
        <v-main>
            <div class="h-full w-full flex flex-col justify-center items-center">
                <img :src="logo" height="80" width="177" class="mb-7" alt="Blink-Safety Logo">

                <p class="max-w-60 text-center text-lg"><strong>{{ last_incident['since'] }}</strong> since last reported domestic violence incident in St. Peterburg FL</p>

                <div class="bg-purple-300 p-6 rounded-lg max-w-72 my-5">
                    <p>{{last_incident['time']}}</p>
                    <p>{{ last_incident['type'] }}</p>
                    <p>{{ last_incident['display_address'] }}</p>
                </div>

                <div class="text-purple-900">
                    <a href="https://github.com/diego-maeda/blink-safety" target="_blank">About</a> |
                    <a v-if="connected" @click="handleDisconnectClick" class="cursor-pointer">Disconnect</a>
                    <a v-else @click="handleConnectClick" class="cursor-pointer">Connect</a>
                    <a @click="testBlink1" v-if="connected" class="cursor-pointer"> | Test</a>
                </div>
            </div>
        </v-main>
        <!-- MAIN -->
    </v-app>
</template>
