<template>
    <Head title="Create new Location"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Location</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <form
                        @submit.prevent="submit"
                        class="mt-6 space-y-6"
                    >
                        <div>
                            <FormField
                                label="Title"
                                id="title"
                                autofocus
                                v-model="form.data.title"
                                :error="form.errors.title"
                                required
                            />
                        </div>
                        <div>
                            <FormField
                                label="Description"
                                id="description"
                                required
                                :error="form.errors.description"
                            >
                                <Textarea
                                    id="description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.data.description"
                                    required
                                    autocomplete="description"
                                />
                            </FormField>
                        </div>
                        <div>
                            <FormField
                                label="Cover Image"
                                id="cover_image"
                                required
                                type="file"
                                :multiple="false"
                                :error="form.errors.cover_image"
                                @change="onFileChange"
                                accept="image/*"
                            />
                        </div>
                        <div class="flex items-center gap-4">
                            <Button :disabled="form.processing">Create</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import {useForm} from "@/Composables/useForm";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormField from "@/Components/FormField.vue";
import {useToast} from '@/Components/ui/toast/use-toast'
import { getFileFromEvent } from "@/lib/utils";
import {CreateLocationRequest} from "@/types";

const form = useForm<CreateLocationRequest>({
    title: '',
    description: '',
    cover_image: null,
});

const onFileChange = (e: Event) => {
    form.data.cover_image = getFileFromEvent(e);
};

const { toast } = useToast();

const submit = async () => {
    await form.post(route('locations.store'), {
        forceFormData: true,
        successCallback() {
            toast({
                variant: 'success',
                title: 'Success',
                description: 'Location created successfully',
            });
            form.reset();
        }
    });
};
</script>

