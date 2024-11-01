<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

const form = useForm({
    file: null,
});

const onFileChange = (event) => {
    form.file = event.target.files[0];
};

const uploadFile = () => {
    form.post(route("images.test.upload"), {
        file: form.file,
        forceFormData: true,
        onSuccess: (res) => {
            console.log("success");
            console.log(res);
        },
        onError: () => {
            console.warn(form.errors);
        }
    });
};
</script>
<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                File Upload
            </h2>
        </template>

        <div class="py-12">
            <form @submit.prevent="uploadFile">
                <div class="mb-2">
                    <Label for="file">File</Label>

                    <Input
                        id="file"
                        ref="fileInput"
                        @change="onFileChange"
                        accept="image/*"
                        type="file"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.file" class="" />
                </div>
                <Button type="submit">Upload</Button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
