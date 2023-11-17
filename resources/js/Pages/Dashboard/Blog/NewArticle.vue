<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from "moment";
import { router } from '@inertiajs/vue3';

const props = defineProps({
    blogs: {
        type: Object,
        default: () => ({})
    }
})

console.log(props.blogs);

function accepted(id) {
    if (confirm("Accepted this article ?")) {
        router.patch(route('dashboard.acceptedArticle', id))
    }
}
</script>

<script>
export default {
    data() {
        return {
            moment: moment
        }
    }
}
</script>

<template>
    <Head title="Dashboard-blogs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New article</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6">
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <div class="flex justify-between items-center">
                                <h2 class="text-2xl font-semibold leading-tight">New article need for reviews</h2>
                            </div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Title
                                                </th>
                                                <th
                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    createdAt / acceptedAt
                                                </th>
                                                <th
                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th
                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    action
                                                </th>
                                            </tr>
                                        </thead>
                                        <!-- <div v-if="blogs !== null"> -->
                                        <tbody>
                                            <tr v-for="blogs in blogs" :key="blogs.id">
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex">
                                                        <!-- <div class="flex-shrink-0 w-10 h-10">
                                                                    10-12-2023
                                                                </div> -->
                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                {{ blogs.title }}
                                                            </p>
                                                            <!-- <p class="text-gray-600 whitespace-no-wrap">000004</p> -->
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">{{
                                                        moment(blogs.created_at).format("DD-MM-YYYY") }}</p>
                                                    <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">{{ blogs.status }}</span>
                                                    </span>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <Link :href="route('readnews', blogs.slug)"
                                                        class="px-4 py-2 bg-yellow-400 rounded-md font-semibold text-white">
                                                    Show
                                                    </Link>
                                                    <button
                                                        class="px-4 py-2 bg-green-400 rounded-md font-semibold text-white ml-2"
                                                        @click="accepted(blogs.id)">
                                                        Accepted
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- <div v-if="blogs == false"> -->
                                            <div v-if="blogs == false" :colspan="5"
                                                class="px-5 py-5 bg-white text-sm text-gray-400 font-medium text-center flex justify-center">
                                                Data is null
                                            </div>
                                            <!-- </div> -->
                                        </tBody>
                                        <!-- <tbody> -->
                                        <!-- </tbody> -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

