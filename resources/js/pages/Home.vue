<template>
    <!-- Nav / Tabs -->
    <nav class="mb-6 flex items-center justify-between">
        <div>
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
        </div>
        <div>
            <input
                v-model="query"
                type="search"
                placeholder="Search threads"
                class="w-64 rounded-lg border-0 bg-white px-4 py-2.5 text-sm font-bold text-indigo-500 placeholder-indigo-400 backdrop-blur-sm transition duration-200 focus:bg-white focus:ring-2 focus:ring-white focus:outline-none"
            />
        </div>
    </nav>

    <!-- scrollbar-hide is custom class from app.css -->
    <div class="scrollbar-hide h-170 space-y-4 overflow-auto">
        <article
            v-for="thread in filteredThreads"
            :key="thread.id"
            class="group relative overflow-hidden rounded-xl bg-white p-5 shadow-sm transition duration-200 hover:shadow-lg"
        >
            <div class="">
                <div class="mb-3 flex items-center gap-4">
                    <Link
                        :href="'/threads/' + thread.id"
                        class="text-xl font-semibold text-gray-900"
                    >
                        {{ thread.title }}
                    </Link>
                    <span class="p-1 text-sm text-gray-500">
                        {{ moment(thread.created_at).fromNow() }}
                    </span>
                </div>
                <p
                    class="text-md mb-4 line-clamp-2 leading-relaxed text-gray-600"
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
                        class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700"
                    >
                        vue
                    </span>
                    <span
                        class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700"
                    >
                        php
                    </span>
                    <span
                        class="rounded-full bg-violet-100 px-3 py-1 text-sm font-medium text-violet-700"
                    >
                        {{ thread.category?.name }}
                    </span>
                </div>
                <div class="mt-4 flex items-center gap-6 text-right">
                    <div class="text-sm font-medium text-gray-500">
                        by {{ thread.user?.name }}
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
</template>

<script>
import { Link } from '@inertiajs/vue3';
import moment from 'moment';

export default {
    components: {
        Link,
    },
    props: {
        threads: {
            type: Array,
        },
    },
    data() {
        return {
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
    methods: {
        moment,
    },
};
</script>

<style scoped>
/* Intentionally minimal — styling is primarily via Tailwind and the project's theme variables. */
</style>
