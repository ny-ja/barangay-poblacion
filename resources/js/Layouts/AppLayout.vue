<script setup>
import { ref, onMounted, computed } from "vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import Icon from '@/Components/Icon.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
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
const googleMapsApiKey =  page.props.apiKey;

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
                    <Icon name="megaphone" :classes="'size-6 text-green-500'" />{{ latestNews }}
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
                                <Icon name="phone" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                    class="text-sm text-gray-900 hover:underline">(888)
                                    888-8888</a>
                            </div>
                            <div class="flex flex-row space-x-1 items-center">
                                <Icon name="mobile" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                    class="text-sm text-gray-900 hover:underline">(999)
                                    999-9999</a>
                            </div>
                            <div class="flex flex-row space-x-1 items-center">
                                <Icon name="mail" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                    class="text-sm text-gray-900 hover:underline">
                                    poblacion@gmail.com</a>
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-4 rtl:space-x-reverse">
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="facebook" :classes="'size-6'" :fill="'black'" />
                            </div>
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="instagram" :classes="'size-6'" :fill="'black'" />
                            </div>
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="whatsapp" :classes="'size-6'" :fill="'black'" />
                            </div>
                            <div class="flex flex-row space-x-1 items-center cursor-pointer">
                                <Icon name="youtube" :classes="'size-6'" :fill="'black'" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="bg-teal-800 uppercase">
                <div class="max-w-screen-xl px-4 py-3 mx-auto flex flex-row lg:ml-40">
                    <div class="flex flex-row items-center">
                        <div @click="sidebar = true"
                            class="sm:hidden flex cursor-pointer hover:bg-teal-700 px-1 py-1 rounded-lg border border-teal-600 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="white" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </div>
                        <ul
                            class="sm:flex hidden text-white flex-row mt-0 space-x-1 text-[14px] lg:text-lg tracking-tighter">
                            <li>
                                <Link :href="route('home')"
                                    class="hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Home'
        }">
                                Home</Link>
                            </li>
                            <li>
                                <Link :href="route('about.index')"
                                    class="hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg text-nowrap"
                                    :class="{
            'bg-teal-700':
                $page.component === 'About/Index'
        }">
                                About us</Link>
                            </li>
                            <li>
                                <Link :href="route('news.index')"
                                    class="hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg"
                                    :class="{
            'bg-teal-700':
                $page.component === 'News/Index'
        }">
                                News</Link>
                            </li>
                            <li>
                                <Link :href="route('services.index')"
                                    class="hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Services/Index'
        }">
                                Services</Link>
                            </li>
                            <li>
                                <Link :href="route('resources.index')"
                                    class="hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Resources/Index'
        }">
                                Resources</Link>
                            </li>
                            <li class="relative group">
                                <a class="text-white cursor-pointer hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Agriculture/Index' || $page.component === 'DRRM/Index' || $page.component === 'Education/Index' || $page.component === 'HealthAndNutrition/Index' || $page.component === 'PeaceAndOrder/Index'
        }">Committees</a>
                                <ul
                                    class="absolute mt-1 drop-shadow-lg text-white z-50 left-0 rounded-lg border border-teal-600 shadow-lg lg:w-72 w-42 text-[14px] lg:text-lg bg-teal-800 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300">
                                    <Link :href="route('committee.agriculture.index')">
                                    <li class="px-4 py-2 hover:bg-teal-700" :class="{
            'bg-teal-700':
                $page.component === 'Agriculture/Index'
        }">
                                        Agriculture
                                    </li>
                                    </Link>
                                    <Link :href="route('committee.drrm.index')">
                                    <li class="px-4 py-2 hover:bg-teal-700" :class="{
            'bg-teal-700':
                $page.component === 'DRRM/Index'
        }">
                                        Disaster Risk Reduction Management
                                    </li>
                                    </Link>
                                    <Link :href="route('committee.education.index')">
                                    <li class="px-4 py-2 hover:bg-teal-700" :class="{
            'bg-teal-700':
                $page.component === 'Education/Index'
        }">
                                        Education
                                    </li>
                                    </Link>
                                    <Link :href="route('committee.health.index')">
                                    <li class="px-4 py-2 hover:bg-teal-700" :class="{
            'bg-teal-700':
                $page.component === 'HealthAndNutrition/Index'
        }">
                                        Health And Nutrition
                                    </li>
                                    </Link>
                                    <Link :href="route('committee.peace.index')">
                                    <li class="px-4 py-2 hover:bg-teal-700" :class="{
            'bg-teal-700':
                $page.component === 'PeaceAndOrder/Index'
        }">
                                        Peace And Order
                                    </li>
                                    </Link>
                                </ul>
                            </li>
                            <li>
                                <Link :href="route('contact.index')"
                                    class="hover:bg-teal-700 px-3 py-2 rounded-lg border border-teal-600 shadow-lg text-nowrap"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Contact/Index'
        }">
                                Contact us</Link>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <Transition name="sidebar">
            <div v-if="sidebar"
                class="fixed sm:hidden border border-teal-700 top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto bg-teal-800">
                <div class="flex justify-between">
                    <img src="/images/logo.png" class="w-12 h-auto -mt-2" alt="Barangay Logo" />

                    <button @click="sidebar = false" type="button"
                        class="text-white bg-transparent hover:bg-teal-700 rounded-lg border border-teal-600 shadow-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center">
                        <svg aria-hidden="true" class="w-6 h-auto" fill="white" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>
                </div>

                <div class="py-4 overflow-y-auto">
                    <ul class="space-y-2 font-medium uppercase tracking-tighter">
                        <li>
                            <Link :href="route('home')"
                                class="flex gap-x-1 items-center p-2 rounded-lg border border-teal-600 shadow-lg text-white hover:bg-teal-700 group"
                                :class="{
            'bg-teal-700':
                $page.component === 'Home'
        }">
                            <Icon name="home" />Home</Link>
                        </li>
                        <li>
                            <Link :href="route('about.index')"
                                class="flex gap-x-1 items-center p-2 rounded-lg border border-teal-600 shadow-lg text-white hover:bg-teal-700 group"
                                :class="{
            'bg-teal-700':
                $page.component === 'About/Index'
        }">
                            <Icon name="group" />About us</Link>
                        </li>
                        <li>
                            <Link :href="route('news.index')"
                                class="flex gap-x-1 items-center p-2 rounded-lg border border-teal-600 shadow-lg text-white hover:bg-teal-700 group"
                                :class="{
            'bg-teal-700':
                $page.component === 'News/Index'
        }">
                            <Icon name="newspaper" />News</Link>
                        </li>
                        <li>
                            <Link :href="route('services.index')"
                                class="flex gap-x-1 items-center p-2 rounded-lg border border-teal-600 shadow-lg text-white hover:bg-teal-700 group"
                                :class="{
            'bg-teal-700':
                $page.component === 'Services/Index'
        }">
                            <Icon name="services" />Services</Link>
                        </li>
                        <li>
                            <Link :href="route('resources.index')"
                                class="flex gap-x-1 items-center p-2 rounded-lg border border-teal-600 shadow-lg text-white hover:bg-teal-700 group"
                                :class="{
            'bg-teal-700':
                $page.component === 'Resources/Index'
        }">
                            <Icon name="folder" />Resources</Link>
                        </li>
                        <li>
                            <button type="button" @click="toggleDropdown"
                                class="flex items-center  gap-x-1 w-full p-2 text-base text-white transition duration-75 rounded-lg border border-teal-600 shadow-lg group hover:bg-teal-700"
                                :class="{
            'bg-teal-700':
                $page.component === 'Agriculture/Index' || $page.component === 'DRRM/Index' || $page.component === 'Education/Index' || $page.component === 'HealthAndNutrition/Index' || $page.component === 'PeaceAndOrder/Index'
        }">
                                <Icon name="user" />
                                <span
                                    class="flex-auto text-left rtl:text-right whitespace-nowrap uppercase">Committees</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul :class="isDropdownOpen ? 'py-2 space-y-2' : 'hidden py-2 space-y-2'">
                                <Link :href="route('committee.agriculture.index')">
                                <li class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-teal-700"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Agriculture/Index'
        }">
                                    Agriculture
                                </li>
                                </Link>
                                <Link :href="route('committee.drrm.index')">
                                <li class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-teal-700"
                                    :class="{
            'bg-teal-700':
                $page.component === 'DRRM/Index'
        }">
                                    Disaster Risk Reduction Management
                                </li>
                                </Link>
                                <Link :href="route('committee.education.index')">
                                <li class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-teal-700"
                                    :class="{
            'bg-teal-700':
                $page.component === 'Education/Index'
        }">
                                    Education
                                </li>
                                </Link>
                                <Link :href="route('committee.health.index')">
                                <li class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-teal-700"
                                    :class="{
            'bg-teal-700':
                $page.component === 'HealthAndNutrition/Index'
        }">
                                    Health And Nutrition
                                </li>
                                </Link>
                                <Link :href="route('committee.peace.index')">
                                <li class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-teal-700"
                                    :class="{
            'bg-teal-700':
                $page.component === 'PeaceAndOrder/Index'
        }">
                                    Peace And Order
                                </li>
                                </Link>
                            </ul>
                        </li>
                        <li>
                            <Link :href="route('contact.index')"
                                class="flex gap-x-1 items-center p-2 rounded-lg border border-teal-600 shadow-lg text-white hover:bg-teal-700 group"
                                :class="{
            'bg-teal-700':
                $page.component === 'Contact/Index'
        }">
                            <Icon name="contact" />Contact us</Link>
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
                                    <Icon name="phone" :classes="'size-4'" :fill="'#115e59'" />
                                    <a class="text-black hover:text-gray-800">8-888-8888 / 0912-345-6789</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <a class="text-lg">Office of the Barangay Captain</a>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="phone" :classes="'size-4'" :fill="'#115e59'" />
                                    <a class="text-black hover:text-gray-800">9-999-9999</a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="mail" :classes="'size-4'" :fill="'#115e59'" />
                                    <a class="text-black hover:text-gray-800">poblacion@gmail.com</a>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-row gap-x-1 items-center">
                                    <Icon name="location" :classes="'size-4'" :fill="'#115e59'" />
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
                                <Icon name="facebook" :classes="'size-12'" :fill="'black'" />
                            </div>
                            <div class="cursor-pointer">
                                <Icon name="instagram" :classes="'size-12'" :fill="'black'" />
                            </div>
                            <div class="cursor-pointer">
                                <Icon name="whatsapp" :classes="'size-12'" :fill="'black'" />
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
