<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'
import CardNews from '@/Components/News/CardNews.vue'
import Footer from '@/Components/Footer.vue'
import CategoryNews from '@/Components/News/CategoryNews.vue';
const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    latest_news: {
        type: Object,
        default: () => ({})
    },
    isHotNews: {
        type: Object,
        default: () => ({})
    },
    categories: {
        type: Object,
        default: () => ({})
    }
});

// console.log(props.categories);
</script>

<script>
export default {

    methods: {
        showImage() {
            return "/thumbnile/"
        },
        firstHotNewsWord(text) {
            let content = this.stripTags(text.content);
            var firtsWord = content.replace(/ .*/, '');
            return firtsWord
        },
        limitHotNewsText(isHotNews) {
            let content = this.stripTags(isHotNews.content);
            let countFirstHotNews = this.firstHotNewsWord(isHotNews).length;
            console.log(countFirstHotNews);
            return content.length > 300 ? content.substring(countFirstHotNews, 300) : content;
        },
        stripTags(text) {
            return text.replace(/(<([^>]+)>)/ig, '');
        },
    },
}
// console.log(firstWord);
</script>

<template>
    <Head title="Newsportal" />

    <Navbar :canLogin="canLogin" :canRegister="canRegister" />
    <div class="px-32">
        <h1 class="font-bold text-left py-4 text-5xl">Hot Topics</h1>

        <div class="flex justify-between gap-8">
            <img class="rounded-lg h-3/4" :width="870" :height="400" :src="showImage() + isHotNews.image_url"
                alt="hottopic">
            <div class="font-normal text-sm leading-8 h-1/4">
                <!-- <span class="text-4xl">Nisi,</span> sagittis aliquet sit rutrum. Nunc, id vestibulum quam ornare adipiscing.
                Pellentesque sed
                turpis nunc
                gravida pharetra, sit nec vivamus pharetra. Velit, dui, egestas nisi, elementum mattis mauris, magnis. Massa
                tortor nibh nulla condimentum imperdiet scelerisque... read more -->
                <span class="text-4xl">{{ firstHotNewsWord(isHotNews) }}</span> {{ limitHotNewsText(isHotNews) }}
                <Link class="text-blue-600" :href="route('readnews', $page.props.isHotNews.slug)">read more...</Link>
            </div>
        </div>

        <div class=" mt-14">
            <div class="font-bold text-4xl">
                Latest News
            </div>
        </div>

        <div class="grid grid-cols-4 gap-7 content-center">
            <CardNews :latest_news="props.latest_news" />
        </div>

        <div class="mt-14">
            <div class="font-bold text-4xl">
                Topic
            </div>
            <div class="flex justify-start gap-3 mt-8">
                <CategoryNews :categories="props.categories" />
            </div>
        </div>

    </div>
    <Footer />
</template>
