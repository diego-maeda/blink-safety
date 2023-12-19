var BLINK1_VENDOR_ID = 10168;
var BLINK1_PRODUCT_ID = 493;
var DEVICE_INFO = {"vendorId": BLINK1_VENDOR_ID, "productId": BLINK1_PRODUCT_ID};

var blink1Device;
var usb = chrome.usb;

var connected = false;

// this is what a HID Set Feature requests looks like in chrome.usb
var transferInfo = {
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
let updateId = function(id) {
    blink1Id.innerText = id;
}
// This function is responsible for updating the support text for the user interface
let updateStatus = function (statusStr) {
    blink1Status.innerText = statusStr;
};

var randomColor = function() {
    if( !connected ) return;

    var r = Math.floor((Math.random() * 255));
    var g = Math.floor((Math.random() * 255));
    var b = Math.floor((Math.random() * 255));

    redval.value = r;
    grnval.value = g;
    bluval.value = b;

    console.log("randomColor: "+ r+","+g+","+b);

    blink1_setColor(r,g,b, 100);

    setTimeout( randomColor, 1000);
}

var blink1_setColor = function(r,g,b, fadeMillis) {
    var rgbstr = "rgb(" +r+", "+g+", "+b+")";
    console.log("setColor: "+ rgbstr);
    colorswatch.style.backgroundColor = rgbstr;
    if( !connected ) return;
    var th = (fadeMillis/10) >> 8;
    var tl = (fadeMillis/10) & 0xff;
    transferInfo.data = new Uint8Array([0x01,0x63, r,g,b, th,tl, 0x00,0x00]).buffer
    usb.controlTransfer(blink1Device, transferInfo, onEvent);
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
        return;
    }
};

// This is the code responsible for requesting access to the USB port with the Blink(1) device, with this we can access
// it and make it global for the script
requestPermission.addEventListener('click', function () {
    // We request the navigator for access to USB devices filtering the Blink(1) vendor ID declared previously
    navigator.usb.requestDevice({filters: [{vendorId: BLINK1_VENDOR_ID}]})
        // If the device is successfully detected we open the connection with the device and make it global for the script
        .then(device => {
            // Update the user interface status with the USB product detected
            updateStatus('Device detected: ' + device.productName)
            updateId('Device detected with Id: ' + device.id)

            // Logs the device productName and manufacturerName for
            console.log(device.productName);      // "Arduino Micro"
            console.log(device.manufacturerName); // "Arduino LLC"

            // Change the status to connected
            connected = true;

            // Give global access to the device
            blink1Device = device;

            randomColor()
        })
        // If an error is thrown then we just change the status box for user information
        .catch(error => {
                updateStatus(error);
            }
        );
});
