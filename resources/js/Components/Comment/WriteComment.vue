<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const form = reactive({
    comment: ''
})

const props = defineProps({
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
        <div class="flex justify-start gap-2 items-center w-full">
            <div>
                <img class="rounded-full" src="https://picsum.photos/60" alt="profile-image">
            </div>
            <div class="w-full">
                <div class="w-full">
                    <textarea v-model="form.comment" class="block w-full bg-gray-200 rounded-xl text-sm"
                        placeholder="Write your's response"></textarea>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-2">
            <button :disabled="form.comment.trim() === ''"
                class="px-4 py-1 bg-red-500 rounded-md text-white text-sm font-semibold disabled:bg-red-400 disabled:cursor-not-allowed">
                Send
            </button>
        </div>
    </form>
</template>
  