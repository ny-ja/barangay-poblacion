<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps(['officials']);
</script>
<template>
    <AppLayout title="About us">
        <div class="">
            <section class="text-gray-600 body-font">
                <div class="mx-auto flex px-5 py-16 items-center justify-center flex-col">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Barangay History</h1>
                    <img class="w-3/4 mb-10 object-cover object-center rounded" alt="Admin building"
                        src="/images/admin-building.webp">
                    <div class="text-center lg:w-3/4 w-full text-lg">
                        <p class="mb-8 leading-relaxed text-justify indent-12">The history of our barangay dates back to
                            the early 1900s, when
                            the first settlers arrived and established the community. The area was initially a dense
                            forest, which was gradually cleared to make way for agriculture and housing. The barangay
                            saw significant development during the mid-20th century, with the construction of key
                            infrastructure such as schools, roads, and community centers.</p>
                        <p class="mb-8 leading-relaxed text-justify indent-12">In the 1970s, the barangay experienced
                            rapid growth due to the
                            influx of people from neighboring provinces seeking better opportunities. This period saw
                            the establishment of local businesses and the enhancement of public services. The barangay
                            hall, pictured above, was built during this time and has since been a central hub for
                            community activities and local governance.</p>
                        <p class="mb-8 leading-relaxed text-justify indent-12">Today, our barangay is a thriving
                            community with a rich cultural
                            heritage. Annual festivals celebrate our history and bring residents together to honor the
                            traditions and values that have shaped our barangay. The continuous efforts of the barangay
                            council and active participation of the residents ensure that our community remains vibrant
                            and prosperous for future generations.</p>
                    </div>
                </div>
            </section>

            <section class="text-gray-600 body-font overflow-hidden bg-gray-100">
                <div class="px-5 py-16 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap items-center">
                        <img alt="barangay" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                            src="/images/mission-vision.webp" />
                        <div class="lg:w-1/2 w-full lg:pl-24 lg:py-6 mt-6 lg:mt-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 border-b">
                                Vision
                            </h1>
                            <p class="leading-relaxed pb-5 text-justify">
                                Our vision is to create a harmonious and progressive Barangay Poblacion where unity and
                                hospitality thrive. We aspire to foster a community that values its culture and
                                traditions while embracing development and growth. Through collaborative efforts, we aim
                                to uplift the quality of life for all our residents and work together towards a
                                brighter, more prosperous future.
                            </p>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 border-b">
                                Mission
                            </h1>
                            <p class="leading-relaxed pb-5 text-justify">
                                Our mission is to serve the residents of Barangay Poblacion by implementing inclusive
                                and sustainable community programs. We are committed to maintaining peace, promoting
                                progress, and enhancing the well-being of every member of our community. By cherishing
                                our heritage and supporting each other, we strive to create a supportive and dynamic
                                environment where everyone can flourish.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="text-gray-600 body-font">
                <div class="mx-auto flex px-5 py-16 items-center justify-center flex-col">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Barangay Officials</h1>
                    <img class="w-3/4 mb-10 object-cover object-center rounded" alt="Barangay Officials"
                        src="/images/officials.webp">
                    <div class="text-center lg:w-3/4 w-full text-lg">
                        <p class="mb-8 leading-relaxed text-justify indent-12">The barangay officials play a pivotal
                            role in
                            the governance and development of our community. Their dedication and hard work have greatly
                            contributed to the well-being and progress of our barangay. From the early days of our
                            community's
                            formation, barangay officials have been at the forefront, ensuring the smooth implementation
                            of
                            local policies and programs.</p>
                        <p class="mb-8 leading-relaxed text-justify indent-12">Our current team of barangay officials
                            continues
                            to build on the legacy of their predecessors. They oversee various aspects of community
                            life,
                            including public safety, health services, and educational initiatives. The barangay hall,
                            pictured
                            above, serves as the administrative center where officials meet to discuss and address the
                            needs of
                            the residents. Their commitment to public service is evident in the continuous improvements
                            seen
                            throughout our barangay.</p>
                    </div>
                </div>
            </section>

            <section class="text-gray-600 body-font">
                <template v-for="official in officials" :key="official.id">
                    <div v-if="official.position === 'Barangay Captain'"
                        class="mx-auto flex px-5 py-16 md:flex-row flex-col items-center bg-teal-800">
                        <div
                            class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col text-white md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                            <h1 class="title-font border-b w-full sm:text-4xl text-3xl mb-4 font-medium">
                                {{ official.full_name }}
                            </h1>
                            <p class="mb-8 text-xl leading-relaxed text-justify">{{ official.profile }}</p>
                        </div>
                        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                            <img class="object-cover object-center rounded" :alt="`Captain ${official.full_name}`"
                                :src="`/storage/${official.photo_path}`">
                        </div>
                    </div>
                </template>
            </section>

            <section class="text-gray-600 body-font">
                <div class="px-5 py-16 mx-auto">
                    <div class="flex flex-col text-center w-full mb-20">
                        <h1 class="text-2xl font-medium title-font mb-4 text-gray-900 tracking-widest">Barangay Kagawad
                        </h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">The Barangay Kagawad, or councilors, play
                            a crucial role in the local governance of our communities. They work tirelessly to address
                            the needs and concerns of the residents, ensuring that the barangay operates smoothly and
                            efficiently. Their dedication and commitment to public service are commendable and essential
                            for the development and well-being of the barangay.</p>
                    </div>
                    <div class="flex flex-wrap -m-4">
                        <template v-for="official in officials" :key="official.id">
                            <div v-if="official.position == 'Barangay Kagawad'" class="p-4 lg:w-1/2">
                                <div
                                    class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                    <img class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                        :src="`/storage/${official.photo_path}`" alt="Official photo">
                                    <div class="flex-grow sm:pl-8">
                                        <h2 class="title-font font-medium text-lg text-gray-900">{{ official.full_name
                                            }}</h2>
                                        <h3 class="text-gray-500 mb-3">{{ official.role }}</h3>
                                        <p class="mb-4">{{ official.profile }}</p>
                                        <span class="inline-flex text-gray-400">
                                            <a class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                                </svg>
                                            </a>
                                            <a class="ml-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <section class="text-gray-600 body-font bg-gray-100">
                <div class="px-5 py-16 mx-auto">
                    <div class="flex flex-col text-center w-full mb-20">
                        <h1 class="text-2xl font-medium title-font mb-4 text-gray-900 tracking-widest">Sangguniang
                            Kabataan</h1>
                    </div>
                    <div class="flex flex-wrap -m-4">
                        <template v-for="official in officials" :key="official.id">
                            <div v-if="official.position == 'SK Kagawad' || official.position == 'SK Chairman/Chairwoman'"
                                class="p-4 lg:w-1/2">
                                <div
                                    class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                    <img class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                        :src="`/storage/${official.photo_path}`" alt="Official photo">
                                    <div class="flex-grow sm:pl-8">
                                        <h2 class="title-font font-medium text-lg text-gray-900">{{ official.full_name
                                            }}</h2>
                                        <h3 class="text-gray-500 mb-3">{{ official.role }}</h3>
                                        <p class="mb-4">{{ official.profile }}</p>
                                        <span class="inline-flex text-gray-400">
                                            <a class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                                </svg>
                                            </a>
                                            <a class="ml-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>