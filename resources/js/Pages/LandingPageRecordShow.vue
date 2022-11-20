<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    post: Object,
    head: String,
    subHead: String,
});
</script>

<template>
    <PublicLayout :title="head" canLogin canRegister>

        <div class="relative mx-auto max-w-7xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{head}}</h2>
                <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">{{subHead}}</p>
            </div>
            <div class="mx-auto mt-12 max-w-md gap-5 lg:max-w-none">
                <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                    <div class="flex-shrink-0">
                        <img class="h-80 w-full object-cover" :src="post.imageUrl" alt="{{head}}"/>
                    </div>
                    <div class="flex flex-1 flex-col justify-between bg-white p-6">
<!--                        <div>-->
<!--                            <span class="text-xl font-semibold text-gray-900">{{ post.title }}</span>-->
<!--                        </div>-->
                        <div>
                            <span class="mt-3 text-base text-gray-900 font-black">{{ post.description }}</span>
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
                        <div class="mt-4">
                            <span class="mt-3 text-base text-gray-500" v-html="post.text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
