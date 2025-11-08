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
                    <div class="relative"></div>
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

                <slot />
            </main>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [
                { id: 1, name: 'General', count: 124 },
                { id: 2, name: 'Announcements', count: 12 },
                { id: 3, name: 'Help', count: 54 },
                { id: 4, name: 'Off-topic', count: 23 },
            ],

            tags: ['vue', 'laravel', 'javascript', 'css', 'design', 'help'],
        };
    },
};
</script>

<style scoped>
/* Intentionally minimal — styling is primarily via Tailwind and the project's theme variables. */
</style>
