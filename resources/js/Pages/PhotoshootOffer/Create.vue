<template>
    <Head title="Create new photoshoot offer" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create photoshoot offer</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <form
                        @submit.prevent="submit"
                        class="mt-6 space-y-6"
                    >
                        <div>
                            <Label for="name">Title <span class="text-red-500">*</span></Label>

                            <Input
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="title"
                            />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div>
                            <Label for="description">Description <span class="text-red-500">*</span></Label>

                            <Textarea
                                id="description"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                required
                                autocomplete="description"
                            />

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>
                        <div>
                            <Label for="duration">Duration <span class="text-red-500">*</span></Label>

                            <Input
                                id="duration"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.duration"
                                required
                                autocomplete="duration"
                            />

                            <InputHint class="mt-1" message="Expressed in minutes"></InputHint>

                            <InputError class="mt-2" :message="form.errors.duration" />
                        </div>
                        <div>
                            <Label for="price">Price <span class="text-red-500">*</span></Label>

                            <Input
                                id="price"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.price"
                                required
                                autocomplete="price"
                            />

                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                        <div>
                            <Label for="max_images_count">Maximum images count</Label>

                            <Input
                                id="max_images_count"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.max_images_count"
                                autocomplete="max_images_count"
                            />

                            <InputError class="mt-2" :message="form.errors.max_images_count" />
                        </div>
                        <div>
                            <Label for="avg_turnaround_time">Estimated turnaround time</Label>

                            <Input
                                id="avg_turnaround_time"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.avg_turnaround_time"
                                autocomplete="avg_turnaround_time"
                            />
                            <InputHint class="mt-1" message="Expressed in minutes"></InputHint>

                            <InputError class="mt-2" :message="form.errors.avg_turnaround_time" />
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
import {Head, useForm, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputHint from "@/Components/InputHint.vue";

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

const submit = async () => {
    await form.post(route('photoshoot-offers.store'));
};
</script>

