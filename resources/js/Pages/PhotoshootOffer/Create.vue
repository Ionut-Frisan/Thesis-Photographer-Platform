<template>
    <Head title="Create new photoshoot offer"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create photoshoot
                offer</h2>
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
                                label="Duration"
                                id="duration"
                                required
                                hint="Expressed in minutes"
                                type="number"
                                v-model="form.data.duration"
                                :error="form.errors.duration"
                            />
                        </div>
                        <div>
                            <FormField
                                label="Price"
                                id="price"
                                required
                                type="number"
                                v-model="form.data.price"
                                :error="form.errors.price"
                            />
                        </div>
                        <div>
                            <FormField
                                label="Maximum images count"
                                id="max_images_count"
                                v-model="form.data.max_images_count"
                                :error="form.errors.max_images_count"
                                type="number"
                            />
                        </div>
                        <div>
                            <FormField
                                label="Average turnaround time"
                                id="avg_turnaround_time"
                                v-model="form.data.avg_turnaround_time"
                                :error="form.errors.avg_turnaround_time"
                                type="number"
                                hint="Expressed in minutes"
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
import {Head, usePage} from "@inertiajs/vue3";
import {useForm} from "../../Composables/useForm";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormField from "@/Components/FormField.vue";
import {useToast} from '@/Components/ui/toast/use-toast'

const user = usePage().props.auth.user;

const form = useForm({
    photographer_id: user.id,
    title: '',
    description: '',
    duration: null,
    price: null,
    max_images_count: null,
    avg_turnaround_time: null,
});

const {toast} = useToast();

const submit = async () => {
    await form.post(route('photoshoot-offers.store'), {
        successCallback() {
            toast({
                variant: 'success',
                title: 'Success',
                description: 'Photoshoot offer created successfully',
            });
            form.reset();
            form.data.tst = Date.now();
        }
    });
};
</script>

