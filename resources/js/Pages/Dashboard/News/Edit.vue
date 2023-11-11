<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { reactive } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import InputError from '@/Components/InputError.vue';

// defineProps({ errors: Object })

const props = defineProps({
    news: {
        type: Object,
        default: () => ({})
    },
    categories: {
        type: Object,
        default: () => ({})
    },
    errors: Object
})

const form = reactive({
    title: props.news.title,
    content: props.news.content,
    thumbnile: props.news.image_url,
    category: props.news.categories_id,
    _method: 'put',
    hotNews: props.news.is_hot_news
    // category_name: props.news.category.category_name
})

// console.log(props.news.hotNews);

function hotNewsCheck(value) {
    // console.log(event.target.value);
    if (value) {
        confirm("Are you sure to change this news for hot news ?")
    }
}

function update() {
    router.post(route('dashboard.news.update', props.news.id), form)
}
</script>

<script>
export default {
    data() {
        return {
            editor: ClassicEditor,
            editorData: '<p>Your Post Content</p>',
            editorConfig: {
            },
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
    <Head title="Dashboard-EditNews" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit News</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="update">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">Title</label>
                                    <input type="text" v-model="form.title" placeholder="title"
                                        class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-text focus:ooutline-none focus:bg-white focus:border-gray-500">
                                    <InputError class="mt-4" :message="errors.title" />
                                </div>
                            </div>
                            <div class="flex -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">Category</label>
                                    <select
                                        class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-text focus:ooutline-none focus:bg-white focus:border-gray-500"
                                        name="" id="" v-model="form.category">
                                        <option :value="form.category">{{ props.news.category.category_name }}
                                        </option>
                                        <option v-for="category in categories" :value="category.id">{{
                                            category.category_name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-4" :message="errors.category" />
                                </div>
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">Hot
                                        News</label>
                                    <select
                                        class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-text focus:ooutline-none focus:bg-white focus:border-gray-500"
                                        name="" id="" @change="hotNewsCheck($event)" v-model="form.hotNews">
                                        <option :value="0" selected>False</option>
                                        <option :value="1">True</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Thumbnile</label>
                                    <input type="file" @input="form.thumbnile = $event.target.files[0]"
                                        class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-text focus:ooutline-none focus:bg-white focus:border-gray-500">
                                    <InputError class="mt-4" :message="errors.thumbnile" />

                                    <div class="mt-4">
                                        <img :src="showImage() + props.news.image_url" alt="thumbnile" class="h-40 w-80">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">Content</label>
                                    <ckeditor :editor="editor" v-model="form.content" :config="editorConfig">

                                    </ckeditor>
                                </div>
                            </div>

                            <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update
                            </PrimaryButton>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


