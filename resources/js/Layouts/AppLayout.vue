<script setup>
import { ref, onMounted } from "vue";
import { Head, router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import Icon from '@/Components/Icon.vue';

defineProps({
    title: String,
});

// Google Maps initialization
onMounted(() => {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyCKVvI-0R1P3Bd-5L8JH--PRSTSEDWwHo0&libraries=places&callback=initMap&loading=async`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);

    window.initMap = function () {
        const map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 7.908160, lng: 125.091350 },
            zoom: 16,
        });

        const marker = new google.maps.Marker({
            position: { lat: 7.908160, lng: 125.091350 },
            map: map,
            title: 'Barangay Poblacion',
        });
    };
});
</script>

<template>
    <div>

        <Head :title="title" />

        <div class="bg-white border-gray-200">
            <div class="flex flex-row flex-wrap w-full lg:justify-between justify-center p-4">
                <div class="flex lg:flex-row flex-col gap-x-6 items-center lg:items-baseline">
                    <Link :href="route('home')" class="lg:absolute space-x-3 rtl:space-x-reverse">
                    <img src="/images/barangay-logo.png" class="w-24 lg:w-36 h-auto" alt="Barangay Logo" />
                    </Link>
                    <div class="flex flex-col gap-y-1 lg:ml-40 items-center lg:items-start">
                        <span class="text-2xl text-gray-900 font-semibold whitespace-nowrap">Barangay
                            Poblacion</span>
                        <span class="text-md text-gray-900 font-semibold whitespace-nowrap">City of Valencia,
                            Bukidnon, Philippines</span>
                    </div>
                </div>
                <div class="hidden lg:flex flex-col lg:items-end items-center space-y-2">
                    <div class="flex items-center space-x-6 rtl:space-x-reverse">
                        <div class="flex flex-row space-x-1 items-center">
                            <Icon name="phone" :classes="'text-[#73BBA3] size-4'" /><a href="#"
                                class="text-sm text-gray-900 hover:underline">(888)
                                888-8888</a>
                        </div>
                        <div class="flex flex-row space-x-1 items-center">
                            <Icon name="mobile" :classes="'text-[#73BBA3] size-4'" /><a href="#"
                                class="text-sm text-gray-900 hover:underline">(999)
                                999-9999</a>
                        </div>
                        <div class="flex flex-row space-x-1 items-center">
                            <Icon name="mail" :classes="'text-[#73BBA3] size-4'" /><a href="#"
                                class="text-sm text-gray-900 hover:underline">
                                poblacion@gmail.com</a>
                        </div>
                    </div>
                    <div class="flex items-center justify-end space-x-4 rtl:space-x-reverse">
                        <div class="flex flex-row space-x-1 items-center cursor-pointer">
                            <Icon name="facebook" :classes="'size-6'" />
                        </div>
                        <div class="flex flex-row space-x-1 items-center cursor-pointer">
                            <Icon name="instagram" :classes="'size-6'" />
                        </div>
                        <div class="flex flex-row space-x-1 items-center cursor-pointer">
                            <Icon name="whatsapp" :classes="'size-6'" />
                        </div>
                        <div class="flex flex-row space-x-1 items-center cursor-pointer">
                            <Icon name="youtube" :classes="'size-6'" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <nav class="bg-[#73BBA3]">
            <div class="max-w-screen-xl px-4 py-3 mx-auto flex flex-row lg:ml-40">
                <div class="flex flex-row items-center">
                    <div class="sm:hidden flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>
                    <ul class="sm:flex hidden flex-row font-bold mt-0 space-x-8 rtl:space-x-reverse text-lg">
                        <li>
                            <Link :href="route('home')" :class="{
        'text-[#F6FB7A] underline':
            $page.component === 'Welcome',
    }" class="text-white hover:text-[#F6FB7A] hover:underline">
                            Home</Link>
                        </li>
                        <li>
                            <Link :href="route('about.index')" :class="{
        'text-[#F6FB7A] underline':
            $page.component === 'About/Index',
    }" class="text-white hover:text-[#F6FB7A] hover:underline">
                            About us</Link>
                        </li>
                        <li>
                            <Link :href="route('news.index')" :class="{
        'text-[#F6FB7A] underline':
            $page.component === 'News/Index',
    }" class="text-white hover:text-[#F6FB7A] hover:underline">
                            News</Link>
                        </li>
                        <li>
                            <Link :href="route('services.index')" :class="{
        'text-[#F6FB7A] underline':
            $page.component === 'Services/Index',
    }"
                                class="text-white hover:text-[#F6FB7A] hover:underline">
                            Services</Link>
                        </li>
                        <li>
                            <Link :href="route('contact.index')" :class="{
        'text-[#F6FB7A] underline':
            $page.component === 'Contact/Index',
    }"
                                class="text-white hover:text-[#F6FB7A] hover:underline">
                            Contact us</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <slot />
        </main>

        <footer class="text-gray-600 body-font">
            <div class="px-5 py-12 bg-[#F6FB7A]">
                <div class="flex flex-wrap flex-row md:text-left gap-x-20 text-center justify-center order-first">
                    <div class="lg:w-1/4 md:w-1/2 w-full text-center">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-2xl mb-3">Contact us</h2>
                        <div class="flex flex-col gap-y-2">
                            <div class="flex flex-col items-center">
                                <a class="text-lg">4-Hour Command Center</a>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="phone" :classes="'size-4 text-black'" />
                                    <a class="text-gray-600 hover:text-gray-800">8-888-8888 / 0912-345-6789</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <a class="text-lg">Office of the Barangay Captain</a>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="phone" :classes="'size-4 text-black'" />
                                    <a class="text-gray-600 hover:text-gray-800">9-999-9999</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="mail" :classes="'size-4 text-black'" />
                                    <a class="text-gray-600 hover:text-gray-800">poblacion@gmail.com</a>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="location" :classes="'size-4 text-black'" />
                                    <a class="text-gray-600 hover:text-gray-800">Poblacion, Valencia City, Bukidnon</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <a class="text-gray-600 font-semibold text-xl hover:text-gray-800">How to get there:</a>
                                <div class="mt-2">
                                    <div id="map" style="width: 300px; height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full text-center">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-2xl mb-3">Connect with us
                        </h2>
                        <div class="flex flex-row justify-center space-x-4">
                            <div class="cursor-pointer">
                                <Icon name="facebook" :classes="'text-gray-900 size-12'" />
                            </div>
                            <div class="cursor-pointer">
                                <Icon name="instagram" :classes="'text-gray-900 size-12'" />
                            </div>
                            <div class="cursor-pointer">
                                <Icon name="whatsapp" :classes="'text-gray-900 size-12'" />
                            </div>
                        </div>
                        <div class="mt-6 flex flex-col items-center">
                            <h2 class="title-font font-medium text-gray-900 tracking-widest text-xl">Messenger QR
                                Code
                            </h2>
                            <img src="/images/messenger-qrcode.png" class="w-48 h-auto" alt="Messenger QR Code" />
                        </div>
                    </div>
                    <div class="lg:w-1/4 md:w-1/2 w-full flex flex-col">
                        <h2 class="title-font text-center font-medium text-gray-900 tracking-widest text-2xl mb-3">Be
                            part of our
                            community</h2>
                        <div class="bg-white flex flex-col px-3 py-2 rounded-lg">
                            <div class="relative mb-4">
                                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full bg-white rounded border border-gray-300 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <div class="relative mb-4">
                                <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full bg-white rounded border border-gray-300 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <div class="flex flex-row space-x-1">
                                <input type="checkbox">
                                <p class="text-xs">
                                    In compliance with RA 10173 (Data Privacy Act of 2012), I hereby agree to provide
                                    information that Barangay San Antonio Pasig City commits to safeguard with utmost
                                    confidentiality and to use it only for purpose of providing community updates.</p>
                            </div>
                            <button
                                class="text-white mt-4 bg-[#73BBA3] border-0 py-2 px-6 focus:outline-none hover:bg-[#82c2ac] rounded text-lg">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#73BBA3]">
                <div class="px-5 py-6 mx-auto flex items-center sm:flex-row flex-col">
                    <a
                        class="flex gap-x-2 title-font font-medium items-center md:justify-start justify-center text-gray-900">
                        <img src="/images/barangay-logo.png" class="w-14 h-auto" alt="Barangay Logo" />
                        <div class="flex flex-col gap-y-1 text-sm text-white">
                            <span>Copyright © 2024 Barangay Poblacion Valencia City</span>
                            <span>Developed by Johnny Ermio</span>
                        </div>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>
