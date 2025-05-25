
// Paginator.ts
export interface Paginator<D> {
    data: D[];
    links: Links;
    meta: Meta;
}


export interface Links {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
}

export interface Meta {
    current_page: number;
    from: number;
    last_page: number;
    links: MetaLink[];
    path: string;
    per_page: number;
    to?: number;
    total?: number;
}

export interface MetaLink {
    url: string | null;
    label: string;
    active: boolean;
}



// Post.ts

export interface Post {
    id: number;
    title: string;
    content: string | null;
    user: UserMini;
    comments: Comment[];
    likes_count: number;
    likes: Like[];
    tags: Tag[];
    images_uri: string | null;
    created_at: string;
    updated_at: string;
}



export interface Comment {
    id: number;
    content: string | null;
    user: UserMini;
    created_at: string;
}

export interface Like {
    id: number;
    user: UserMini;
}



export interface Tag {
    id: number;
    name: string;
}

export interface LikeOrDislikeResponse {
    success: boolean;
    message: string;
    like_count?: Like | null;
}


// auth.ts
export interface UserFull {
    id: number;
    first_name: string;
    last_name: string;
    name: string;
    sexe: string;
    email: string;
    numero: number;
    numero_identifiant: string;
    email_verified_at: string | null;
    two_factor_confirmed_at: string | null;
    current_team_id: number | null;
    profile_photo_path: string | null;
    role: string;
    statut: string;
    created_at: string;
    updated_at: string;
    compagnie_id: number;
    profile_photo_url: string;
}

export interface UserMini {
    id: number;
    first_name: string;
    last_name: string;
    name: string;
    sexe: string;
    email: string;
    numero: number;
    numero_identifiant: string;
    profile_photo_path: string | null;
    profile_photo_url: string;
}

export interface UserUltraMini {
    id: number;
    first_name: string;
    last_name: string;
    name: string;
    profile_photo_path: string | null;
    profile_photo_url: string;
}


export interface UserLogin {
    email: string;
    password: string;
    remember: boolean;
}

export interface UserRegister {
    first_name: string;
    last_name: string;
    email: string;
    password: string;
    password_confirmation: string;
    sexe: string;
    numero_identifiant: string;
}

export interface UserUpdate {
    first_name: string;
    last_name: string;
    email: string;
    sexe: string;
    numero_identifiant: string;
    profile_photo_path?: string | null;
}

export interface UserUpdatePassword {
    current_password: string;
    password: string;
    password_confirmation: string;
}

export interface UserUpdateProfilePhoto {
    profile_photo_path: string | null;
}

// App.ts


export interface ErrorResponse {
  success: boolean;
  errors?: Record<string, string[]>;
  message: string;
}






