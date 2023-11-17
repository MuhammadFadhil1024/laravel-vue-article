<script setup>
import { Head, Link } from '@inertiajs/vue3';

</script>

<script>
export default {
    props: {
        canLogin: Boolean,
        canRegister: Boolean
    }
}
</script>

<template>
    <div class="mx-auto py-4">
        <nav>
            <ul class="px-5 sm:px-32 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <Link :href="route('home')" class="bg-black px-2 py-2 rounded text-white font-bold text-base">
                    Blog
                    </Link>
                    <div class="text-black font-bold text-base">
                        Portal
                    </div>
                </div>
                <div class="flex gap-2 lg:gap-4 text-left font-semibold text-base text-gray-400">
                    <li>
                        <Link :href="route('home')"
                            class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-black focus:outline">
                        Home</Link>
                    </li>
                    <li>
                        <Link :href="route('bloglist')"
                            class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-black focus:outline">
                        Blog</Link>
                    </li>
                    <li v-if="canLogin">
                        <!-- <div v-if="canLogin"> -->
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-black focus:outline">
                        Dashboard</Link>

                        <Link v-if="$page.props.auth.user" method="post" as="button" :href="route('logout')"
                            class="text-gray-600 ml-2 hover:text-gray-900 dark:text-gray-400 dark:hover:text-black focus:outline">
                        Log Out</Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-black focus:outline">
                            Log in</Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="ml-2 lg:ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-black focus:outline">
                            Register</Link>
                        </template>
                        <!-- </div> -->
                    </li>
                </div>
            </ul>
        </nav>
    </div>
</template>