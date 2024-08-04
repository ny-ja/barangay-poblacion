<script setup>
import { onMounted } from 'vue';
import { Link, Head } from "@inertiajs/vue3";
import { gsap } from 'gsap';

onMounted(() => {
    gsap.fromTo(
        ".loading-page",
        { opacity: 1 },
        {
            opacity: 0,
            display: "none",
            duration: 1.5,
            delay: 3.5,
        }
    );

    gsap.fromTo(
        ".logo-name",
        {
            y: 50,
            opacity: 0,
        },
        {
            y: 0,
            opacity: 1,
            duration: 2,
            delay: 0.5,
        }
    );

    // Add logo animation
    gsap.fromTo(
        ".logo",
        {
            scale: 0.5,
            opacity: 0,
            rotation: -180,
        },
        {
            scale: 1,
            opacity: 1,
            rotation: 0,
            duration: 2,
            delay: 1,
        }
    );
});
</script>

<template>

    <Head title="Welcome" />

    <div class="container">
        <div
            class="bg-center bg-no-repeat bg-[url('/images/admin-building.webp')] absolute w-[100vw] h-[100vh] top-0 left-0 bg-teal-800 bg-blend-multiply flex flex-col items-center justify-center">
            <h1 class="text-white text-center text-4xl mb-4 animate-fade-in-down">Welcome to Barangay Poblacion!</h1>
            <Link :href="route('home')" class="animate-fade-in-up">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            </Link>
        </div>

        <div class="loading-page">
            <img src="/images/outline-logo.svg" class="logo w-40 h-auto" alt="Barangay Logo" />
            <div class="name-container">
                <div class="logo-name">Barangay Poblacion</div>
            </div>
        </div>
    </div>
</template>

<style>
@import url("https://fonts.googleapis.com/css2?family=Michroma&display=swap");

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.container {
    font-family: "Michroma", sans-serif;
    height: 100vh;
}

.loading-page {
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(to right, #059669, #047857, #065f46);
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    align-items: center;
    justify-content: center;
    color: #064e3b;
}

.name-container {
    height: 30px;
    overflow: hidden;
}

.logo-name {
    color: #fff;
    font-size: 20px;
    letter-spacing: 12px;
    text-transform: uppercase;
    margin-left: 20px;
    font-weight: bolder;
}

@media (max-width: 768px) {
    .logo-name {
        font-size: 16px;
        letter-spacing: 8px;
        margin-left: 10px;
    }
}

@media (max-width: 480px) {
    .logo-name {
        font-size: 12px;
        letter-spacing: 5px;
        margin-left: 5px;
    }
}
</style>
