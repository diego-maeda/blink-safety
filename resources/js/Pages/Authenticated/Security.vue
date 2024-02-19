<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const password = useForm({
    current_password: '',
    new_password: '',
    new_password_confirmation: '',
});

const dialog = useForm({
    isActive: false,
    title: '',
    message: '',
})

const changePassword = () => {
    password.post(route('password.change'), {
        preserveScroll: true,
        onSuccess: () => {
            password.reset();
            dialog.isActive = true;
            dialog.title = 'You are much safer now!';
            dialog.message = 'Congratulations on strengthening your password! Taking the step to create a more secure password helps protect your valuable information. You\'ve made a wise decision for your digital safety.';
        },
        onError: (message, status) => {
            if (status !== 422) {
                dialog.isActive = true;
                dialog.title = 'Something went wrong';
                dialog.message = ' We\'re sorry, but we encountered an unexpected error while processing your request. Our team is working hard to fix the issue as soon as possible. Please try again later.'
            }
        }
    });
};

const forgot = useForm({
    email: '',
});

const forgotPassword = () => {
    forgot.post(route('password.email'), {
        preserveScroll: true,
        onSuccess: () => {
            forgot.reset('email');
            dialog.isActive = true;
            dialog.title = "Reset your password email sent!";
            dialog.message = "We received a request to reset your password. To continue, please check your email for a verification link. Click on the link to set a new password for your account.";
        },
        onError: (message, status) => {
            if (status === 422) {
                dialog.isActive = true;
                dialog.title = 'Something went wrong';
                dialog.message = ' We\'re sorry, but we encountered an unexpected error while processing your request. Our team is working hard to fix the issue as soon as possible. Please try again later.'
            }
        }
    });
}

</script>

<template>
    <Head title="Security"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Security</h2>
        </template>

        <div class="w-full mx-auto sm:px-6 py-12">
            <div class="rounded-lg border border-stroke bg-white px-7.5 py-6 shadow-default">
                <div class="space-y-12 px-15">
                    <form @submit.prevent="changePassword" class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">Password</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600 text-justify sm:text-left">Ready, set, secure!
                            Accept the challenge and update your passwords to impenetrable fortresses. Remember, the
                            more we learn and share, the safer we all become!</p>
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="current_password"
                                       class="block text-sm font-medium leading-6 text-gray-900">Current password
                                    <small>[required]</small></label>
                                <div class="mt-2">
                                    <input type="password" name="current_password" id="current_password"
                                           v-model="password.current_password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="password.errors.current_password">{{ password.errors.current_password }}</span>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="new_password"
                                       class="block text-sm font-medium leading-6 text-gray-900">New Password <small>[required]</small></label>
                                <div class="mt-2">
                                    <input type="password" name="new_password" id="new_password"
                                           v-model="password.new_password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="password.errors.new_password">{{ password.errors.new_password }}</span>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="new_password_confirmation"
                                       class="block text-sm font-medium leading-6 text-gray-900">New Password
                                    Confirmation <small>[required]</small></label>
                                <div class="mt-2">
                                    <input type="password" name="new_password_confirmation"
                                           id="new_password_confirmation"
                                           v-model="password.new_password_confirmation"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="password.errors.new_password_confirmation">{{ password.errors.new_password_confirmation }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Update password
                            </button>
                        </div>
                    </form>

                    <form @submit.prevent="forgotPassword" class="pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Forgot your current password?</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600 text-justify sm:text-left">Oops, password memory
                            lapse? No worries! We've all been there. Click "Send me a reset email" and we'll guide you
                            through a quick reset process.</p>

                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="email"
                                       class="block text-sm font-medium leading-6 text-gray-900">Email
                                    <small>[required]</small></label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" v-model="forgot.email" autocomplete="email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="forgot.errors.email">{{ forgot.errors.email }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                Send me a reset email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <v-dialog width="500" v-model="dialog.isActive">
            <v-card class="rounded-lg">
                <div class="flex px-6 pb-4 pt-5">
                    <div class="mr-4">
                        <div class="h-12 w-12 rounded-full bg-green-50 flex justify-center items-center">
                            <v-icon color="green">mdi-check</v-icon>
                        </div>
                    </div>
                    <div>
                        <p class="font-sans font-semibold text-gray-900 leading-6 tracking-tight text-base">
                            {{ dialog.title }}</p>
                        <p class="font-sans font-normal text-gray-500 tracking-normal text-sm mt-2">{{
                                dialog.message
                            }}</p>

                    </div>
                </div>

                <v-card-actions class="bg-gray-100 px-6 py-3">
                    <v-spacer></v-spacer>

                    <v-btn
                        variant="plain"
                        class="border border-gray-200 bg-white "
                        @click="dialog.isActive = false"
                    >
                        <span class="font-sans text-capitalize font-semibold tracking-tight text-gray-900">Close</span>
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </AuthenticatedLayout>
</template>
