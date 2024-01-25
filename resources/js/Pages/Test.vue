<script setup>

let data = getBrowserName();

let is_hid_available = detectHID();

function detectHID() {
    return !!navigator.hid;
}

function getBrowserName() {
    let browserInfo = navigator.userAgent;
    let browser;
    if (browserInfo.includes('Opera') || browserInfo.includes('Opr')) {
        browser = 'Opera';
    } else if (browserInfo.includes('Edg')) {
        browser = 'Edge';
    } else if (browserInfo.includes('Chrome')) {
        browser = 'Chrome';
    } else if (browserInfo.includes('Safari')) {
        browser = 'Safari';
    } else if (browserInfo.includes('Firefox')) {
        browser = 'Firefox'
    } else {
        browser = navigator.userAgent;
    }
    return browser;
}

</script>

<template>
    <div>
        {{ data }} - {{is_hid_available}}
    </div>
</template>
