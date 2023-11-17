<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    listArticle: Object
})

console.log(props.listArticle);
</script>

<script>
import moment from 'moment'
export default {
    data() {
        return {
            moment: moment
        }
    },
    methods: {
        showImage() {
            return "/thumbnile/"
        },
        limitArticleText(listArticle) {
            let content = this.stripTags(listArticle);
            return content.length > 100 ? content.substring(0, 100) + '...' : content;
        },
        stripTags(text) {
            return text.replace(/(<([^>]+)>)/ig, '');
        },
    },
}
</script>


<template>
    <div v-for="listArticle in listArticle" :key="listArticle.id" class="">
        <div class="my-4 flex md:flex-col gap-4">
            <div class="w-2/4 md:w-auto">
                <img class="rounded-lg shadow-lg w-full h-auto md:w-auto lg:h-auto" width="200" height="150"
                    :src="showImage() + listArticle.image_url" alt="thumbnile" />
            </div>
            <div class="w-2/4 lg:hidden block md:w-auto px-1">
                <div class="font-bold text-md items-center">
                    <Link :href="route('readArticle', listArticle.slug)">
                    {{ listArticle.title }}
                    </Link>
                </div>
                <div class="flex justify-start gap-4">
                    <div class="font-normal text-xs text-gray-400">
                        1 Our Ago
                    </div>
                    <div class="font-normal text-xs text-gray-400">
                        CNN Indonesia
                    </div>
                </div>
            </div>
            <div class="lg:block hidden">
                <div class="font-bold text-xl items-center px-1">
                    <Link :href="route('readArticle', listArticle.slug)">
                    {{ listArticle.title }}
                    </Link>
                    <div class="text-left text-thin font-thin">
                        {{ limitArticleText(listArticle.content) }}
                    </div>
                </div>
                <div class="flex justify-start mt-6 gap-4">
                    <div class="font-normal text-xs text-gray-400">
                        1 Our Ago
                    </div>
                    <div class="font-normal text-xs text-gray-400">
                        CNN Indonesia
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>