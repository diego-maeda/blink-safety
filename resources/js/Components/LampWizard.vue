<script setup>
import {useForm} from "@inertiajs/vue3";
import {CheckIcon, ChevronLeftIcon, ChevronRightIcon, LightBulbIcon} from '@heroicons/vue/24/solid';
import axios from 'axios';

let steps = useForm({
    steps: [
        {id: '1', name: 'Collect your access information', href: '#', status: 'current'},
        {id: '2', name: 'Set your access key', href: '#', status: 'upcoming'},
        {id: '3', name: 'Select your lamps', href: '#', status: 'upcoming'},
    ]
})


let step = useForm({
    current_step: 1,
});

let form = useForm({
    access_token: '',
});

function submitAccessToken() {
    axios.post('api/dashboard/access-token', form)
        .then(() => {
            let previous_step = steps.steps.find((element) => element.id === '2');
            previous_step.status = 'complete';
            let current_step = steps.steps.find((element) => element.id === '3');
            current_step.status = 'current';
            step.current_step = 3;
        })
        .catch(error => {
            console.log(error)
        });
}


function goToStep(number) {
    if (number === 1) {
        let previous_step = steps.steps.find((element) => element.id === '1');
        previous_step.status = 'current';
        let current_step = steps.steps.find((element) => element.id === '2');
        current_step.status = 'upcoming';
        step.current_step = 1;
    } else if (number === 2) {
        let previous_step = steps.steps.find((element) => element.id === '1');
        previous_step.status = 'complete';
        let current_step = steps.steps.find((element) => element.id === '2');
        current_step.status = 'current';
        step.current_step = 2;
    } else if (number === 3) {
        //TODO CALL AXIOS BEFORE COMMITING TO THE LAST CHANGE
        let previous_step = steps.steps.find((element) => element.id === '2');
        previous_step.status = 'complete';
        let current_step = steps.steps.find((element) => element.id === '3');
        current_step.status = 'current';
        step.current_step = 3;
    }
}

const people = [
    {name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member'},
    {name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member'},
    {name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member'},
    {name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member'},
    {name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member'},
    {name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member'},
]

function addNewLightBulbs() {
    //TODO ADD SOME CRAZY CODES HERE TO ADD MORE BULBLIGHTS
}

function completeConfiguration() {
    let current_step = steps.steps.find((element) => element.id === '3');
    current_step.status = 'complete';
    this.current_step = 3;
}
</script>

<template>
    <div class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
        <nav aria-label="Progress">
            <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
                <li v-for="(step, stepIdx) in steps.steps" :key="step.name" class="relative md:flex md:flex-1">
                    <a v-if="step.status === 'complete'" :href="step.href" class="group flex w-full items-center">
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span
                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-600 group-hover:bg-purple-800">
              <CheckIcon class="h-6 w-6 text-white" aria-hidden="true"/>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ step.name }}</span>
          </span>
                    </a>
                    <a v-else-if="step.status === 'current'" :href="step.href"
                       class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
          <span
              class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-purple-600">
            <span class="text-purple-600">{{ step.id }}</span>
          </span>
                        <span class="ml-4 text-sm font-medium text-purple-600">{{ step.name }}</span>
                    </a>
                    <a v-else :href="step.href" class="group flex items-center">
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span
                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
              <span class="text-gray-500 group-hover:text-gray-900">{{ step.id }}</span>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ step.name }}</span>
          </span>
                    </a>
                    <template v-if="stepIdx !== steps.steps.length - 1">
                        <!-- Arrow separator for lg screens and up -->
                        <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                            <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                 preserveAspectRatio="none">
                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </template>
                </li>
            </ol>
        </nav>
    </div>
    <div id="steps-container" class="m-7 rounded-lg border border-stroke bg-white px-7 py-6 shadow-default">
        <section id="step-01" aria-labelledby="gather-your-info" v-if="step.current_step === 1">
            <div class="mx-4 my-4 pb-4 border-b border-gray-300">
                <h2 id="gather your info" class="text-xl font-medium text-gray-900">Gather your info</h2>
                <p class="text-base text-gray-600">Are you new here? We created this video to help you setup your
                    account on
                    Lifx.</p>

            </div>
            <div class="mx-4 my-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/eeSCOkIBVyQ?si=kXER6L1RLNlVqqIG"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
            </div>

            <div id="step-footer" class="flex justify-end mx-4">
                <button
                    @click="goToStep(2)"
                    type="button"
                    class="inline-flex items-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                    Next
                    <ChevronRightIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                </button>
            </div>

        </section>

        <section id="step-02" aria-labelledby="setup-access-token" v-if="step.current_step === 2">
            <div class="mx-4 my-4 pb-4 border-b border-gray-300">
                <h2 id="setup-access-token" class="text-lg font-medium text-gray-900">Setup access token</h2>
                <p class="text-base text-gray-600">Are you new here? We created this video to help you setup your
                    account on
                    Lifx.</p>

            </div>
            <div class="mx-4 my-4">
                <label for="access-token" class="block text-sm font-medium text-gray-700">Access Token</label>
                <div class="mt-1">
                    <input type="text" id="access-token" name="access-token" v-model="form.access_token"
                           class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm"/>
                </div>
            </div>

            <div id="step-footer" class="flex justify-between mx-4">
                <button
                    @click="goToStep(1)"
                    type="button"
                    class="inline-flex items-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                    <ChevronLeftIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true"/>
                    Previous
                </button>
                <button
                    @click="submitAccessToken()"
                    type="button"
                    class="inline-flex items-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                    Next
                    <ChevronRightIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                </button>
            </div>
        </section>

        <section id="step-03" aria-labelledby="setup-your-lamps" v-if="step.current_step === 3">
            <div class="mx-4 my-4 sm:flex sm:items-center pb-4 border-b border-gray-300">
                <div class="sm:flex-auto">
                    <h2 id="setup-your-lamps" class="text-lg font-medium text-gray-900">Setup your lamps</h2>
                    <p class="text-base text-gray-600">Are you new here? We created this video to help you setup your
                        account on
                        Lifx.</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <button
                        @click="completeConfiguration"
                        type="button"
                        class="flex rounded-md bg-purple-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                        Add a new lifx
                        <LightBulbIcon class="-mr-0.5 ml-1.5 h-5 w-5" aria-hidden="true"/>
                    </button>
                </div>

            </div>
            <div class="mx-4 my-4">
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                <tr v-for="person in people" :key="person.email" class="even:bg-gray-50">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                        {{ person.name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ person.title }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ person.email }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                            person.role
                                        }}
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                        <a href="#" class="text-purple-600 hover:text-purple-900"
                                        >Edit<span class="sr-only">, {{ person.name }}</span></a
                                        >
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
