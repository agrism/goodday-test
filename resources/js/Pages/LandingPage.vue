<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    posts: Object,
    head: String,
    subHead: String,
});
</script>

<template>
    <PublicLayout :title="head" canLogin canRegister>
            <div class="relative mx-auto max-w-7xl">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{head}}</h2>
                    <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">
                        {{subHead}}</p>
                </div>
                <div class="mx-auto mt-12 grid max-w-md gap-5 lg:max-w-none lg:grid-cols-3 gap-4">
                    <div v-for="post in posts" :key="post.title"
                         class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" :src="post.imageUrl" alt=""/>
                        </div>
                        <div class="flex flex-1 flex-col justify-between bg-white p-6">
                            <div class="flex-1">
                                <a :href="post.href" class="mt-2 block">
                                    <p class="text-xl font-semibold text-gray-900">{{ post.title }}</p>
                                    <p class="mt-3 text-base text-gray-500">{{ post.description }}</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a :href="post.author.href">
                                        <span class="sr-only">{{ post.author.name }}</span>
                                        <img class="h-10 w-10 rounded-full" :src="post.author.imageUrl" alt=""/>
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        <a :href="post.author.href" class="hover:underline">{{ post.author.name }}</a>
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <time :datetime="post.datetime">{{ post.date }}</time>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ post.readingTime }} min read</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </PublicLayout>
</template>
