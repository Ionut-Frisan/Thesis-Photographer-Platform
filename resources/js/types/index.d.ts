import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

interface BaseModel {
    id: number;
    created_at: string;
    updated_at: string;
}

export interface PhotoshootOffer extends BaseModel{
    title: string;
    description: string;
    price: number;
    duration: number;
    photographer_id: number;
    max_images_count: number;
    avg_turnaround_time: string;
}

export interface FileObject extends BaseModel{
    name: string;
    path: string;
    size: number;
    mime: string;
    extension: string;
    storage_provider: string;
}

export interface Location extends BaseModel{
    title: string;
    description: string;
    cover_image_id: number;
    cover_image: FileObject;
}

export interface CreateLocationRequest {
    title: string;
    description: string;
    cover_image: File | null;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
