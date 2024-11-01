import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface PhotoshootOffer {
    id: number;
    title: string;
    description: string;
    price: number;
    duration: number;
    photographer_id: number;
    max_images_count: number;
    avg_turnaround_time: string;
    updated_at?: string;
    created_at?: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
