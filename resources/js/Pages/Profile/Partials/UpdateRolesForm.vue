<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);
const checkedIds = ref([]);

const props = defineProps({
    roles: Object,
});

const form = useForm({
    _method: 'PUT',
    checked_ids: props.roles
});

const updateRolesInformation = () => {
    form.post(route('user-roles-information.update'), {
        errorBag: 'updateRolesInformation',
        preserveScroll: true,
        onSuccess: () => null,
        onError: () => null,
    });
};
</script>


<template>
    <FormSection @submitted="updateRolesInformation">
        <template #title>
            Update Roles
        </template>

        <template #description>
            Manage user roles
        </template>

        <template #form>
            <div v-for="(role, index ) in roles" :key="role.id" class="col-span-6 sm:col-span-4 flex">
                <Checkbox
                    :name="'role_'+role.id"
                    :value="'_'+role.id"
                    :checked="form.checked_ids[index].enabled" v-model="form.checked_ids[index].enabled"
                    class="rounded border-green-300 text-green-600"
                />
                <InputLabel :for="'role_'+role.id" :value="role.name" class="ml-2" />
            </div>
        </template>
        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
