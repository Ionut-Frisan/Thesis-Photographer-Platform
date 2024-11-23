<template>
    <Label :for="id"> {{ label }} <span v-if="required" class="text-red-500">*</span></Label>

    <slot >
        <Input
            v-model="model"
            :type="type"
            :placeholder="placeholder"
            :required="required"
            :readonly="readonly"
            :id="id"
            :autofocus="autofocus"
            :autocomplete="id"
            :multiple="multiple"
            :accept="accept"
            @change="onChange"
            class="mt-1 block w-full"
        ></Input>
    </slot>

    <InputHint v-if="!!hint" class="mt-1" :message="hint"></InputHint>

    <InputError v-if="!!error" class="mt-2" :message="error"></InputError>
</template>

<script setup lang="ts">

import InputHint from "@/Components/InputHint.vue";
import InputError from "@/Components/InputError.vue";

const model = defineModel();

const props = withDefaults(
    defineProps<{
        label: string;
        id: string
        hint?: string;
        error?: string;
        type?: string;
        placeholder?: string;
        required?: boolean;
        readonly?: boolean;
        autofocus?: boolean;
        multiple?: boolean;
        accept?: string,
    }>(),
    {
        label: '',
        id: '',
        hint: '',
        error: '',
        type: 'text',
        placeholder: '',
        required: false,
        readonly: false,
        autofocus: false,
        multiple: false,
        accept: '',
    }
)

const emit = defineEmits(['change']);

const onChange = (event) => {
    emit('change', event);
}

</script>
<style scoped>

</style>
