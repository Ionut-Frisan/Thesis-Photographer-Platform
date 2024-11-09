import { reactive, watch } from "vue";
import axios from "axios";
import type { AxiosResponse, AxiosRequestConfig } from "axios";
import deepEqual from "fast-deep-equal"

// TODO: handle file upload

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
    errorCallback?: (errors: Record<string, string[]>) => void;
    /**
     * Function to be called regardless of the result of the request.
     */
    finallyCallback?: () => void;
} & AxiosRequestConfig;

type SubmitFunction = (method: string, url: string, options: RequestOptions) => Promise<AxiosResponse>;
type AliasFunction = (url: string, options: RequestOptions) => Promise<AxiosResponse>;

type FormData<T> = {
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
export function useForm<T>(initialValue: T = {}): FormData<T> {
    const initialData = { ...initialValue };

    const form = reactive({
        data: initialValue,
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
                .reduce((acc, [key, value]) => {
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
        form.data = initialData;
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
            ...opts
        } = options;
        let response: AxiosResponse; // Initialize the response object

        try {
            const config = {
                ...opts,
                headers: {
                    "Content-Type": "application/json",
                    ...opts.headers,
                },
                url,
                method,
                data: form.data,
            }

            response = await axios(config);

            if (successCallback && typeof successCallback === "function") {
                successCallback(response.form);
            }
            form.wasSuccessful = true;
        } catch (error) {
            if (error.response.status === 422) {
                form.rawErrors = error.response.data?.errors || {};
            }
            if (errorCallback && typeof errorCallback === "function") {
                errorCallback(error);
            }
            response = error.response;
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
