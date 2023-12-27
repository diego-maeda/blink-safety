# Blink-safety
# todo add blink safety logo
___
## Summary
* [Meet Blink-Safety](#purpleheart-meet-blink-safety)
* [Project Status](#whitecheckmark-project-status)
* [Blink-safety Background](#book-blink-safety-background)
* [Technologies](#computer-technologies)
* [Project Walkthrough](#hammer-project-walkthrough)
* [Covered Police Departments](#oncomingpolicecar-covered-police-departments)
* [How to install](#hammerandwrench-how-to-install-the-project)
* [Roadmap](#construction-roadmap)

___

### :purple_heart: Meet Blink-Safety
Blink-Safety is an open-source initiative empowering communities to break the silence on domestic violence. Through educational resources, survivor support platforms, and creative advocacy campaigns, Blink-Safety aims to educate the public, challenge societal norms, and ultimately prevent future abuse. Join us in building a safer world, one blink at a time. Get involved by sharing your story, volunteering your skills, or contributing to the project's codebase.
___

### :white_check_mark: Project Status
Ongoing project
___

### :book: Blink-Safety Background
It all began with Chris Bennett, a successful entrepreneur and the creator of Callyo, who identified a pressing issue in raising awareness for a cause close to his heart. As a dedicated Board Member of CASA (Community Action Stops Abuse), he recognized the need to leverage technology for greater outreach. In his pursuit, he crossed paths with Diego Maeda, a skilled programmer from Brazil, enthusiastic about embarking on this meaningful journey. Together, they envisioned an open-source approach to champion this initiative.
___

### :computer: Technologies
Below, you'll discover the primary technology stack employed to drive the project:

<div>
    <img height="75" loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg" />
    <img height="75" loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" />
    <img height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original-wordmark.svg" />
</div>


Other tech used:

[Pusher](https://pusher.com/)

[Blink1](https://blink1.thingm.com/)
___
### :hammer: Project walkthrough
We utilize the Police Department API to identify instances of Domestic Violence. Upon detection, we store this information in our database and promptly relay it to the broadcast system (Pusher.com). Through this system, every user connected to the platform receives immediate notifications regarding these cases.

### :oncoming_police_car: Covered Police Departments
- Florida State
  - St. Petersburg 

___
### :hammer_and_wrench: How to install the project
Since Blink-Safety is an open-sourced project you can use it according to our license.


___
# :construction: Roadmap



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

