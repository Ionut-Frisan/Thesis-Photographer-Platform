import {reactive, UnwrapNestedRefs, watch} from "vue";
import axios, { AxiosError } from "axios";
import type { AxiosResponse, AxiosRequestConfig } from "axios";
import deepEqual from "fast-deep-equal"
import {isObject} from "@/lib/utils";
import cloneDeep from "lodash.clonedeep";

type RequestOptions = {
    /**
     * Function to be called when the request is successful.
     * @param data {any}
     */
    successCallback?: (data: any) => void;
    /**
     * Function to be called when request fails.
     * @param errors {Record<string, string[]>}
     */
    errorCallback?: (error: AxiosError) => void;
    /**
     * Function to be called regardless of the result of the request.
     */
    finallyCallback?: () => void;
    /**
     * Force the form to use FormData instead of JSON.
     * @default false
     */
    forceFormData?: boolean;
} & AxiosRequestConfig;

type SubmitFunction = (method: string, url: string, options: RequestOptions) => Promise<AxiosResponse | undefined>;
type AliasFunction = (url: string, options: RequestOptions) => Promise<AxiosResponse | undefined>;

type FormInfo<T> = {
    data: T;
    errors: Record<string, string>;
    rawErrors: Record<string, string[]>;
    isDirty: boolean;
    isInvalid: boolean;
    processing: boolean;
    wasSuccessful: boolean | undefined;
    submit: SubmitFunction;
    get: AliasFunction;
    post: AliasFunction;
    patch: AliasFunction;
    delete: AliasFunction;
    put: AliasFunction;
    reset: () => void;
    resetMeta: () => void;
};

/**
 * Creates a reactive form object for managing form state and submissions.
 *
 * The `useForm` function initializes a form with the given initial data and provides
 * methods for handling form submissions, resetting form state, and tracking form
 * validation errors and processing status. It supports various HTTP methods for
 * submitting form data and automatically handles error parsing and state updates.
 *
 * @template T - The type of the initial form data.
 * @param {T} [initialValue={}] - The initial data for the form.
 * @returns {object} - A reactive object containing the form data, errors, and methods
 *   for managing form state and submissions.
 */
export function useForm<T extends {[x: string | number | symbol]: unknown}>(initialValue: T): FormInfo<T & {[x: string | number | symbol]: unknown}> {
    if (!isObject(initialValue)) {
        throw new Error("Initial value must be an object");
    }

    const initialData = { ...initialValue };

    const form: FormInfo<T> = reactive({
        data: cloneDeep(initialData),
        errors: {},
        rawErrors: {},
        isDirty: false,
        isInvalid: false,
        processing: false,
        wasSuccessful: undefined,
    });

    watch(
        () => form.data,
        (newData) => {
            form.isDirty = !deepEqual(newData, initialData);
        }
    );

    watch(
        () => form.rawErrors,
        (newData) => {
            form.isInvalid = Object.keys(newData || {}).length > 0;
        }
    );

    watch(
        () => form.rawErrors,
        (newData) => {
            if (typeof newData !== "object") {
                return;
            }
            form.errors = Object.entries(newData)
                .reduce((acc: Record<string, string>, [key, value]) => {
                    acc[key] = value.join(', ');
                    return acc;
                }, {});
        }
    )

    /**
     * Resets the form to its initial state.
     *
     * This function can be used to clear the form data, errors and status
     * after a successful submission.
     */
    const reset = () => {
        form.data = cloneDeep(initialData);
        resetMeta();
    };

    /**
     * Resets the form's meta properties.
     *
     * This function can be used to reset the form's `rawErrors`, `isDirty`,
     * `isInvalid`, `processing`, and `wasSuccessful` properties to their
     * initial state.
     */
    const resetMeta = () => {
        form.rawErrors = {};
        form.isDirty = false;
        form.isInvalid = false;
        form.processing = false;
        form.wasSuccessful = undefined;
    };

    const submit: SubmitFunction = async (method, url, options = {}) => {
        resetMeta();

        form.processing = true;
        const {
            successCallback,
            errorCallback,
            finallyCallback,
            forceFormData = false,
            ...opts
        } = options;
        let response: AxiosResponse; // Initialize the response object
        let data: FormData | T = form.data;

        // If forceFormData is true, convert the form object to FormData
        if (forceFormData) {
            data = new FormData();
            Object.entries(form.data).forEach(([key, value]) => {
                if (value instanceof File) {
                    (data as FormData).append(key, value);
                } else {
                    (data as FormData).append(key, String(value));
                }
            });
        }
        // Set the Content-Type header based on forceFormData
        const contentType = forceFormData ? "multipart/form-data" : "application/json";

        try {
            const config: AxiosRequestConfig = {
                ...opts,
                headers: {
                    "Content-Type": contentType,
                    ...opts.headers,
                },
                url,
                method,
                data,
            }

            response = await axios(config);

            if (successCallback && typeof successCallback === "function") {
                successCallback(response.data);
            }
            form.wasSuccessful = true;
        } catch (error: unknown) {
            if (!(error instanceof AxiosError)) return;

            if (error?.response?.status === 422) {
                form.rawErrors = error.response.data?.errors || {};
            }
            if (errorCallback && typeof errorCallback === "function") {
                errorCallback(error);
            }
            response = error.response as AxiosResponse;
        } finally {
            if (finallyCallback && typeof finallyCallback === "function") {
                finallyCallback();
            }
            form.processing = false;
        }

        return response;
    };

    const get: AliasFunction = async (url, options) => {
        return await submit('get', url, options);
    }

    const post: AliasFunction = async (url, options) => {
        return await submit('post', url, options);
    }

    const patch: AliasFunction = async (url, options) => {
        return await submit('patch', url, options);
    }

    const del: AliasFunction = async (url, options) => {
        return await submit('delete', url, options);
    }

    const put: AliasFunction = async (url, options) => {
        return await submit('put', url, options);
    }

    form.submit = submit;
    form.get = get;
    form.post = post;
    form.patch = patch;
    form.delete = del;
    form.put = put;

    form.reset = reset;
    form.resetMeta = resetMeta;

    return form;
}
