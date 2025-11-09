<script setup>
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const { categories, tags, errors } = defineProps({
    categories: Array,
    tags: Array,
    errors: Object,
});

const selectedTag = ref('');

const form = ref(
    useForm({
        title: '',
        body: '',
        category_id: '',
        tags: [],
    }),
);

function addTag() {
    if (selectedTag.value && !form.value.tags.includes(selectedTag.value)) {
        form.value.tags.push(selectedTag.value);
    }
    selectedTag.value = '';
}

function removeTag(tag) {
    form.value.tags = form.value.tags.filter((t) => t !== tag);
}

function createThread() {
    // Handle form submission here
    form.value.post('/createThread');
}
</script>

<template>
    <div class="mx-auto max-w-4xl px-4">
        <!-- Form Card -->
        <div class="space-y-8 rounded-xl border bg-white p-6 shadow-sm">
            <!-- Header -->
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Create New Thread
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Share your thoughts, questions, or ideas with the community
                </p>
            </div>

            <!-- Form -->
            <form @submit.prevent="createThread" class="space-y-6">
                <!-- Title -->
                <div>
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Thread Title
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none"
                        placeholder="What would you like to discuss?"
                    />
                    <p v-if="errors.title" class="mt-1 text-sm text-red-500">
                        {{ errors.title }}
                    </p>
                </div>

                <!-- Category -->
                <div>
                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Category
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="category"
                        v-model="form.category_id"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none"
                    >
                        <option value="" disabled>Select a category</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <p
                        v-if="errors.category_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ errors.category_id }}
                    </p>
                </div>

                <!-- Selected Tags -->
                <div class="mt-2 flex flex-wrap gap-2">
                    <span
                        v-for="tag in form.tags"
                        :key="tag.id"
                        class="inline-flex items-center rounded-full bg-violet-50 px-3 py-1 text-sm font-medium text-violet-700"
                    >
                        {{ tag.name }}
                        <button
                            type="button"
                            @click="removeTag(tag)"
                            class="ml-1.5 inline-flex h-4 w-4 items-center justify-center rounded-full text-violet-400 hover:bg-violet-200 hover:text-violet-500"
                        >
                            ×
                        </button>
                    </span>
                </div>
                <!-- Tags -->
                <div>
                    <label
                        for="tags"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Tags
                    </label>
                    <div
                        class="mt-1 flex rounded-lg border border-gray-300 focus-within:border-violet-500 focus-within:ring-2 focus-within:ring-violet-500/20"
                    >
                        <select
                            id="tags"
                            v-model="selectedTag"
                            @change="addTag"
                            class="block flex-1 border-0 bg-transparent py-2 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:outline-none"
                        >
                            <option value="" disabled>
                                Add tags to your thread
                            </option>
                            <option
                                v-for="tag in tags.filter(
                                    (t) => !form.tags.includes(t),
                                )"
                                :key="tag"
                                :value="tag"
                            >
                                {{ tag.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <label
                        for="body"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Thread Content
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="body"
                        v-model="form.body"
                        rows="8"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none"
                        placeholder="Write your thread content here..."
                    ></textarea>
                    <p v-if="errors.body" class="mt-1 text-sm text-red-500">
                        {{ errors.body }}
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <Button
                        type="button"
                        variant="outline"
                        class="rounded-lg px-4 py-2 text-sm font-medium"
                    >
                        Cancel
                    </Button>
                    <Button
                        type="submit"
                        class="rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white hover:bg-violet-700 focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:outline-none"
                    >
                        Create Thread
                    </Button>
                </div>
            </form>
        </div>
    </div>
</template>
