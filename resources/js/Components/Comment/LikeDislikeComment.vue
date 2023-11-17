<script setup>
import ButtonLike from '@/Components/Like/ButtonLike.vue'
import ButtonDislike from '@/Components/Like/ButtonDislike.vue'
import { router } from '@inertiajs/vue3';

const props = defineProps({
    comment: Object,
    readArticle: Object
})

// LIKE COMMENT AND DISLIKE
function likeComment(commentId) {
    // console.log(commentId);
    router.post(route('likeComment', {
        'blog_id': props.readArticle.id,
        'comment_id': commentId
    }), {
        preserveScroll: true,
        preserveState: false,
    })
}

function cancelLikeComment(commentLikeId) {
    // console.log(commentLikeId);
    router.delete(route('cancelLikeComment', {
        'blog_id': props.readArticle.id,
        'comment_like_id': commentLikeId
    }), {
        preserveScroll: true,
        preserveState: false,
    })
}

function dislikeComment(commentId) {
    router.post(route('dislikeComment', {
        'blog_id': props.readArticle.id,
        'comment_id': commentId
    }), {
        preserveScroll: true,
        preserveState: false,
    })
}

// END OF LIKE COMMENT AND DISLIKE

</script>

<template>
    <div class="mt-2">
        <div v-if="comment.status_like.status == 1">
            <ButtonDislike @click="cancelLikeComment(comment.status_like.like_id)">
                Cancel like
            </ButtonDislike>
        </div>
        <div v-else-if="comment.status_like.status == 2">
            <ButtonLike @click="cancelLikeComment(comment.status_like.like_id)">
                Cancel Dislike
            </ButtonLike>
        </div>
        <div class="flex justify-start gap-2" v-else>
            <ButtonDislike @click="dislikeComment(comment.id)">
                Dislike
            </ButtonDislike>
            <ButtonLike @click="likeComment(comment.id)">
                Like
            </ButtonLike>
        </div>
    </div>
</template>