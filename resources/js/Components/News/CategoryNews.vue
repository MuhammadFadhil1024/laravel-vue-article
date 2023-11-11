<script setup>

const props = defineProps({
    categories: Object
})

console.log(props.categories);
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
    <div v-for="category in categories" :key="category.id"
        class="px-4 py-2 bg-slate-300 text-white font-semibold text-lg shadow-lg rounded-3xl">
        {{ category.category_name }}
    </div>
</template>
