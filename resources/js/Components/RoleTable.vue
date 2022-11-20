<template>
    <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3">
        <div class="col-span-2">
            <div class="px-4 sm:px-6 lg:px-8 mt-4 mb-6">
                <div class=" px-4 py-6 rounded-lg">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Roles</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all roles</p>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">

                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Role name
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Role key
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="role in roles ?? []" :key="role.id"
                                            :class="{'bg-green-100': isCurrentRoleActive(role.id)}">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ role.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    role.key
                                                }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-blue-700">
                                                <Link :href="route('admin.role.details', role.id)">
                                                    show role permissions
                                                </Link>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="px-4 sm:px-6 lg:px-8 mt-4 mb-6">
                <div class=" px-4 py-6 rounded-lg">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Permissions</h1>
                            <div class="flex justify-between">
                                <p class="mt-2 text-sm text-gray-700 ">
                                    <template  v-if="activeRole">
                                        Selected role: <strong class="text-green-600">{{activeRole.name}}</strong>
                                    </template>
                                    <template  v-else>
                                        Role not selected
                                    </template>
                                </p>
                                <button v-if="activeRole" @click="submitRolePermissions"
                                        class="bg-green-700 text-white rounded-lg py-1 px-3">Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-if="activeRole" class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">

                                    <div v-if="activeRole && activeRole.optionalPermissions" class="sm:p-2">
                                        <div v-for="(permission, index) in activeRole.optionalPermissions">
                                            <div v-if="permission.id">
                                                {{ permission.full_name }}
                                                <input :id="`person-xxx`"
                                                       :name="`person-xxx`"
                                                       type="checkbox"
                                                       v-model="permission.enabled"
                                                       class="h-4 w-4 border-green-500 border-2 text-green-600 focus:ring-green-200 float-right"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>

</script>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {Link},
    props: {
        roles: {
            type: [Object],
            default: [],
        },
        activeRole: {
            type: Object,
            default: null,
        }
    },
    methods: {
        isCurrentRoleActive: function (roleId) {
            return this.activeRole && this.activeRole.id == roleId;
        },
        submitRolePermissions: function () {
            let proxy = this.activeRole.optionalPermissions;
            let perm = JSON.parse(JSON.stringify(proxy));
            let params = [];

            for (let i in perm) {
                if (perm[i].enabled == false) {
                    continue
                }
                params.push(perm[i].id);
            }

            this.$inertia.post(`/admin/role/${this.activeRole.id}/update`, {
                permissionIds: params
            });
        }
    },
    computed: {
        active() {
            if (this.activeRole) {
                return this.activeRole.optionalPermissions
            }
            return null;
        }
    },
    setup(props) {
        // console.log('roles', props.roles)
        // console.log('activeRole', props.activeRole)

        // function addOrRemovePermissionToActiveRole(id) {
        //     console.log('idd: '+id);
        // }
    }
}
</script>
