<template>
  <div class="min-h-screen bg-[#050505] text-white flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-cyan-500/20 blur-[100px] rounded-full"></div>
    </div>

    <!-- Login Card -->
    <div class="w-full max-w-md relative z-10">
      <div class="p-10 rounded-[40px] bg-white/5 border border-white/10 backdrop-blur-xl shadow-2xl relative overflow-hidden">
        <!-- Top glow -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600"></div>

        <div class="text-center mb-8">
          <h2 class="text-3xl font-black mb-2">Admin <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-500">Access</span></h2>
          <p class="text-gray-400 text-sm">Please authenticate to continue</p>
        </div>

        <form @submit.prevent="handleLogin" class="space-y-6">
          <div v-if="errorMsg" class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold text-center">
            {{ errorMsg }}
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Username</label>
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <input 
                v-model="username" 
                type="text" 
                required
                class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-sm focus:border-cyan-500/50 outline-none transition-all placeholder:text-gray-600"
                placeholder="Enter username"
              >
            </div>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Password</label>
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input 
                v-model="password" 
                type="password" 
                required
                class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-sm focus:border-cyan-500/50 outline-none transition-all placeholder:text-gray-600"
                placeholder="Enter password"
              >
            </div>
          </div>

          <button 
            type="submit" 
            class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 text-white font-black uppercase tracking-widest text-xs hover:scale-105 active:scale-95 transition-all shadow-lg shadow-cyan-500/30 mt-4"
          >
            Authenticate
          </button>
        </form>

        <div class="mt-6 text-center">
          <router-link to="/" class="text-xs text-gray-500 hover:text-white transition-all underline underline-offset-4">Return to Portfolio</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const username = ref('');
const password = ref('');
const errorMsg = ref('');

const handleLogin = () => {
    const adminAuth = JSON.parse(localStorage.getItem('admin_credentials')) || {
        username: 'Dev_Joms',
        password: 'Tsuitachi_01'
    };

    if (username.value === adminAuth.username && password.value === adminAuth.password) {
        sessionStorage.setItem('admin_auth', 'true');
        router.push('/admin');
    } else {
        errorMsg.value = 'Invalid username or password.';
    }
};
</script>
