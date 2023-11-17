<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'
import CardBlog from '@/Components/Blog/CardBlog.vue'
import Footer from '@/Components/Footer.vue'

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    newArticle: {
        type: Object,
        default: () => ({})
    },
    isHotArticle: {
        type: Object,
        default: () => ({})
    },
});

console.log(props.newArticle);
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
        limitHotNewsText(isHotArticle) {
            let content = this.stripTags(isHotArticle.content);
            let countFirstHotNews = this.firstHotNewsWord(isHotArticle).length;
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
    <Head title="Blogportal" />

    <Navbar :canLogin="canLogin" :canRegister="canRegister" />
    <div class="sm:px-32 px-5 ">
        <h1 class="font-3xl font-bold text-left py-4 text-4xl">Hot Article</h1>

        <div class="xl:flex justify-between gap-8">
            <img class="rounded-lg h-3/4" :width="870" :height="400" :src="showImage() + isHotArticle.image_url"
                alt="hottopic">
            <div class="font-normal text-sm leading-8 h-1/4">
                <span class="text-4xl">{{ firstHotNewsWord(isHotArticle) }}</span> {{ limitHotNewsText(isHotArticle) }}
                <Link class="text-blue-600" :href="route('readArticle', $page.props.isHotArticle.slug)">read more...</Link>
            </div>
        </div>

        <div class=" mt-14">
            <div class="font-bold text-4xl">
                Latest Article
            </div>
        </div>

        <div class="lg:grid grid-cols-4 gap-7 content-center">
            <CardBlog :newArticle="props.newArticle" />
            <CardBlog :newArticle="props.newArticle" />
        </div>
    </div>
    <Footer />
</template>
