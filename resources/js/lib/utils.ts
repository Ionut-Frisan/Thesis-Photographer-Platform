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
