<script setup>
import { ref, computed } from 'vue';
import moment from "moment";
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    myComments: Object,
    errors: Object,
    readArticle: Object
})

const commentsForm = ref([]);

if (props.myComments) {
    commentsForm.value = props.myComments.map(comment => ({ ...comment, errors: {} }));
}

const updateComment = (comment, id) => {

    const myCommentForm = reactive({
        myComment: comment,
        _method: 'put'
    })

    router.post(route('blogs.comments.update', {
        'blog': props.readArticle.id,
        'comment': id
    }), myCommentForm, {
        preserveScroll: true,
        preserveState: false,
    })

    console.log('Updating comment:', comment);
};
console.log(commentsForm);

function deleteMyComment(myCommentId) {
    if (confirm("Are you sure to delete your comment")) {
        router.delete(route('blogs.comments.destroy', {
            'blog': props.readArticle.id,
            'comment': myCommentId
        }), {
            preserveScroll: true,
            preserveState: false,
        })
    }
}
</script>

<script>
export default {
    data() {
        return {
            moment: moment,
            disabled: true
        }
    },
}
</script>

<template>
    <div v-if="props.myComments != null" class="border shadow-lg p-4 rounded-xl mt-3 md:w-3/4">
        <div class="font-semibold text-base text-left mb-4">
            Yours comment
        </div>
        <div v-for="(comment, index) in commentsForm" :key="index" class="border rounded-xl p-4 mb-2">
            <div class="flex justify-start gap-2 items-center">
                <div class="text-left font-medium text-sm">
                    {{ comment.user.name }}
                </div>
                <div>
                    |
                </div>
                <div class="text-left font-medium text-sm">
                    {{ moment(comment.user.created_at).format("DD-MM-YYYY") }}
                </div>
            </div>
            <div class="w-full">
                <textarea v-model="comment.content_comment"
                    class="block w-full bg-gray-200 px-2 py-2 text-gray-700 border-gray-200 rounded leading-text
                                    focus:ooutline-none focus:bg-white focus:border-gray-500 text-left font-medium text-sm">
                            </textarea>
                <InputError class="mt-4" :message="errors.myComment" />
            </div>
            <div class="flex justify-start gap-2">
                <button @click="updateComment(comment.content_comment, comment.id)"
                    class="px-4 py-1 bg-slate-500 text-center text-white rounded-md mt-2 text-sm">
                    Update comment
                </button>
                <button @click="deleteMyComment(comment.id)"
                    class="px-4 py-1 bg-red-500 text-center text-white rounded-md mt-2 text-sm">
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>