<script setup>
import moment from "moment";
import LikeDislikeComment from '@/Components/Comment/LikeDislikeComment.vue'

const props = defineProps({
    comments: Object,
    readArticle: Object
})

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
    <div class="font-semibold text-base text-left mb-4">
        All coment's
    </div>
    <div v-for="comment in props.comments" :key="comment.id" class="border rounded-xl p-4 mb-2">
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
        <div class="text-sm font-light">
            {{ comment.content_comment }}
            <LikeDislikeComment :comment="comment" :readArticle="readArticle" />
            <!-- <div class="mt-2">
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
            </div> -->
        </div>
    </div>
</template>