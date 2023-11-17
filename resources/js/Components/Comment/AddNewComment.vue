<script setup>
import { router } from '@inertiajs/vue3';
import ButtonComment from '@/Components/Comment/ButtonComment.vue'
import { reactive } from 'vue';
import InputError from '@/Components/InputError.vue';

const form = reactive({
    comment: null
})

const props = defineProps({
    errors: Object,
    comments: Object,
    readArticle: Object
})

function addNewComment() {
    router.post(route('blogs.comments.store', props.readArticle.id), form, {
        preserveScroll: true,
        preserveState: false,
    })
}

</script>

<template>
    <form @submit.prevent="addNewComment">
        <div class="w-full">
            <textarea placeholder="Comment" v-model="form.comment" class="block w-full bg-gray-200 px-2 py-2 text-gray-700 border-gray-200 rounded leading-text
                        focus:ooutline-none focus:bg-white focus:border-gray-500"> </textarea>
            <InputError class="mt-4" :message="errors.comment" />
        </div>
        <div class="w-full">
            <ButtonComment class="w-full md:w-36">
                Post comment
            </ButtonComment>
        </div>
    </form>
</template>