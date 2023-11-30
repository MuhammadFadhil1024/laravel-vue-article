<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    recomendationArticle: Object
})
</script>

<script>

export default {
    methods: {
        showImage() {
            return "/thumbnile/"
        },
        limitArticleText(listArticle) {
            let content = this.stripTags(listArticle);
            return content.length > 70 ? content.substring(0, 70) + '...' : content;
        },
        stripTags(text) {
            return text.replace(/(<([^>]+)>)/ig, '');
        },
    }
}

</script>

<template>
    <div class="border shadow-lg rounded-md px-6">
        <h1 class="font-semibold text-lg pt-4 pb-6">
            Recomendation for you
        </h1>

        <div class="grid grid-cols-2 gap-4 content-center pb-4">
            <div v-for="recomendationArticle in recomendationArticle" :key="recomendationArticle.id"
                class="grid grid-cols-1 gap-1">
                <img class="rounded-md" width="200" height="100" :src="showImage() + recomendationArticle.image_url"
                    alt="thumbnile">
                <Link :href="route('readArticle', recomendationArticle.slug)">
                <h1 class="font-bold text-md">{{ recomendationArticle.title }}</h1>
                </Link>
                <p class="text-sm">
                    {{ limitArticleText(recomendationArticle.content) }}
                </p>
                <div class="text-xs text-gray-400">
                    <div class="">
                        {{ recomendationArticle.author.name }}
                    </div>
                    <div class="">
                        Publihed On : {{ recomendationArticle.publish_date }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>