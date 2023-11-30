<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    isHotArticle: Object
})

console.log(props.isHotArticle);
</script >

<script>
export default {
    methods: {
        showImage() {
            return "/thumbnile/"
        },
        firstHotNewsWord(text) {
            let content = this.stripTags(text.content);
            var firtsWord = content.replace(/ .*/, '');
            console.log(firtsWord);
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
</script>

<template>
    <div class="xl:flex justify-between gap-8" v-if="isHotArticle != null">
        <img class="rounded-lg h-3/4" :width="870" :height="400" :src="showImage() + isHotArticle.image_url" alt="hottopic">
        <div class="font-normal text-sm leading-8 h-1/4">
            <span class="text-4xl">{{ firstHotNewsWord(isHotArticle) }}</span> {{ limitHotNewsText(isHotArticle) }}
            <Link class="text-blue-600" :href="route('readArticle', $page.props.isHotArticle.slug)">read more...</Link>
        </div>
    </div>

    <!-- <div class="xl:flex justify-between gap-8" v-else>
        <img class="rounded-lg h-3/4" :width="870" :height="400" src="assets/imgae/cabe.jpeg" alt="hottopic">
        <div class="font-normal text-sm leading-8 h-1/4">
            <span class="text-4xl">{{ firstHotNewsWord(isHotArticle) }}</span> {{ limitHotNewsText(isHotArticle) }}
            <Link class="text-blue-600" :href="route('readArticle', $page.props.isHotArticle.slug)">read more...</Link>
        </div>
    </div> -->
</template>