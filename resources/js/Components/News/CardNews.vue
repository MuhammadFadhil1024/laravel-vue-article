<script setup>

const props = defineProps({
    latest_news: Object
})

// console.log(props.latest_news);
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
    <div v-for="latest_news in latest_news" :key="latest_news.id" class="">
        <div class="py-4">
            <img class="rounded-lg mx-auto shadow-lg h-300 w-300" :src="showImage() + latest_news.thumbnile"
                alt="thumbnile" />
            <div class="font-bold text-2xl items-center mt-4">
                {{ latest_news.title }}
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
</template>