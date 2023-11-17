use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    newArticle: Object
})

console.log(props.newArticle);
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
        }
    }
}
</script>

<template>
    <div v-for="newArticle in newArticle" :key="newArticle.id" class="">
        <div class="my-4 flex gap-4 lg:inline-block">
            <div class="w-2/4 lg:w-full">
                <img class="rounded-lg shadow-lg w-full h-auto lg:w-full lg:h-auto" width="200" height="150"
                    :src="showImage() + newArticle.image_url" alt="thumbnile" />
            </div>
            <div class="w-2/4 lg:hidden block">
                <div class="font-bold text-xl items-center">
                    <Link :href="route('readArticle', newArticle.slug)">
                    {{ newArticle.title }}
                    </Link>
                </div>
                <div class="flex justify-start gap-4">
                    <div class="font-normal text-xs text-gray-400">
                        {{ moment(newArticle.publish_date).format("DD-MM-YYYY") }}
                    </div>
                    <div class="font-normal text-xs text-gray-400">
                        {{ newArticle.author.name }}
                    </div>
                </div>
            </div>
            <div class="lg:block hidden">
                <div class="font-bold text-xl items-center px-1">
                    <Link :href="route('readArticle', newArticle.slug)">
                    {{ newArticle.title }}
                    </Link>
                </div>
                <div class="flex justify-start mt-6 gap-4">
                    <div class="font-normal text-xs text-gray-400">
                        {{ moment(newArticle.publish_date).format("DD-MM-YYYY") }}
                    </div>
                    <div class="font-normal text-xs text-gray-400">
                        {{ newArticle.author.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>