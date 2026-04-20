<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 text-white">
        <div class="text-center p-8 bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 animate-fade-in">
            <h1 class="text-5xl font-extrabold mb-4 bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                Vue + Tailwind CSS
            </h1>
            <p class="text-gray-400 text-lg mb-6">Successfully set up in your Laravel project!</p>
            <div class="flex gap-4 justify-center">
                <button @click="count++" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 transition-colors rounded-lg font-semibold">
                    Count is: {{ count }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const count = ref(0);
</script>

<style scoped>
.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
