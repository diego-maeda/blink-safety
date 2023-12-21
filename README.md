## Blink-safety

Blink-safety is a project that helps increase awareness to domestic violence.

The problem faced

We need to connect the blink1 dongle with the api services from police departments.

The first PD we could connect was St. Petersburg, FL through a public API.

Since we have to keep pooling the API for the server we need to keep a timeframe to run, for now we are using every 10
minutes.

Sending the code to Github.

Start creating the integration channel for blink1, my approach on this will be using the web api to provide a json signal
everytime an url is called.

Creating a new integration through a webpage to detect the device.
https://developer.chrome.com/docs/capabilities/usb?hl=en

Creating the mechanism to disconnect the device for the user.

Connecting the system to websocket, for now the choice was defined with pusher because its free tier would suffice.

