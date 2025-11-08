<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="50"
        height="50"
        viewBox="0 0 100 100"
    >
        <defs>
            <linearGradient id="grad" x1="100%" y1="100%" x2="0%" y2="0%">
                <stop
                    offset="0%"
                    style="stop-color: #4f46e5; stop-opacity: 1"
                />
                <stop
                    offset="100%"
                    style="stop-color: #9333ea; stop-opacity: 1"
                />
            </linearGradient>
        </defs>
        <rect width="100" height="100" rx="20" fill="url(#grad)" />
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
</template>
