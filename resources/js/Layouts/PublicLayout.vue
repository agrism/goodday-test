<script setup>
import {Inertia} from '@inertiajs/inertia';
import {Head, Link} from '@inertiajs/inertia-vue3';
import Banner from '@/Components/Banner.vue';

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    posts: Object
});


const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title"/>

        <Banner/>

        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <main>
                <div class="relative bg-gray-50 px-4 pt-16 pb-20 sm:px-6 lg:px-8 lg:pt-24 lg:pb-28">

                    <div v-if="canLogin" class="hidden fixed top-0 left-0 px-6 py-4 sm:block z-40 text-md">
                            <Link :href="route('blog.index')" class=" text-gray-700 dark:text-gray-500 underline">
                                Blog
                            </Link>

                            <Link v-if="canRegister" :href="route('news.index')"
                                  class="ml-4 text-gray-700 dark:text-gray-500 underline">
                                News
                            </Link>
                    </div>


                    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block z-40">
                        <Link v-if="$page.props.user" :href="route('profile.show')"
                              class="text-sm text-gray-700 dark:text-gray-500 underline">Profile
                        </Link>

                        <template v-else>
                            <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                  class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register
                            </Link>
                        </template>
                    </div>
                    <slot/>
                </div>
            </main>
        </div>
    </div>
</template>
