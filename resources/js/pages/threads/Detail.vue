<script setup>
import { Button } from '@/components/ui/button';
import { ref } from 'vue';

const { thread } = defineProps({
    thread: Array,
});

const newReply = ref('');
const isSubmitting = ref(false);

function submitReply() {
    isSubmitting.value = true;
    // Simulate API call
    setTimeout(() => {
        const reply = {
            id: replies.value.length + 1,
            body: newReply.value,
            created_at: new Date().toISOString(),
            author: {
                id: 999,
                name: 'Current User',
                avatar: 'https://api.dicebear.com/7.x/avatars/svg?seed=current',
                joined: 'Member since Nov 2025',
                posts: 1,
            },
            likes: 0,
        };
        replies.value.push(reply);
        newReply.value = '';
        isSubmitting.value = false;
    }, 500);
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
}
</script>

<template>
    <div class="scrollbar-hide mx-auto h-190 max-w-5xl overflow-auto px-4">
        <!-- Thread Header -->
        <div class="mb-5 space-y-4">
            <div class="flex items-center space-x-4">
                <span
                    class="rounded-full bg-violet-100 px-3 py-1 text-sm font-medium text-violet-800"
                >
                    {{ thread.category?.name }}
                </span>
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <span>20 views</span>
                    <span>•</span>
                    <span>15 likes</span>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-gray-900">
                {{ thread.title }}
            </h1>

            <div class="flex flex-wrap gap-2">
                <!-- <span
                    v-for="tag in thread.tags"
                    :key="tag"
                    class="rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-600"
                >
                    {{ tag }}
                </span> -->
                <span
                    class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700"
                >
                    vue
                </span>
            </div>
        </div>

        <!-- Main Thread Content -->
        <div class="mb-8 rounded-xl border bg-white shadow-sm">
            <div class="flex gap-2 p-6">
                <!-- Thread Content -->
                <div class="flex-1">
                    <div class="prose max-w-none">
                        {{ thread.body }}
                    </div>

                    <div
                        class="mt-6 flex items-center justify-between border-t pt-4"
                    >
                        <!-- Author Info -->
                        <div class="font-medium text-gray-500">
                            Author - {{ thread.user?.name }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Posted {{ formatDate(thread.created_at) }}
                        </div>
                        <div class="flex items-center space-x-4">
                            <Button
                                variant="outline"
                                class="cursor-pointer text-sm"
                            >
                                <span class="mr-1">👍</span> Like
                            </Button>
                            <Button
                                variant="outline"
                                class="cursor-pointer text-sm"
                            >
                                Share
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reply Form -->
        <div class="rounded-xl border bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">
                Post a Reply
            </h3>

            <form @submit.prevent="submitReply">
                <textarea
                    v-model="newReply"
                    rows="4"
                    required
                    class="mb-4 block w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 placeholder-gray-400 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none"
                    placeholder="Write your reply here..."
                ></textarea>

                <div class="flex justify-end">
                    <Button
                        type="submit"
                        :disabled="isSubmitting"
                        class="rounded-lg bg-violet-600 px-6 py-2.5 text-white hover:bg-violet-700 focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:outline-none"
                    >
                        {{ isSubmitting ? 'Posting...' : 'Post Reply' }}
                    </Button>
                </div>
            </form>
        </div>
    </div>
</template>
