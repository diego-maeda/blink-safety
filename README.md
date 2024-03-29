
<img src="https://blink-safety.com/build/assets/blink-safety-logo-312d4928.svg" width="250"/>

![License Badge](https://img.shields.io/badge/License-MIT-green)
![Laravel Badge](https://img.shields.io/badge/Laravel-10-red)
![Node Badge](https://img.shields.io/badge/Node.js-20-blue)

*Original concept by [Chris Bennett](https://www.linkedin.com/in/chrisbennett1981/). Project development by [Diego Maeda](https://www.linkedin.com/in/diego-maeda-iavarone/).*

Domestic violence is a social issue that will take all of us working together to fix. Due to the stigma surrounding domestic violence, it continues to happen at alarming rates.  We are trying to change that through public education and engagement.

Blink-Safety emerges as a beacon of awareness, a project dedicated to shedding light on this dark reality. Read more about how we built Blink-Safety on my [medium post](https://medium.com/@diegomaeda/blink-safety-illuminating-the-shadows-of-domestic-violence-c87454599383) or visit the [Blink-Safety website](https://blink-safety.com.br) to view the final result.

- Diego

___
## Summary
* [Meet Blink-Safety](#purpleheart-meet-blink-safety)
* [Blog Post](#blog-post)
* [Project Progress](#chartwithupwardstrend-project-progress)
* [Blink-safety Background](#book-blink-safety-background)
* [Technology Stack](#computer-technology-stack)
* [Project Walkthrough](#hammer-project-walkthrough)
* [Covered Police Departments](#oncomingpolicecar-covered-police-departments)
* [How to install the project](#hammerandwrench-how-to-install-the-project)
* [Roadmap](#construction-roadmap)


___

### :purple_heart: Meet Blink-Safety
Blink-Safety is an open-source initiative empowering communities to break the silence on domestic violence. Through educational resources, survivor support platforms, and creative advocacy campaigns, Blink-Safety aims to educate the public, challenge societal norms, and ultimately prevent future abuse. Join us in building a safer world, one blink at a time. Get involved by sharing your story, volunteering your skills, or contributing to the project's codebase.
___

### :newspaper: Blog Post
[Blink-Safety: Illuminating the Shadows of Domestic Violence](https://medium.com/@diegomaeda/blink-safety-illuminating-the-shadows-of-domestic-violence-c87454599383)

---
### :chart_with_upwards_trend: Project Progress
Currently, the project is actively underway, with various tasks being worked on. New features are being developed, and improvements are continually being made to enhance the overall project.

This status indicates that the project is in an active phase, with ongoing development and updates.
___

### :book: Blink-Safety Background
It all began with Chris Bennett, a successful entrepreneur and the creator of Callyo, who identified a pressing issue in raising awareness for a cause close to his heart. As a dedicated Board Member of [CASA (Community Action Stops Abuse)](https://www.casapinellas.org/), he recognized the need to leverage technology for greater outreach. In his pursuit, he crossed paths with Diego Maeda, a skilled programmer from Brazil, enthusiastic about embarking on this meaningful journey. Together, they envisioned an open-source approach to champion this initiative.
___

### :computer: Technology Stack
Here's an overview of the primary technologies driving this project:

<p align="center">
  <img height="75" loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg" alt="Laravel">
  <img height="75" loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" alt="PostgreSQL">
  <img height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original-wordmark.svg" alt="GitHub">
</p>


Additionally, other technologies utilized include:

[Pusher](https://pusher.com/)

[Blink1](https://blink1.thingm.com/)

**Blink1 Browser Compatibility**
<img src="https://github.com/diego-maeda/blink-safety/blob/main/.github/docs/compatibility.png">

This technology stack powers various aspects of the project, facilitating its functionalities and interactions.
___
### :hammer: Project walkthrough
We utilize the Police Department API to identify instances of Domestic Violence. Upon detection, we store this information in our database and promptly relay it to the broadcast system (Pusher.com). Through this system, every user connected to the platform receives immediate notifications regarding these cases.

**Communication explained**
<img src="https://github.com/diego-maeda/blink-safety/blob/main/.github/docs/comms.png">

### :oncoming_police_car: Covered Police Departments
- Florida State
  - St. Petersburg 
  - Orlando

___
### :hammer_and_wrench: How to install the project
Since Blink-Safety is an open-sourced project you can use it according to our license.

To get started using Laravel Sail, follow these steps:

1. **Clone the Project**

   Get the project onto your local machine by cloning it using Git.

    ```bash
    git clone <project_repository_url>
    ```

2. **Install PHP Dependencies**

   Use Composer to install all PHP dependencies required by the project.

    ```bash
    composer install
    ```

3. **Environment Configuration**

   Duplicate the `.env.example` file and rename the duplicate to `.env`. Customize the settings in the `.env` file according to your environment.

4. **Install Frontend Dependencies**

   Utilize either `npm` or `yarn` to install the frontend dependencies specified in the project.

    ```bash
    npm install   # or
    yarn install
    ```

5. **Setting up Real-time Communication (Pusher)**

   If the project uses Pusher for real-time communication, ensure you have set up an account for Pusher or use an available open-sourced alternative. Configure the necessary credentials in your `.env` file.

6. **Launch the Application with Sail**

   Finally, execute the following command to launch the application using Laravel Sail in detached mode:

    ```bash
    sail up -d
    ```

   This command starts the necessary containers and gets your Laravel application up and running.

Now, you should be able to access your Laravel application via your preferred browser at the designated address. Happy coding!

___
# :construction: Roadmap
- Implement all florida PDs
- Implement a Google Maps with a Heat map of the last occurrences

---
