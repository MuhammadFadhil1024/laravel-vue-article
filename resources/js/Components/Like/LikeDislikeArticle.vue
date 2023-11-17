<script setup>
// like and dislike article
import { router } from '@inertiajs/vue3';
import ButtonLike from '@/Components/Like/ButtonLike.vue'
import ButtonDislike from '@/Components/Like/ButtonDislike.vue'

const props = defineProps({
    readArticle: Object,
    hasBeenLikeArticle: Object
})

function likeArticle(articleId) {
    router.post(route('likeArticle', articleId), {
        preserveScroll: true,
        preserveState: false,
    })
}

function cancelLike(articleId, likeId) {
    // console.log(likeId);
    router.delete(route('cancelLike', {
        'blog_id': articleId,
        'like_id': likeId
    }), {
        preserveScroll: true,
        preserveState: false,
    })
}

function dislikeArticle(articleId) {
    router.post(route('dislikeArticle', {
        'blog_id': articleId,
    }), {
        preserveScroll: true,
        preserveState: false,
    })
}

// END OF LIKE AND DISLIKE ARTICLE
</script>

<template>
    <div class="mt-2">
        <div v-if="props.hasBeenLikeArticle.status == 1">
            <ButtonDislike @click="cancelLike(readArticle.id, props.hasBeenLikeArticle.like_id)">
                Cancel like
            </ButtonDislike>
        </div>
        <div v-else-if="props.hasBeenLikeArticle.status == 2">
            <ButtonLike @click="cancelLike(readArticle.id, props.hasBeenLikeArticle.like_id)">
                Cancel Dislike
            </ButtonLike>
        </div>
        <div class="flex justify-start gap-2" v-else>
            <ButtonDislike @click="dislikeArticle(readArticle.id)">
                Dislike
            </ButtonDislike>
            <ButtonLike @click="likeArticle(readArticle.id)">
                Like
            </ButtonLike>
        </div>
    </div>
</template>