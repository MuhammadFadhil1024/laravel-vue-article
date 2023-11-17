<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import AddNewComment from '@/Components/Comment/AddNewComment.vue'
import LikeDislikeArticle from '@/Components/Like/LikeDislikeArticle.vue'
import MyComment from '@/Components/Comment/MyComment.vue'
import moment from "moment";
import AllComment from '@/Components/Comment/AllComment.vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    readArticle: {
        type: Object,
        default: () => ({})
    },
    authUser: {
        type: Object,
        default: () => ({})
    },
    comments: {
        type: Object,
        default: () => ({})
    },
    myComments: {
        type: Object,
        default: () => ({})
    },
    hasBeenLikeArticle: {
        type: Object,
        default: () => ({})
    },
    errors: Object
});
</script>

<script>
export default {
    data() {
        return {
            moment: moment,
            disabled: true
        }
    },
    methods: {
        showImage() {
            return "/thumbnile/"
        },
        stripTags(text) {
            return text.replace(/(<([^>]+)>)/ig, '');
        },
        updateComment(value) {
            this.variable = value
        },
    },
}
</script>

<template>
    <Navbar :canLogin="canLogin" :canRegister="canRegister" />

    <Head title="Blogportal" />
    <div class="mt-8 px-5 md:px-32 md:flex gap-6">
        <div class="md:w-3/4">
            <div class="border shadow-lg p-4 rounded-xl">
                <h1 class="font-bold text-3xl">
                    {{ readArticle.title }}
                </h1>
                <div class="flex justify-start mt-5 text-sm text-gray-300 font-semibold gap-2">
                    <h4>
                        {{ readArticle.author.name }}
                    </h4>
                    <div>
                        |
                    </div>
                    <h4>
                        {{ readArticle.publish_date }}
                    </h4>
                </div>
                <img class="rounded-lg mt-2" :src="showImage() + readArticle.image_url" :width="700" :height="300"
                    alt="thumbnile">
                <p class="text-lg pr-12 mt-6">
                    {{ stripTags(readArticle.content) }}
                </p>
                <LikeDislikeArticle :readArticle="readArticle" :hasBeenLikeArticle="hasBeenLikeArticle" />
            </div>
            <div class="mt-4 border shadow-lg p-4 rounded-xl">
                <AddNewComment :comment="comments" :errors="errors" :readArticle="readArticle" />
                <MyComment :myComments="props.myComments" :errors="errors" :readArticle="readArticle" />
                <div class="border shadow-lg p-4 rounded-xl mt-3 md:w-3/4">
                    <AllComment :comments="comments" :readArticle="readArticle" />
                </div>
            </div>
        </div>
    </div>

    <Footer />
</template>