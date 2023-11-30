<script setup>
import BaseModal from '@/Components/Modal/BaseModal.vue';
import WriteComment from './WriteComment.vue';
import { ref } from 'vue';

const modalActive = ref(false)
const toggleModal = () => {
    modalActive.value = !modalActive.value
}

const props = defineProps({
    comments: Object,
    readArticle: Object
})

// console.log(props.comments);

</script>

<template>
    <div class="font-bold text-base py-4">
        <button @click="toggleModal">
            See other comments
        </button>
    </div>
    <BaseModal :modalActive="modalActive" @close-modal="toggleModal">
        <div v-for="comment in comments" :key="comment.id" class="flex justify-start gap-2 px-10 w-full mt-2">
            <div>
                <img class="rounded-full" src="https://picsum.photos/60" alt="profile-image">
            </div>
            <div class="w-full">
                <div class="w-full">
                    <div class="block w-full bg-gray-200 px-4 py-2 rounded-2xl">
                        <div class="font-bold text-sm">
                            {{ comment.user.name }}
                        </div>
                        <div class="font-thin text-sm">
                            {{ comment.content_comment }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-start gap-2 px-2 text-sm font-bold mt-2">
                    <button>
                        Like
                    </button>
                    <button>
                        Reply
                    </button>
                </div>
            </div>
        </div>
    </BaseModal>
    <div v-for="comment in comments" :key="comment.id" class="flex justify-start gap-2 md:w-2/3 w-full mt-2">
        <div>
            <img class="rounded-full" src="https://picsum.photos/60" alt="profile-image">
        </div>
        <div class="w-full">
            <div class="w-full">
                <div class="block w-full bg-gray-200 px-4 py-2 rounded-2xl">
                    <div class="font-bold text-sm">
                        {{ comment.user.name }}
                    </div>
                    <div class="font-thin text-sm">
                        {{ comment.content_comment }}
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-start gap-2 px-2 text-sm font-bold mt-2">
                <button>
                    Like
                </button>
                <button>
                    Reply
                </button>
            </div>
        </div>
    </div>
    <div class="md:w-2/3 mt-2">
        <WriteComment :read-article="readArticle" />
    </div>
</template>