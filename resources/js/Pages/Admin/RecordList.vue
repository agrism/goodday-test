<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, usePage } from '@inertiajs/inertia-vue3';


const props = defineProps({
    records: [Object],
    type: String,
    createRoute: String,
    title: String,
    user: Object
});


const canManage = () => {
    if(props.type == 'blog' && props.user.permissions.includes('blog manage')){
        return true;
    }
    if(props.type == 'news' && props.user.permissions.includes('news manage')){
        return true;
    }
    return false;
}

const canView = () => {
    if(props.type == 'blog' && props.user.permissions.includes('blog view')){
        return true;
    }
    if(props.type == 'news' && props.user.permissions.includes('news view')){
        return true;
    }
    return false;
}

</script>

<template>
    <AppLayout :title="title" :permissions="user.permissions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{title}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                    <div class="mb-8" v-if="canManage()">
                        <a :href="createRoute" class="bg-green-600 text-white rounded-lg px-4 py-2">
                            Add New
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div
                            v-for="record in records" :key="record.id" v-if="canView()"
                            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-indigo-500">

                            <div class="min-w-0 flex-1">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">{{ record.title }}</p>
                                <p class="truncate text-sm text-gray-500">{{ record.short_description }}</p>
                                <p class="truncate text-sm text-gray-500">{{ record.date }}</p>
                            </div>

                            <Link :href="record.editRoute" class="z-40" v-if="canManage()">
                                <button class="bg-green-600 px-3 py-1 rounded-lg text-white">Edit</button>
                            </Link>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </AppLayout>
</template>


<style scoped>

</style>
