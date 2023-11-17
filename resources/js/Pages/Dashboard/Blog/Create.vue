<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { reactive } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    categories: {
        type: Object,
        default: () => ({})
    },
    errors: Object
})

const form = reactive({
    title: null,
    content: null,
    thumbnile: null,
})

function submit() {
    router.post(route('dashboard.blogs.store'), form)
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
    }
}
</script>

<template>
    <Head title="Dashboard-AddArticle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Aricle</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">Title</label>
                                    <input type="text" v-model="form.title" placeholder="title"
                                        class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-text focus:ooutline-none focus:bg-white focus:border-gray-500">
                                    <InputError class="mt-4" :message="errors.title" />
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Thumbnile</label>
                                    <input type="file" @input="form.thumbnile = $event.target.files[0]"
                                        class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-text focus:ooutline-none focus:bg-white focus:border-gray-500">
                                    <InputError class="mt-4" :message="errors.thumbnile" />
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">Content</label>
                                    <ckeditor :editor="editor" v-model="form.content" :config="editorConfig">

                                    </ckeditor>
                                    <InputError class="mt-4" :message="errors.content" />
                                </div>
                            </div>

                            <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </PrimaryButton>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


