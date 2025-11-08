<template>
    <div class="mx-auto max-w-7xl p-4">
        <div
            class="mb-6 rounded-2xl bg-gradient-to-r from-violet-600 to-indigo-600 p-6 text-white shadow-lg"
        >
            <div class="flex items-center justify-between">
                <div>
                    <h1
                        class="bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-3xl font-bold text-transparent"
                    >
                        Forum
                    </h1>
                    <p class="mt-1 text-indigo-200">
                        Discover conversations across the community
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input
                            v-model="query"
                            type="search"
                            placeholder="Search threads"
                            class="w-64 rounded-lg border-0 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-indigo-200 backdrop-blur-sm transition duration-200 focus:bg-white/20 focus:ring-2 focus:ring-white/50 focus:outline-none"
                        />
                    </div>
                    <button
                        class="rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-indigo-600 shadow-md transition duration-200 hover:bg-indigo-50"
                    >
                        New Thread
                    </button>
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
                                            >{{ cat.count }}</span
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
                                {{ tag }}
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
                <!-- Nav / Tabs -->
                <nav class="mb-6 flex items-center gap-2">
                    <button
                        v-for="tab in tabs"
                        :key="tab.key"
                        @click="activeTab = tab.key"
                        :class="[
                            'cursor-pointer rounded-lg px-4 py-2 text-sm font-medium transition duration-200',
                            activeTab === tab.key
                                ? 'bg-violet-600 text-white shadow-md shadow-violet-600/25'
                                : 'bg-violet-50 text-violet-600 hover:bg-violet-100',
                        ]"
                    >
                        {{ tab.label }}
                    </button>
                </nav>

                <div class="space-y-4">
                    <article
                        v-for="thread in filteredThreads"
                        :key="thread.id"
                        class="group relative overflow-hidden rounded-xl bg-white p-5 shadow-sm transition duration-200 hover:shadow-lg"
                    >
                        <div class="">
                            <div class="mb-3 flex items-center gap-4">
                                <h2 class="text-lg font-semibold text-gray-900">
                                    {{ thread.title }}
                                </h2>
                                <span class="p-1 text-sm text-gray-500">
                                    2 hours ago
                                </span>
                            </div>
                            <p
                                class="mb-4 text-sm leading-relaxed text-gray-600"
                            >
                                {{ thread.body }}
                            </p>

                            <div class="flex flex-wrap items-center gap-3">
                                <!-- <span
                                    v-for="tag in thread.tags"
                                    :key="tag"
                                    class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700"
                                >
                                    {{ tag }}
                                </span> -->
                                <span
                                    class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700"
                                >
                                    vue
                                </span>
                                <span
                                    class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700"
                                >
                                    php
                                </span>
                                <!-- <span
                                    class="rounded-full bg-violet-100 px-3 py-1 text-xs font-medium text-violet-700"
                                >
                                    {{ thread.category }}
                                </span> -->
                                <span
                                    class="rounded-full bg-violet-100 px-3 py-1 text-xs font-medium text-violet-700"
                                >
                                    General
                                </span>
                            </div>
                            <div
                                class="mt-4 flex items-center gap-6 text-right"
                            >
                                <div class="text-xs font-medium text-gray-500">
                                    by Leo Max
                                </div>

                                <div
                                    class="flex cursor-pointer items-center gap-2 text-xs font-bold text-gray-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="20"
                                        height="20"
                                        role="img"
                                        aria-label="Message"
                                    >
                                        <title>Message</title>
                                        <path
                                            fill="none"
                                            stroke="#4f39f6"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 15a2 2 0 0 1-2 2H8l-4 4V5a2 2 0 0 1 2-2h13a2 2 0 0 1 2 2z"
                                        />
                                    </svg>
                                    <span> 2k </span>
                                </div>
                                <div
                                    class="flex cursor-pointer items-center gap-2 text-xs font-bold text-gray-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                    >
                                        <g
                                            fill="none"
                                            stroke="#4f39f6"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path
                                                d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"
                                            />
                                            <circle cx="12" cy="12" r="3" />
                                        </g>
                                    </svg>
                                    <span>1.2k</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <div
                        v-if="filteredThreads.length === 0"
                        class="py-8 text-center text-muted-foreground"
                    >
                        No threads found.
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        threads: {
            type: Array,
        },
    },
    data() {
        return {
            categories: [
                { id: 1, name: 'General', count: 124 },
                { id: 2, name: 'Announcements', count: 12 },
                { id: 3, name: 'Help', count: 54 },
                { id: 4, name: 'Off-topic', count: 23 },
            ],

            tags: ['vue', 'laravel', 'javascript', 'css', 'design', 'help'],

            // threads: [
            //     {
            //         id: 1,
            //         title: 'Welcome to the forum — introduce yourself!',
            //         excerpt:
            //             'Say hi and tell us what projects you are working on. Be friendly and follow the rules.',
            //         category: 'General',
            //         tags: ['welcome', 'introductions'],
            //         replies: 34,
            //         author: 'Alice',
            //         created_at: '2025-11-01',
            //     },
            //     {
            //         id: 2,
            //         title: 'How to set up Laravel + Vite',
            //         excerpt:
            //             'Step-by-step guide for configuring Vite with Laravel, including HMR and asset pipeline tips.',
            //         category: 'Help',
            //         tags: ['laravel', 'vite', 'setup'],
            //         replies: 12,
            //         author: 'Bob',
            //         created_at: '2025-11-04',
            //     },
            //     {
            //         id: 3,
            //         title: 'Design critique: new forum home mockups',
            //         excerpt:
            //             'I reworked the homepage to be more focused on conversation discovery. Feedback welcome.',
            //         category: 'Design',
            //         tags: ['design', 'ui'],
            //         replies: 8,
            //         author: 'Carla',
            //         created_at: '2025-11-07',
            //     },
            // ],

            tabs: [
                { key: 'all', label: 'All' },
                { key: 'newest', label: 'Newest' },
                { key: 'popular', label: 'Popular' },
                { key: 'unanswered', label: 'Unanswered' },
            ],

            activeTab: 'all',
            query: '',
        };
    },
    computed: {
        filteredThreads() {
            let list = this.threads.slice();

            // Filter by tab
            if (this.activeTab === 'newest') {
                list.sort((a, b) => (a.created_at < b.created_at ? 1 : -1));
            } else if (this.activeTab === 'popular') {
                list.sort((a, b) => b.replies - a.replies);
            } else if (this.activeTab === 'unanswered') {
                list = list.filter((t) => t.replies === 0);
            }

            // Simple query filter
            if (this.query.trim()) {
                const q = this.query.toLowerCase();
                list = list.filter(
                    (t) =>
                        t.title.toLowerCase().includes(q) ||
                        t.body.toLowerCase().includes(q),
                );
            }

            return list;
        },
    },
};
</script>

<style scoped>
/* Intentionally minimal — styling is primarily via Tailwind and the project's theme variables. */
</style>
