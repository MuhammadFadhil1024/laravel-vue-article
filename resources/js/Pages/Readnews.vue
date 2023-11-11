<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
// import { route } from 'ziggy'
const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    readNews: {
        type: Object,
        default: () => ({})
    }
});

console.log(props.readNews);
</script>

<template>
    <Navbar :canLogin="canLogin" :canRegister="canRegister" />

    <Head title="Newsportal" />
    <div class="px-32 mt-8 flex gap-8">
        <div class="w-3/4 border shadow-lg p-4 rounded-xl">
            <h1 class="font-bold text-3xl">
                {{ readNews.title }}
            </h1>
            <div class="flex justify-start mt-5 text-sm text-gray-300 font-semibold">
                <h4>
                    author -
                </h4>
                <h4>
                    Kamis 02 November 2023 12:59 WIB
                </h4>
            </div>
            <img class="rounded-lg mt-2" src="https://picsum.photos/700/300" alt="thumbnile">
            <p class="text-lg pr-12 mt-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis esse minima dolore libero in sunt ullam
                necessitatibus fuga eaque! Quas sit dolorum minima delectus harum odio voluptate amet eligendi cupiditate.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi aperiam consectetur qui? Aut iure placeat
                necessitatibus quia, nostrum porro natus officiis saepe odit eos amet repellat voluptates, laboriosam ipsa
                blanditiis.
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus ut veniam deserunt excepturi consectetur
                explicabo. Distinctio voluptatibus est nisi commodi natus doloremque ullam? Optio fuga dolorem recusandae.
                Harum, quasi iusto.
            </p>
        </div>

        <div class="w-1/4">
            <div class="border shadow-lg p-4 rounded-xl">
                <img class="mx-auto" src="https://picsum.photos/300/300" alt="thumbnile">
                <h1 class="text-center text-base mt-4 mb-4">
                    lorem ipsum ini title lorem ipsum ini title lorem ipsum ini title lorem ipsum ini title
                </h1>
                <div class="border-t-2 mb-3"></div>
                <!-- <Link :href="route('readnews')"
                    class="block py-2 bg-slate-500 rounded mx-auto w-full text-center text-white">
                Read More
                </Link> -->
            </div>
        </div>
    </div>

    <div class="px-32 mt-8">
        <h1 class="text-left font-bold text-2xl uppercase">
            Related news
        </h1>
        <div class="grid grid-cols-2 gap-8 content-center px-10 w-3/4">
            <div class="flex justify-start gap-4 border-b-2 pb-4 mt-4">
                <img src="https://picsum.photos/80/80" alt="thumbnile">
                <h1 class="font-bold text-xl">
                    lorem ipsum ini adalah judul
                </h1>
            </div>
        </div>
    </div>

    <Footer />
</template>