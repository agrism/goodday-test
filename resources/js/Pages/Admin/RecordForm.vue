<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from "@inertiajs/inertia-vue3";
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    record: Object,
    type: String,
    title: String,
    formAction: String,
    formActionMethod: String,
    user: Object
});

const form = useForm({
    _method: props.formActionMethod,
    id: props.record ? props.record.id : null,
    title: props.record ? props.record.title : null,
    short_description: props.record ? props.record.short_description : null,
    text: props.record ? props.record.text : null,
});

const storeRecord = () => {
    form.post(props.formAction, {
        '_method': props.formActionMethod,
        errorBag: 'handleRecord',
        preserveScroll: true,
        onSuccess: () => null,
        onError: () => console.log('error1')
    });
};
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
                    <form @submit.prevent="storeRecord">
                        <div>
                            <div class="my-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">Add title</label>
                                <div class="mt-1">
                                    <textarea
                                        rows="1"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        v-model="form.title"
                                    ></textarea>
                                    <InputError :message="form.errors.title" class="mt-2"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="my-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">Add short
                                    description</label>
                                <div class="mt-1">
                                    <textarea
                                        rows="4"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        v-model="form.short_description"
                                    ></textarea>
                                    <InputError :message="form.errors.short_description" class="mt-2"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="my-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">Add text</label>
                                <div class="mt-1">
                                    <textarea
                                        rows="12"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        v-model="form.text"
                                    ></textarea>
                                    <InputError :message="form.errors.text" class="mt-2"/>
                                </div>
                            </div>
                        </div>
                        <button class="bg-green-600 px-3 py-1 rounded-lg text-white">
                            <span v-if="form.id">Update</span>
                            <span v-else>Create</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </AppLayout>
</template>


<style scoped>

</style>
