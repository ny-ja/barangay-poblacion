<script setup>
import { ref, onMounted, computed } from "vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import Icon from '@/Components/Icon.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import DropdownNavLink from '@/Components/DropdownNavLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DropdownButton from "@/Components/DropdownButton.vue";
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';

defineProps({
    title: String,
});

const form = useForm({
    name: '',
    email: '',
});

const page = usePage();

const scrollDirection = ref('down');
const prevScrollPos = ref(window.pageYOffset);
const sidebar = ref(false);
const isDropdownOpen = ref(false);
const errorMessage = ref('');
const acceptedPrivacyPolicy = ref(false);

const latestNews = computed(() => page.props.latestNews);
const googleMapsApiKey = page.props.apiKey;

function submit() {
    form.post(route('subscribers.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast("You are now part of our community!", {
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

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

onMounted(() => {
    const handleScroll = () => {
        const currentScrollPos = window.pageYOffset;
        if (prevScrollPos.value > currentScrollPos) {
            scrollDirection.value = 'up';
        } else {
            scrollDirection.value = 'down';
        }
        prevScrollPos.value = currentScrollPos;
    };

    window.addEventListener('scroll', handleScroll);

    return () => {
        window.removeEventListener('scroll', handleScroll);
    };
});

// Google Maps initialization
onMounted(() => {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${googleMapsApiKey}&libraries=places&callback=initMap&loading=async`;
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
        <div :class="scrollDirection === 'up' ? 'sticky top-0 z-40' : ''">
            <div class="runner-container z-40">
                <p v-if="latestNews" class="runner flex text-teal-800 text-md">
                    {{ latestNews }}
                </p>
            </div>
            <div class="bg-white border-gray-200">
                <div class="flex flex-row flex-wrap w-full lg:justify-between justify-center p-4">
                    <div class="flex lg:flex-row flex-col gap-x-6 items-center lg:items-baseline">
                        <Link :href="route('home')" class="lg:absolute space-x-3 rtl:space-x-reverse">
                        <ApplicationLogo class="w-24 lg:w-36 h-auto" />
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
                                <Icon name="phone" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                    stroke_width="1" /><a href="#" class="text-sm text-gray-900 hover:underline">(888)
                                    888-8888</a>
                            </div>
                            <div class="flex flex-row space-x-1 items-center">
                                <Icon name="mobile" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                    stroke_width="1" /><a href="#" class="text-sm text-gray-900 hover:underline">(999)
                                    999-9999</a>
                            </div>
                            <div class="flex flex-row space-x-1 items-center">
                                <Icon name="mail" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                    stroke_width="1" /><a href="#" class="text-sm text-gray-900 hover:underline">
                                    poblacion@gmail.com</a>
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-4 rtl:space-x-reverse">
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="facebook" :classes="'size-6'" fill="black'" stroke="transpaent'" />
                            </div>
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="instagram" :classes="'size-6'" fill="black'" stroke="transpaent'" />
                            </div>
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="whatsapp" :classes="'size-6'" fill="black'" stroke="transpaent'" />
                            </div>
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="youtube" :classes="'size-6'" fill="black'" stroke="transpaent'" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="bg-teal-800 shadow-2xl">
                <div class="max-w-screen-xl mx-auto flex flex-row lg:ml-44">
                    <div class="flex flex-row items-center">
                        <div @click="sidebar = true"
                            class="sm:hidden flex cursor-pointer hover:bg-teal-700 mx-3 my-2 rounded-md border border-teal-600 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="white" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </div>
                        <div
                            class="sm:flex hidden text-white items-center flex-row space-x-2 text-[14px] lg:text-lg tracking-wider lg:h-14 h-12 justify-between">
                            <NavLink :href="route('home')" :active="route().current('home')" class="px-2 py-1">
                                Home</NavLink>
                            <NavLink :href="route('about.index')" :active="route().current('about.index')"
                                class="px-2 py-1">
                                About us</NavLink>
                            <NavLink :href="route('news.index')" :active="route().current('news.index')"
                                class="px-2 py-1">
                                News</NavLink>
                            <NavLink :href="route('services.index')" :active="route().current('services.index')"
                                class="px-2 py-1">
                                Services</NavLink>
                            <NavLink :href="route('resources.index')" :active="route().current('resources.index')"
                                class="px-2 py-1">
                                Resources</NavLink>
                            <NavLink :href="route('contact.index')" :active="route().current('contact.index')"
                                class="px-2 py-1">
                                Contact us</NavLink>
                            <div class="relative group h-full">
                                <Link
                                    class="inline-flex items-center h-full text-md font-medium px-1 leading-5 border-b-2 hover:text-teal-500 hover:border-teal-500 hover:bg-teal-100 focus:outline-none focus:text-white focus:border-teal-500 transition duration-150 ease-in-out"
                                    :class="[

            $page.component === 'Agriculture/Index' || $page.component === 'DRRM/Index' || $page.component === 'Education/Index' || $page.component === 'HealthAndNutrition/Index' || $page.component === 'PeaceAndOrder/Index' ? 'border-teal-500 bg-teal-100 text-teal-500' : 'border-transparent text-white'
        ]">Committees</Link>
                                <div
                                    class="absolute flex flex-col drop-shadow-lg text-white z-50 left-0 border border-white shadow-2xl lg:w-72 w-42 text-[14px] lg:text-lg bg-teal-800 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300">
                                    <DropdownNavLink :href="route('committee.agriculture.index')"
                                        :active="route().current('committee.agriculture.index')">
                                        Agriculture
                                    </DropdownNavLink>
                                    <DropdownNavLink :href="route('committee.drrm.index')"
                                        :active="route().current('committee.drrm.index')">
                                        Disaster Risk Reduction Management
                                    </DropdownNavLink>
                                    <DropdownNavLink :href="route('committee.education.index')"
                                        :active="route().current('committee.education.index')">
                                        Education
                                    </DropdownNavLink>
                                    <DropdownNavLink :href="route('committee.health.index')"
                                        :active="route().current('committee.health.index')">
                                        Health And Nutrition
                                    </DropdownNavLink>
                                    <DropdownNavLink :href="route('committee.peace.index')"
                                        :active="route().current('committee.peace.index')">
                                        Peace And Order
                                    </DropdownNavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <Transition name="sidebar">
            <div v-if="sidebar"
                class="fixed sm:hidden border border-teal-700 top-0 left-0 z-40 w-64 h-screen p-2 overflow-y-auto bg-teal-800">
                <div class="flex items-center justify-between flex-shrink-0">
                    <span
                        class="flex items-center flex-nowrap space-x-2 text-xl leading-8 tracking-wider uppercase whitespace-nowrap">
                        <img src="/images/poblacion-logo.svg" class="w-12 h-auto" alt="Barangay Logo" />
                        <span class="antialiased tracking-wider font-black leading-none text-white">Brgy.<br />
                            Poblacion</span>
                    </span>
                    <button @click="sidebar = false" class="p-2 rounded-md lg:hidden">
                        <Icon name="close" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </button>
                </div>

                <div class="py-4 overflow-y-auto">
                    <ul class="space-y-1 font-medium tracking-wider text-white">
                        <li>
                            <ResponsiveNavLink :href="route('home')" :active="route().current('home')"
                                class="gap-x-1 p-2 border-none shadow-none">
                                <Icon name="home" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                Home
                            </ResponsiveNavLink>
                        </li>
                        <li>
                            <ResponsiveNavLink :href="route('about.index')" :active="route().current('about.index')"
                                class="gap-x-1 p-2 border-none shadow-none">
                                <Icon name="users" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                About us
                            </ResponsiveNavLink>
                        </li>
                        <li>
                            <ResponsiveNavLink :href="route('news.index')" :active="route().current('news.index')"
                                class="gap-x-1 p-2 border-none shadow-none">
                                <Icon name="newspaper" :classes="'size-6'" stroke="white" fill="none"
                                    stroke_width="1.5" />
                                News
                            </ResponsiveNavLink>
                        </li>
                        <li>
                            <ResponsiveNavLink :href="route('services.index')"
                                :active="route().current('services.index')" class="gap-x-1 p-2 border-none shadow-none">
                                <Icon name="users" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                Services
                            </ResponsiveNavLink>
                        </li>
                        <li>
                            <ResponsiveNavLink :href="route('resources.index')"
                                :active="route().current('resources.index')"
                                class="gap-x-1 p-2 border-none shadow-none">
                                <Icon name="folder_open" :classes="'size-6'" stroke="white" fill="none"
                                    stroke_width="1.5" />
                                Resources
                            </ResponsiveNavLink>
                        </li>
                        <li>
                            <ResponsiveNavLink :href="route('contact.index')" :active="route().current('contact.index')"
                                class="gap-x-1 p-2 border-none shadow-none">
                                <Icon name="phone" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                Contact us
                            </ResponsiveNavLink>
                        </li>
                        <li>
                            <DropdownButton :isSidebarOpen=true
                                :active="route().current('committee.agriculture.index') || route().current('committee.drrm.index') || route().current('committee.education.index') || route().current('committee.health.index') || route().current('committee.peace.index')">
                                <template #icon>
                                    <Icon name="squares" :classes="'size-6'" stroke="white" fill="none"
                                        stroke_width="1.5" />
                                </template>
                                <template #text>
                                    Committees
                                </template>
                                <template #nav>
                                    <ResponsiveNavLink :href="route('committee.agriculture.index')"
                                        :active="route().current('committee.agriculture.index')"
                                        class="border-none shadow-none p-2">
                                        Agriculture</ResponsiveNavLink>

                                    <ResponsiveNavLink :href="route('committee.drrm.index')"
                                        :active="route().current('committee.drrm.index')"
                                        class="border-none shadow-none p-2">
                                        DRRM</ResponsiveNavLink>

                                    <ResponsiveNavLink :href="route('committee.education.index')"
                                        :active="route().current('committee.education.index')"
                                        class="border-none shadow-none p-2">
                                        Education</ResponsiveNavLink>

                                    <ResponsiveNavLink :href="route('committee.health.index')"
                                        :active="route().current('committee.health.index')"
                                        class="border-none shadow-none p-2">
                                        Health And Nutrition</ResponsiveNavLink>

                                    <ResponsiveNavLink :href="route('committee.peace.index')"
                                        :active="route().current('committee.peace.index')"
                                        class="border-none shadow-none p-2">
                                        Peace And Order</ResponsiveNavLink>
                                </template>
                            </DropdownButton>
                        </li>
                    </ul>
                </div>
            </div>
        </Transition>

        <main>
            <slot />
        </main>

        <footer class="text-black body-font">
            <div class="px-5 py-12 bg-amber-400">
                <div class="flex flex-wrap flex-row md:text-left gap-x-20 text-center justify-center order-first">
                    <div class="lg:w-1/4 md:w-1/2 w-full text-center">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-2xl mb-3">Contact us</h2>
                        <div class="flex flex-col gap-y-2">
                            <div class="flex flex-col items-center">
                                <a class="text-lg">4-Hour Command Center</a>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="phone" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                        stroke_width="1" />
                                    <a class="text-black hover:text-gray-800">8-888-8888 / 0912-345-6789</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <a class="text-lg">Office of the Barangay Captain</a>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="phone" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                        stroke_width="1" />
                                    <a class="text-black hover:text-gray-800">9-999-9999</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="mail" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                        stroke_width="1" />
                                    <a class="text-black hover:text-gray-800">poblacion@gmail.com</a>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="location" :classes="'size-4'" fill="#115e59" stroke="#115e59"
                                        stroke_width="1" />
                                    <a class="text-black hover:text-gray-800">Poblacion, Valencia City, Bukidnon</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <a class="text-black font-semibold text-xl hover:text-gray-800">How to get there:</a>
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
                                <Icon name="facebook" :classes="'size-12'" fill="black'" stroke="transpaent'" />
                            </div>
                            <div class="cursor-pointer">
                                <Icon name="instagram" :classes="'size-12'" fill="black'" stroke="transpaent'" />
                            </div>
                            <div class="cursor-pointer">
                                <Icon name="whatsapp" :classes="'size-12'" fill="black'" stroke="transpaent'" />
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
                        <h2 class="title-font text-center font-medium text-gray-900 tracking-widest text-2xl mb-3">
                            Be part of our community
                        </h2>
                        <div class="bg-white flex flex-col px-4 py-6 rounded-lg shadow-lg">
                            <form @submit.prevent="submit" class="space-y-4">
                                <div v-if="errorMessage" class="text-red-500 text-sm">
                                    {{ errorMessage }}
                                </div>
                                <div class="relative mb-4">
                                    <label for="name" class="leading-7 text-sm text-black">Name</label>
                                    <input type="text" v-model="form.name" id="name" name="name"
                                        class="w-full bg-white rounded border border-gray-300 focus:ring-2 focus:ring-teal-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.name }}
                                    </div>
                                </div>
                                <div class="relative mb-4">
                                    <label for="email" class="leading-7 text-sm text-black">Email</label>
                                    <input type="email" v-model="form.email" id="email" name="email"
                                        class="w-full bg-white rounded border border-gray-300 focus:ring-2 focus:ring-teal-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.email }}
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
                                <div class="flex justify-center">
                                    <button type="submit" :disabled="!acceptedPrivacyPolicy"
                                        class="text-white w-full mt-2 bg-teal-800 border-0 py-2 px-6 focus:outline-none hover:bg-teal-700 rounded text-lg"
                                        :class="{ 'opacity-50 cursor-not-allowed': !acceptedPrivacyPolicy }">
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-teal-800">
                <div class="px-5 py-6 mx-auto flex items-center sm:flex-row flex-col">
                    <a
                        class="flex gap-x-2 title-font font-medium items-center md:justify-start justify-center text-gray-900">
                        <ApplicationLogo class="w-14 h-auto" />
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

<style scoped>
.runner-container {
    overflow: hidden;
    width: 100%;
    height: 50px;
    position: absolute;
}

.runner {
    position: absolute;
    white-space: nowrap;
    animation: move 14s linear infinite;
}

@keyframes move {
    0% {
        left: -100%;
    }

    100% {
        left: 100%;
    }
}

.sidebar-enter-active,
.sidebar-leave-active {
    transition: opacity 0.3s, transform 0.3s;
}

.sidebar-enter-from,
.sidebar-leave-to {
    opacity: 0;
    transform: translateX(-100%);
}

.sidebar-enter-to,
.sidebar-leave-from {
    opacity: 1;
    transform: translateX(0);
}
</style>
