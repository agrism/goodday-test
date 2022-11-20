<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import RoleTable from "@/Components/RoleTable.vue";

const props = defineProps({
    roles: Object,
    activeRole: Object,
    user: Object
});
</script>

<template>
    <AppLayout title="Roles" :permissions="user.permissions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles / Permissions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <role-table :roles="roles" :activeRole="activeRole ?? null"></role-table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
