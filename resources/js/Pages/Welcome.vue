<script setup>
import {Head} from '@inertiajs/vue3';
import logo from '/resources/img/blink-safety-logo.svg';
import heatMap from '/resources/img/heat-map.png';

// List of the precincts enabled to select
let precincts_list = [
    {
        label: 'St. Petersburg PD',
        value: '33705'
    },
    {
        label: 'Miami PD',
        value: '33128',
    }
]

// List of selected precincts
let precincts = [
    {
        label: 'St. Petersburg PD',
        value: '33705'
    },
]

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

// /**
//  * Detects new changes on the specific channel, when it detects a new event it will trigger a random color blink.
//  */
// Echo.channel(`police-department.33705`).listen('DomesticAbuseDetected', async (e) => {
//     console.log('Connected to the channel #33705')
//
//     // This will make the background blink and turn off in 3 seconds
//     blinkPurpleAndTurnOff();
//
//     let device = await openDevice();
//     console.log('Device: ' + device);
//     if (!device) return;
//     await fadeToColor(device, [255, 0, 255]);
//     await sleep(1000);
//     await fadeToColor(device, [0,0,0]);
//     await sleep(1000);
//     await fadeToColor(device, [255, 0, 255]);
//     await sleep(1000);
//     await fadeToColor(device, [0,0,0]);
//
// });

/**
 * This code will blink the background of the code when a new event is received
 */
function blinkPurpleAndTurnOff() {
    let intervalId;

    let bg = document.getElementById('alertBg');

    function togglePurple() {
        bg.style.backgroundColor = bg.style.backgroundColor === "purple" ? "" : "purple";
    }

    intervalId = setInterval(togglePurple, 500); // Blink every second

    setTimeout(() => {
        clearInterval(intervalId);
        bg.style.backgroundColor = ""; // Ensure background is off after stopping
    }, 3000);
}

/**
 * Creates a new sleep function which stops the app from closing
 * @param ms
 * @returns {Promise<unknown>}
 */
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function togglePrecinctList(precinct) {
    console.log(`Precinct ${precinct.label} was toggled`)
    console.log(`Connected to the channel #${precinct.value}`)

    Echo.channel(`police-department.${precinct.value}`).listen('DomesticAbuseDetected', async (e) => {

        // This will make the background blink and turn off in 3 seconds
        blinkPurpleAndTurnOff();

        let device = await openDevice();
        console.log('Device: ' + device);
        if (!device) return;
        await fadeToColor(device, [255, 0, 255]);
        await sleep(1000);
        await fadeToColor(device, [0, 0, 0]);
        await sleep(1000);
        await fadeToColor(device, [255, 0, 255]);
        await sleep(1000);
        await fadeToColor(device, [0, 0, 0]);
    });
}

</script>

<template>
    <Head title="Welcome to"/>

    <v-app>
        <!-- NAVBAR -->
        <v-app-bar :elevation="2">
            <v-img :src="logo" max-height="40" max-width="150" contain></v-img>

            <v-spacer></v-spacer>

            <a href="https://www.casapinellas.org/" target="_blank" class="mx-3">
                Want to support this cause?
                Donate to CASA
            </a>
            <a href="https://github.com/diego-maeda/blink-safety" target="_blank" class="mr-5">
                <v-icon icon="mdi-github" size="x-large" variant="text"></v-icon>
            </a>
        </v-app-bar>
        <!-- NAVBAR -->
        <!-- MAIN -->
        <v-main>
            <div class="min-h-screen w-full flex flex-row">
                <!-- CONFIGURATION SIDE -->
                <div class="bg-primary w-1/2 p-7">
                    <p><strong>Status:</strong> <span v-html="device_status"></span></p>
                    <div class="flex justify-between align-baseline my-5">
                        <v-btn variant="tonal" size="x-large" @click="handleConnectClick" v-if="!connected">Connect to
                            blink(1)
                        </v-btn>
                        <v-btn variant="tonal" size="x-large" @click="handleDisconnectClick" v-else>Disconnect from
                            blink(1)
                        </v-btn>
                        <a href="https://www.amazon.com/gp/product/B07Q8944QK/ref=as_li_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=B07Q8944QK&linkCode=as2&tag=todbotblog-20&linkId=b78c29206e17ec0a6efaba7463a50168&th=1"
                           target="_blank" class="underline text-lg">Order Blink(1) on Amazon</a>
                    </div>
                    <div>
                        <p class="mb-2 text-base">Monitor the following agencies for Domestic Violence Incidents</p>
                        <div class="bg-white rounded-lg">
                            <v-checkbox
                                v-model="precincts"
                                :label="precinct.label"
                                color="purple"
                                :value="precinct"
                                hide-details
                                v-for="precinct in precincts_list"
                                @change="togglePrecinctList(precinct)"
                            ></v-checkbox>
                        </div>
                    </div>
                </div>
                <!-- CONFIGURATION SIDE -->
                <!-- STATS SIDE -->
                <div class="bg-secondary w-1/2 p-7">
                    <div>
                        <div class="flex justify-between my-5">
                            <v-card
                                class="mx-auto"
                                max-width="255"
                                variant="tonal"
                            >
                                <v-card-item>
                                    <div>
                                        <div class="text-overline mb-1">
                                            Tonal
                                        </div>
                                        <div class="text-h6 mb-1">
                                            Headline
                                        </div>
                                        <div class="text-caption">Greyhound divisely hello coldly fonwderfully</div>
                                    </div>
                                </v-card-item>
                            </v-card>
                            <v-card
                                class="mx-auto"
                                max-width="255"
                                variant="tonal"
                            >
                                <v-card-item>
                                    <div>
                                        <div class="text-overline mb-1">
                                            Tonal
                                        </div>
                                        <div class="text-h6 mb-1">
                                            Headline
                                        </div>
                                        <div class="text-caption">Greyhound divisely hello coldly fonwderfully</div>
                                    </div>
                                </v-card-item>
                            </v-card>
                            <v-card
                                class="mx-auto"
                                max-width="255"
                                variant="tonal"
                            >
                                <v-card-item>
                                    <div>
                                        <div class="text-overline mb-1">
                                            Tonal
                                        </div>
                                        <div class="text-h6 mb-1">
                                            Headline
                                        </div>
                                        <div class="text-caption">Greyhound divisely hello coldly fonwderfully</div>
                                    </div>
                                </v-card-item>
                            </v-card>
                        </div>
                    </div>
                    <div class="">
                        <p class="mb-2">List of the 5 last cases</p>
                        <div class="bg-white rounded-lg px-3 py-2">
                            <p>case 1:</p>
                            <p>case 2:</p>
                            <p>case 3:</p>
                            <p>case 4:</p>
                            <p>case 5:</p>
                        </div>
                    </div>

                    <div id="heat-map" class="rounded-lg overflow-hidden mt-2">
                        <v-img :src="heatMap"></v-img>
                    </div>
                </div>
                <!-- STATS SIDE -->
            </div>
        </v-main>

        <!-- FOOTER -->
        <v-footer class="bg-purple-darken-4">
            <div class="flex w-full align-content-center flex-col mt-3">
                <div class="flex justify-center">
                    <a href="https://github.com/diego-maeda/blink-safety" target="_blank">
                        <v-btn class="mx-4" icon="mdi-github" variant="text"></v-btn>
                    </a>
                    <a href="https://www.casapinellas.org/" target="_blank">
                        <v-btn class="mx-4 py-3" variant="text">CASA</v-btn>
                    </a>
                </div>
                <div class="flex justify-center my-2"><span class="mr-1">If you want to support our cause please consider donating to</span><a
                    href="https://www.casapinellas.org/donate/" target="_blank">CASA</a>
                </div>
                <div class="flex justify-center my-3">
                    {{ new Date().getFullYear() }} - Blink-Safety

                </div>
            </div>
        </v-footer>
        <!-- FOOTER -->
    </v-app>
</template>
