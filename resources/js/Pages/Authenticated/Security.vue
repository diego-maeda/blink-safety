<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

//Locale imports
import {useI18n} from "vue-i18n";

const {t} = useI18n();

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
            dialog.title = t('security.change_password.modal_success_change_password_title');
            dialog.message = t('security.change_password.modal_success_change_password_subtitle');
        },
        onError: (message, status) => {
            if (status != 422) {
                dialog.isActive = true;
                dialog.title = t('security.change_password.modal_error_change_password_title');
                dialog.message = t('security.change_password.modal_error_change_password_subtitle');
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
            dialog.title = t('security.forgot_password.modal_success_forgot_password_title');
            dialog.message =  t('security.forgot_password.modal_success_forgot_password_subtitle');
        },
        onError: (message, status) => {
            if (status == 422) {
                dialog.isActive = true;
                dialog.title = t('security.forgot_password.modal_error_change_password_title');
                dialog.message = t('security.forgot_password.modal_error_change_password_subtitle');
            }
        }
    });
}

</script>

<template>
    <Head :title="$t('security.page_title')"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $t('security.page_title') }}</h2>
        </template>

        <div class="w-full mx-auto sm:px-6 py-12">
            <div class="rounded-lg border border-stroke bg-white px-7.5 py-6 shadow-default">
                <div class="space-y-12 px-15">
                    <form @submit.prevent="changePassword" class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900 mt-10">{{ $t('security.change_password.password_title') }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600 text-justify sm:text-left">{{ $t('security.change_password.password_subtitle') }}</p>
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="current_password"
                                       class="block text-sm font-medium leading-6 text-gray-900">{{ $t('security.change_password.form_current_password_label') }}
                                    <small>[{{ $t('security.change_password.form_required_label') }}]</small></label>
                                <div class="mt-2">
                                    <input type="password" name="current_password" id="current_password"
                                           v-model="password.current_password"
                                           autocomplete="current-password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="password.errors.current_password">{{ password.errors.current_password }}</span>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="new_password"
                                       class="block text-sm font-medium leading-6 text-gray-900">{{ $t('security.change_password.form_new_password_label') }} <small>[{{ $t('security.change_password.form_required_label') }}]</small></label>
                                <div class="mt-2">
                                    <input type="password" name="new_password" id="new_password"
                                           v-model="password.new_password"
                                           autocomplete="new-password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="password.errors.new_password">{{ password.errors.new_password }}</span>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="new_password_confirmation"
                                       class="block text-sm font-medium leading-6 text-gray-900">{{ $t('security.change_password.form_new_password_confirmation_label') }} <small>[{{ $t('security.change_password.form_required_label') }}]</small></label>
                                <div class="mt-2">
                                    <input type="password" name="new_password_confirmation"
                                           id="new_password_confirmation"
                                           v-model="password.new_password_confirmation"
                                           autocomplete="new-password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="password.errors.new_password_confirmation">{{ password.errors.new_password_confirmation }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $t('security.change_password.cancel_button') }}
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                {{ $t('security.change_password.update_password_button') }}
                            </button>
                        </div>
                    </form>

                    <form @submit.prevent="forgotPassword" class="pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">{{ $t('security.forgot_password.forgot_password_title') }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600 text-justify sm:text-left">{{ $t('security.forgot_password.forgot_password_subtitle') }}</p>

                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="email"
                                       class="block text-sm font-medium leading-6 text-gray-900">{{ $t('security.forgot_password.form_email_label') }}
                                    <small>[{{ $t('security.forgot_password.form_required_label') }}]</small></label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" v-model="forgot.email" autocomplete="email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-600 sm:text-sm sm:leading-6">
                                    <span class="mt-1 text-sm font-weight-light text-red-500" v-if="forgot.errors.email">{{ forgot.errors.email }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('dashboard')" class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $t('security.forgot_password.cancel_button') }}
                            </Link>
                            <button type="submit"
                                    class="rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">
                                {{ $t('security.forgot_password.send_me_a_reset_email_button') }}
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
