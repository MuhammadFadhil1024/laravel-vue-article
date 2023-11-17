<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import { reactive } from 'vue';
import CardListArticle from '@/Components/Blog/CardListArticle.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { watch } from 'vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    listArticle: {
        type: Object,
        default: () => ({})
    },
    filters: {
        type: Object,
        default: () => ({})
    }
});

// console.log(props.listArticle);

const form = reactive({
    search: null,
})

// search

let search = ref(props.filters.search)
watch(search, (value) => {
    router.get("/searcharticle",
        { search: value },

    )
})

</script>

<template>
    <Head title="Blogportal" />
    <Navbar :canLogin="canLogin" :canRegister="canRegister" />
    <div class="px-5 py-5 md:px-32">
        <div class="flex justify-start gap-2 items-center mb-4 ">
            <div class="w-32">
                <input type="text" placeholder="search" v-model="search" class="block w-full bg-gray-200 px-2 py-2 text-gray-700 border-gray-200 rounded leading-text
                focus:ooutline-none focus:bg-white focus:border-gray-500">
            </div>
            <div>
                <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </div>

        <div class="md:grid grid-cols-2 content-center gap-8">
            <CardListArticle :listArticle="props.listArticle.data" />
        </div>
    </div>
    <Footer />
</template>