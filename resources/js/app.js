document.getElementById('start-button').addEventListener('click', handleConnectClick);
document.getElementById('stop-button').addEventListener('click', handleDisconnectClick);

/**
 * Handle the connection with the blink1 device
 * @returns {Promise<void>}
 */
async function handleConnectClick() {
    await openDevice();
}

/**
 * Handle the disconnect with the blink1 device
 * @returns {Promise<void>}
 */
async function handleDisconnectClick() {
    let acolor = [0, 0, 0]; // off
    let device = await openDevice();
    if (!device) return;
    await fadeToColor(device, acolor);
    await device.close();
}

/**
 * Open the device connection preparing it for the next connection
 * @returns {Promise<*|null>}
 */
async function openDevice() {
    const vendorId = 0x27b8; // blink1 vid
    const productId = 0x01ed;  // blink1 pid

    const device_list = await navigator.hid.getDevices();

    let device = device_list.find(d => d.vendorId === vendorId && d.productId === productId);

    if (!device) {
        // this returns an array now
        let devices = await navigator.hid.requestDevice({
            filters: [{vendorId, productId}],
        });
        console.log("devices:", devices);
        device = devices[0];

        if (!device) return null;
    }

    if (!device.opened) {
        await device.open();
    }

    updateId(device.id)
    updateStatus('Blink1 device connected!')

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

// This function is responsible for updating the support text for the blink1 Id interface
let updateId = function (id) {
    blink1Id.innerText = id;
}
// This function is responsible for updating the support text for the user interface
let updateStatus = function (statusStr) {
    blink1Status.innerText = statusStr;
};

/**
 * Detects new changes on the specific channel, when it detects a new event it will trigger a random color blink.
 */
Echo.channel(`police-department.33705`).listen('DomesticAbuseDetected', async (e) => {
    console.log('Connected to the channel #33705')

    // This will make the background blink and turn off in 3 seconds
    blinkPurpleAndTurnOff();


    let device = await openDevice();
    if (!device) return;
    await fadeToColor(device, [255, 0, 255]);
    await fadeToColor(device, [0,0,0])
});


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
