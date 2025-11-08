<template>
    <div class="mx-auto max-w-7xl p-4">
        <div
            class="mb-6 rounded-2xl bg-gradient-to-r from-violet-600 to-indigo-600 p-6 text-white shadow-lg"
        >
            <div class="flex items-center justify-between">
                <div>
                    <Link href="/">
                        <!-- Logo -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="50"
                            height="50"
                            viewBox="0 0 100 100"
                        >
                            <defs>
                                <linearGradient
                                    id="grad"
                                    x1="100%"
                                    y1="100%"
                                    x2="0%"
                                    y2="0%"
                                >
                                    <stop
                                        offset="0%"
                                        style="
                                            stop-color: #4f46e5;
                                            stop-opacity: 1;
                                        "
                                    />
                                    <stop
                                        offset="100%"
                                        style="
                                            stop-color: #9333ea;
                                            stop-opacity: 1;
                                        "
                                    />
                                </linearGradient>
                            </defs>
                            <rect
                                width="100"
                                height="100"
                                rx="20"
                                fill="url(#grad)"
                            />
                            <text
                                x="50%"
                                y="55%"
                                text-anchor="middle"
                                dominant-baseline="middle"
                                font-family="Arial, Helvetica, sans-serif"
                                font-size="50"
                                fill="white"
                                font-weight="bold"
                            >
                                LM
                            </text>
                        </svg>
                    </Link>
                    <p class="mt-1 text-indigo-200">
                        Discover conversations across the community
                    </p>
                </div>

                <div v-if="!auth.user" class="flex items-center gap-4">
                    <Link
                        href="/login"
                        class="rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-indigo-600 shadow-md transition duration-200 hover:bg-indigo-50"
                    >
                        Login
                    </Link>
                    <Link
                        href="/register"
                        class="rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-indigo-600 shadow-md transition duration-200 hover:bg-indigo-50"
                    >
                        Register
                    </Link>
                </div>

                <div v-else class="flex items-center gap-4">
                    <Link
                        href="/new-thread"
                        class="rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-indigo-600 shadow-md transition duration-200 hover:bg-indigo-50"
                    >
                        + New Thread
                    </Link>
                    <Link
                        href="/logout"
                        method="post"
                        class="cursor-pointer rounded-lg bg-red-500 px-4 py-2.5 text-sm font-medium text-white shadow-md transition duration-200 hover:bg-red-600"
                    >
                        Logout
                    </Link>
                </div>
            </div>
        </div>

        <div class="flex gap-6">
            <!-- Left sidebar -->
            <aside class="hidden w-72 shrink-0 lg:block">
                <div class="sticky top-6 space-y-6">
                    <div
                        class="rounded-lg bg-gradient-to-br from-violet-50 to-violet-100 p-4 shadow-sm"
                    >
                        <h3 class="mb-3 text-lg font-semibold text-violet-800">
                            Categories
                        </h3>
                        <ul class="space-y-2">
                            <li v-for="cat in categories" :key="cat.id">
                                <button
                                    class="w-full rounded-md bg-white/50 px-3 py-2.5 text-left transition duration-200 hover:bg-white hover:shadow-sm"
                                >
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <span
                                            class="text-md font-medium text-violet-900"
                                            >{{ cat.name }}</span
                                        >
                                        <span
                                            class="rounded-full bg-violet-100 px-2 py-0.5 text-xs font-medium text-violet-700"
                                            >24</span
                                        >
                                    </div>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="rounded-lg bg-gradient-to-br from-emerald-50 to-emerald-100 p-4 shadow-sm"
                    >
                        <h3 class="mb-3 text-lg font-semibold text-emerald-800">
                            Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="tag in tags"
                                :key="tag"
                                class="rounded-full bg-white/70 px-3 py-1.5 text-sm font-medium text-emerald-700 shadow-sm transition duration-200 hover:bg-white hover:text-emerald-800 hover:shadow"
                            >
                                {{ tag.name }}
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main content / threads list -->
            <main class="flex-1">
                <!-- Mobile: show sidebar content above threads -->
                <div class="mb-6 space-y-3 lg:hidden">
                    <div
                        class="rounded-lg border bg-card bg-gradient-to-br from-violet-50 to-violet-100 p-4 shadow-sm"
                    >
                        <h3 class="text-md mb-3 font-semibold text-violet-800">
                            Categories
                        </h3>
                        <ul class="space-y-2">
                            <li v-for="cat in categories" :key="cat.id">
                                <button
                                    class="w-full rounded-md bg-white/50 px-3 py-2.5 text-left transition duration-200 hover:bg-white hover:shadow-sm"
                                >
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <span
                                            class="text-sm font-medium text-violet-900"
                                            >{{ cat.name }}</span
                                        >
                                        <span
                                            class="rounded-full bg-violet-100 px-2 py-0.5 text-xs font-medium text-violet-700"
                                            >{{ cat.count }}</span
                                        >
                                    </div>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="rounded-lg border bg-card bg-gradient-to-br from-emerald-50 to-emerald-100 p-4 shadow-sm"
                    >
                        <h3 class="text-md mb-3 font-semibold text-emerald-800">
                            Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="tag in tags"
                                :key="tag"
                                class="rounded-full bg-white/70 px-3 py-1.5 text-sm font-medium text-emerald-700 shadow-sm transition duration-200 hover:bg-white hover:text-emerald-800 hover:shadow"
                            >
                                {{ tag }}
                            </button>
                        </div>
                    </div>
                </div>

                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        auth: {
            type: Array,
        },
        categories: {
            type: Array,
        },
        tags: {
            type: Array,
        },
    },
    components: {
        Link,
    },
    mounted() {
        console.log(this.tags);
    },
};
</script>

<style scoped>
/* Intentionally minimal — styling is primarily via Tailwind and the project's theme variables. */
</style>
