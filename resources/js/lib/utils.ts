import { type ClassValue, clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'

export function cn(...inputs: ClassValue[]): string {
  return twMerge(clsx(inputs))
}

/**
 * Checks if the given value is a non-null, non-array object.
 *
 * @remarks
 * This function is a simple type guard that checks if the given value is an object.
 * It returns `true` if the value is an object, and `false` otherwise.
 *
 * @param value The value to check.
 * @returns Whether the given value is an object.
 */
export function isObject(value: unknown): value is Record<string, unknown> {
  return typeof value === 'object' && value !== null && !Array.isArray(value)
}


/**
 * Retrieves files from the given event.
 *
 * @param event The event to retrieve the files from.
 * @returns An array of `File` objects from the event.
 */
export function getFilesFromEvent(event: Event): File[] {
    const target = event.target as HTMLInputElement
    const hasFiles = !!target.files && target.files.length > 0;
    return hasFiles ? Array.from(target.files as FileList) : [];
}

/**
 * Retrieves the first file from the given event.
 *
 * @param event The event to retrieve the file from.
 * @returns The first `File` object from the event.
 */
export function getFileFromEvent(event: Event): File | undefined {
    return getFilesFromEvent(event)[0];
}
