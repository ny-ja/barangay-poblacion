<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onMounted } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const errorMessage = ref('');
const acceptedPrivacyPolicy = ref(false);


function submit() {
    form.post(route('feedback.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Thank you for sending feedback!", {
                "type": "success",
                "position": "bottom-right",
                "autoClose": 2000,
                "hideProgressBar": true,
                "transition": "slide",
                "dangerouslyHTMLString": true
            })
            form.reset();
        },
        onError: (errors) => {
            if (errors) {
                errorMessage.value = 'There was an error submitting the form. Please check the fields and try again.';
            }
        },
        onFinish: () => {
            if (!form.hasErrors) {
                errorMessage.value = '';
            }
        },
    });
}
</script>
<template>
    <AppLayout title="Contact us">
        <div class="">
            <section class="text-gray-600 body-font relative">
                <div class="container px-5 py-16 mx-auto flex sm:flex-nowrap flex-wrap">
                    <div
                        class="bg-center bg-no-repeat bg-[url('/images/admin-building.webp')] bg-transparent bg-blend-multiply lg:w-2/3 md:w-1/2 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                        <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                            <div class="lg:w-1/2 px-6">
                                <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                                <p class="mt-1">Poblacion, Valencia City, Bukidnon, Philippines
                                </p>
                            </div>
                            <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                                <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                                <a class="text-teal-500 leading-relaxed">poblacion@gmail.com</a>
                                <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE
                                </h2>
                                <p class="leading-relaxed">888-888-8888</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Feedback</h2>
                        <p class="leading-relaxed mb-5 text-gray-600">We value your feedback to improve our barangay
                            website. Please share your thoughts and suggestions to help us enhance the user experience
                            and provide better services.</p>
                        <form @submit.prevent="submit">
                            <div v-if="errorMessage" class="text-red-500 text-sm">
                                {{ errorMessage }}
                            </div>
                            <div class="relative mb-4">
                                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                <input type="text" v-model="form.name" id="name" name="name"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="relative mb-4">
                                <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                                <input type="email" v-model="form.email" id="email" name="email"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.email }}
                                </div>
                            </div>
                            <div class="relative mb-4">
                                <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                                <textarea v-model="form.message" id="message" name="message"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                <div v-if="form.errors.message" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.message }}
                                </div>
                            </div>
                            <div class="flex flex-row space-x-1">
                                <input type="checkbox" v-model="acceptedPrivacyPolicy" />
                                <p class="text-xs text-justify">
                                    In compliance with RA 10173 (Data Privacy Act of 2012), I hereby
                                    agree to provide information that Barangay Poblacion Valencia City
                                    commits to safeguard with utmost confidentiality and to use it only
                                    for the purpose of providing community updates.
                                </p>
                            </div>
                            <button type="submit" :disabled="!acceptedPrivacyPolicy"
                                class="text-white w-full mt-4 bg-teal-800 border-0 py-2 px-6 focus:outline-none hover:bg-teal-700 rounded text-lg"
                                :class="{ 'opacity-50 cursor-not-allowed': !acceptedPrivacyPolicy }">Submit</button>
                        </form>
                        <p class="text-xs text-gray-500 mt-3">Your feedback helps us stay connected and responsive to
                            the needs of our community. Thank you for taking the time to share your thoughts!</p>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>