const BLINK1_VENDOR_ID = 10168;
let blink1Device;
let usb = navigator.usb;

let connected = false;

// this is what a HID Set Feature requests looks like in chrome.usb
let transferInfo = {
    "requestType": "class",
    "recipient": "interface",
    "direction": "out",
    "request": 0x09, // set_feature
    "value": 1, // report id?
    "index": 0,
    "data": new Uint8Array([0x01, 0x63, 0xFF, 0xCC, 0x33, 0x00, 0x20, 0x00, 0x00]).buffer
    // note data contains report id as first byte
};


// This function is responsible for updating the support text for the blink1 Id interface
let updateId = function (id) {
    blink1Id.innerText = id;
}
// This function is responsible for updating the support text for the user interface
let updateStatus = function (statusStr) {
    blink1Status.innerText = statusStr;
};

var randomColor = function () {
    if (!connected) return;

    var r = Math.floor((Math.random() * 255));
    var g = Math.floor((Math.random() * 255));
    var b = Math.floor((Math.random() * 255));

    console.log("randomColor: " + r + "," + g + "," + b);

    blink1_setColor(r, g, b, 100);

    setTimeout(randomColor, 1000);
}

let blink1_setColor = function (r, g, b, fadeMillis) {
    let rgbstr = "rgb(" + r + ", " + g + ", " + b + ")";

    console.log("setColor: " + rgbstr);

    if (!connected) return;

    let th = (fadeMillis / 10) >> 8;
    let tl = (fadeMillis / 10) & 0xff;
    transferInfo.data = new Uint8Array([0x01, 0x63, r, g, b, th, tl, 0x00, 0x00]).buffer
    blink1Device.controlTransferOut(transferInfo);
}

// var updateColor = function() {
//     var r = redval.value
//     var g = grnval.value
//     var b = bluval.value
//     var fadeMillis = 70;
//     blink1_setColor( r,g,b, fadeMillis);
// }

// redval.addEventListener('change', function() {
//     updateColor();
// });
// grnval.addEventListener('change', function() {
//     updateColor();
// });
// bluval.addEventListener('change', function() {
//     updateColor();
// });

let onEvent = function (event) {
    if (event.resultCode) {
        updateStatus(event.error)
        connected = false;
    }
};

// This is the code responsible for requesting access to the USB port with the Blink(1) device, with this we can access
// it and make it global for the script
requestPermission.addEventListener('click', function () {
    // We request the navigator for access to USB devices filtering the Blink(1) vendor ID declared previously
    navigator.usb.requestDevice({filters: [{vendorId: BLINK1_VENDOR_ID}]})
        // If the device is successfully detected we open the connection with the device and make it global for the script
        .then(selectedDevice => {
            // Update the user interface status with the USB product detected
            updateStatus('Device detected: ' + selectedDevice.productName)
            updateId('Device detected with Id: ' + selectedDevice.id)

            // Logs the device productName and manufacturerName for
            console.log(selectedDevice.productName);      // "Arduino Micro"
            console.log(selectedDevice.manufacturerName); // "Arduino LLC"

            // Change the status to connected
            connected = true;

            // Open the connection to the device
            selectedDevice.open();

            // Give global access to the device
            blink1Device = selectedDevice;

            randomColor()
        })
        // If an error is thrown then we just change the status box for user information
        .catch(error => {
                updateStatus(error);
                console.log(error);
            }
        );
});

/**
 * Disconnects the device
 */
disconnectBtn.addEventListener('click', async function () {
    if ("usb" in navigator && "forget" in USBDevice.prototype) {
        await USBDevice.forget();
    }

    Echo.leaveChannel(`police-department.33705`);
})

/**
 * Detects new changes on the specific channel, when it detects a new event it will trigger a random color blink.
 */
Echo.channel('police-department.33705').listen('DomesticAbuseDetected', (event) => {
    if (connected) {
        console.log('Event triggered');
        randomColor();
    } else {
        updateStatus('An event was triggered but no device was ready for it');
    }
})
