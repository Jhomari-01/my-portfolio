<template>
  <div class="flex h-screen bg-[#050505] text-white font-sans overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-[#0a0a0a] border-r border-white/5 flex flex-col pt-8 pb-6 relative z-10 transition-all flex-shrink-0">
      <!-- Ambient Glow -->
      <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-cyan-500/5 via-transparent to-indigo-500/5 pointer-events-none"></div>
      
      <div class="px-8 mb-10 relative">
        <h1 class="text-3xl font-black tracking-tighter mb-1">Admin <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-500">Panel</span></h1>
        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em]">Dashboard V2.0</p>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-4 space-y-2 overflow-y-auto scroll-hide relative">
        <button 
          v-for="menu in menus" 
          :key="menu.id"
          @click="activeTab = menu.id"
          :class="[
            'w-full flex items-center gap-4 px-5 py-3.5 rounded-2xl text-sm font-bold transition-all duration-300 relative group overflow-hidden',
            activeTab === menu.id 
              ? 'bg-gradient-to-r from-cyan-500/10 to-indigo-600/10 text-cyan-400 border border-cyan-500/20 shadow-lg shadow-cyan-500/5' 
              : 'text-gray-400 hover:bg-white/5 hover:text-white border border-transparent'
          ]"
        >
          <!-- Hover effect background -->
          <div v-if="activeTab !== menu.id" class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          
          <!-- Menu Icon -->
          <div class="w-5 h-5 flex-shrink-0 flex items-center justify-center relative z-10">
            <!-- Icons using predefined SVG string match -->
            <svg v-if="menu.icon === 'dashboard'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
            <svg v-else-if="menu.icon === 'works'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            <svg v-else-if="menu.icon === 'certs'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
            <svg v-else-if="menu.icon === 'stacks'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
            <svg v-else-if="menu.icon === 'resume'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
            <svg v-else-if="menu.icon === 'requests'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            <svg v-else-if="menu.icon === 'settings'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
          </div>
          
          <span class="relative z-10">{{ menu.label }}</span>
          
          <!-- Active Indicator -->
          <div v-if="activeTab === menu.id" class="absolute right-3 w-1.5 h-1.5 rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.8)] z-10 transition-all duration-300"></div>
        </button>
      </nav>

      <!-- Bottom Actions -->
      <div class="px-4 mt-auto pt-6 border-t border-white/5 space-y-3 relative">
        <router-link to="/" class="w-full flex items-center justify-center gap-3 px-4 py-3.5 rounded-2xl bg-white/5 border border-white/5 text-xs font-bold hover:bg-white/10 hover:border-white/10 transition-all group">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9 12 2l9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          View Portfolio
        </router-link>
        <button @click="logout" class="w-full flex items-center justify-center gap-3 px-4 py-3.5 rounded-2xl bg-red-500/5 border border-red-500/10 text-red-400 text-xs font-bold hover:bg-red-500/10 hover:border-red-500/20 transition-all group">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 lg:p-10 relative scroll-smooth bg-[#030303]">
      <div class="max-w-6xl mx-auto space-y-10 pb-20">
        
        <!-- Header Actions -->
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/5 border border-white/5 p-6 rounded-3xl backdrop-blur-xl sticky top-0 z-20">
          <div>
            <h2 class="text-2xl font-black capitalize tracking-tight">{{ activeMenuObj?.label || activeTab }}</h2>
            <p class="text-[12px] text-gray-500 font-medium">Manage and monitor your portfolio {{ activeMenuObj?.label?.toLowerCase() || activeTab.toLowerCase() }}</p>
          </div>
          <button v-if="['Works', 'Certs', 'Stacks', 'Resume', 'Settings'].includes(activeTab)" @click="activeTab === 'Resume' ? saveResume() : saveAll()" class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-cyan-500 to-indigo-600 text-xs font-black uppercase tracking-widest shadow-xl shadow-cyan-500/20 hover:scale-105 active:scale-95 transition-all text-white">
            Save Changes
          </button>
        </header>

        <!-- Dashboard View -->
        <div v-if="activeTab === 'Dashboard'" class="space-y-8 animate-fade-in">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-8 rounded-[32px] bg-gradient-to-br from-cyan-500/10 to-transparent border border-cyan-500/20 flex flex-col gap-6 relative overflow-hidden group">
               <div class="absolute -right-6 -top-6 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-all"></div>
               <div class="w-14 h-14 rounded-2xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center shadow-lg shadow-cyan-500/10">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
               </div>
               <div>
                 <p class="text-[10px] text-cyan-400/80 font-black uppercase tracking-[0.2em] mb-1">Total Works</p>
                 <h3 class="text-5xl font-black text-white">{{ works.length }}</h3>
               </div>
            </div>
            
            <div class="p-8 rounded-[32px] bg-gradient-to-br from-indigo-500/10 to-transparent border border-indigo-500/20 flex flex-col gap-6 relative overflow-hidden group">
               <div class="absolute -right-6 -top-6 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-all"></div>
               <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center shadow-lg shadow-indigo-500/10">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
               </div>
               <div>
                 <p class="text-[10px] text-indigo-400/80 font-black uppercase tracking-[0.2em] mb-1">Total Certs</p>
                 <h3 class="text-5xl font-black text-white">{{ certs.length }}</h3>
               </div>
            </div>
            
            <div class="p-8 rounded-[32px] bg-gradient-to-br from-emerald-500/10 to-transparent border border-emerald-500/20 flex flex-col gap-6 relative overflow-hidden group">
               <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
               <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shadow-lg shadow-emerald-500/10">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
               </div>
               <div>
                 <p class="text-[10px] text-emerald-400/80 font-black uppercase tracking-[0.2em] mb-1">Total Stacks</p>
                 <h3 class="text-5xl font-black text-white">{{ stacks.length }}</h3>
               </div>
            </div>
          </div>

          <!-- Resume Request Stats -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-[28px] bg-white/5 border border-white/5 flex flex-col gap-4 relative overflow-hidden group">
               <div class="flex items-center gap-4">
                 <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center border border-cyan-500/20">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                 </div>
                 <div>
                   <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Total Requests</p>
                   <h3 class="text-2xl font-black text-white">{{ requestCount }}</h3>
                 </div>
               </div>
            </div>

            <div class="p-6 rounded-[28px] bg-white/5 border border-white/5 flex flex-col gap-4 relative overflow-hidden group">
               <div class="flex items-center gap-4">
                 <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center border border-amber-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                 </div>
                 <div>
                   <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Pending</p>
                   <h3 class="text-2xl font-black text-amber-400">{{ pendingRequestCount }}</h3>
                 </div>
               </div>
            </div>

            <div class="p-6 rounded-[28px] bg-white/5 border border-white/5 flex flex-col gap-4 relative overflow-hidden group">
               <div class="flex items-center gap-4">
                 <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                 </div>
                 <div>
                   <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Accepted</p>
                   <h3 class="text-2xl font-black text-emerald-500">{{ acceptedRequestCount }}</h3>
                 </div>
               </div>
            </div>

            <div class="p-6 rounded-[28px] bg-white/5 border border-white/5 flex flex-col gap-4 relative overflow-hidden group">
               <div class="flex items-center gap-4">
                 <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-400 flex items-center justify-center border border-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                 </div>
                 <div>
                   <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Declined</p>
                   <h3 class="text-2xl font-black text-red-500">{{ declinedRequestCount }}</h3>
                 </div>
               </div>
            </div>
          </div>
          
          <!-- Recent Requests Section -->
          <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 hidden md:block">
            <div class="flex items-center justify-between mb-8">
              <h3 class="text-xl font-black flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center border border-indigo-500/20">
                  <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </div>
                Latest Pending Requests
              </h3>
              <button @click="activeTab = 'Requests'" class="text-[10px] font-black uppercase tracking-widest text-cyan-400 hover:text-cyan-300 transition-colors">View All Requests</button>
            </div>
            
            <div v-if="latestRequests.length === 0" class="flex flex-col items-center justify-center p-12 border border-dashed border-white/10 rounded-[28px] bg-white/[0.01]">
              <div class="w-16 h-16 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-400 mb-4">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              </div>
              <p class="text-sm text-gray-400 font-bold">All caught up!</p>
              <p class="text-[11px] text-gray-500 mt-1 uppercase tracking-widest">No pending resume requests to review.</p>
            </div>
            
            <div v-else class="space-y-4">
              <div v-for="request in latestRequests" :key="request.id" class="flex items-center justify-between p-5 rounded-2xl bg-[#0a0a0a] border border-white/5 hover:border-white/10 transition-all group">
                <div class="flex items-center gap-5 overflow-hidden">
                   <div class="w-12 h-12 rounded-xl bg-white/[0.03] border border-white/5 flex items-center justify-center text-gray-500 flex-shrink-0">
                      <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                   </div>
                   <div class="truncate">
                      <h4 class="text-sm font-bold text-white mb-1 truncate">{{ request.email }}</h4>
                      <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">{{ formatRequestDate(request.submitted_at || request.created_at) }}</p>
                   </div>
                </div>
                <div class="flex items-center gap-6">
                   <div class="hidden lg:block max-w-[200px] truncate">
                      <p class="text-[11px] text-gray-400 italic">"{{ request.purpose }}"</p>
                   </div>
                   <span :class="statusBadgeClass(request.status)">
                      {{ formatRequestStatus(request.status) }}
                   </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Management View (Works, Certs, Stacks) -->
        <div v-else-if="['Works', 'Certs', 'Stacks'].includes(activeTab)" class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in">
          <!-- List View -->
          <div class="lg:col-span-1 order-2 space-y-4 max-h-[70vh] overflow-y-auto pr-2 scroll-hide">
            <!-- Search Bar -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
              </div>
              <input 
                v-model="searchQuery" 
                type="text" 
                :placeholder="'Search ' + (activeMenuObj?.label?.toLowerCase() || '') + '...'"
                class="w-full bg-[#0a0a0a] border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)] text-white"
              >
            </div>

            <button @click="resetForm" class="w-full py-5 rounded-2xl border border-dashed border-white/20 text-xs font-black uppercase tracking-widest text-gray-500 hover:border-cyan-500/50 hover:text-cyan-400 hover:bg-cyan-500/5 transition-all">
              + Add New {{ activeTab.slice(0, -1) }}
            </button>

            <!-- Featured Badge (Works & Certs only) -->
            <div v-if="activeTab === 'Works' || activeTab === 'Certs'" class="flex items-center justify-between px-4 py-2.5 rounded-2xl bg-amber-500/5 border border-amber-500/20">
              <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                <span class="text-[10px] font-black uppercase tracking-widest text-amber-400">Showcase Featured</span>
              </div>
              <span :class="['text-[10px] font-black px-2 py-0.5 rounded-full', (activeTab === 'Works' ? featuredWorks : featuredCerts).length >= 3 ? 'bg-amber-500 text-black' : 'bg-amber-500/20 text-amber-400']">{{ (activeTab === 'Works' ? featuredWorks : featuredCerts).length }}/3</span>
            </div>

            <div v-if="filteredItems.length === 0" class="text-center py-12 border border-dashed border-white/10 rounded-3xl opacity-40">
              <p class="text-sm">No items found. <span v-if="searchQuery">Try a different search term.</span><span v-else>Add your first {{ activeTab.toLowerCase() }}!</span></p>
            </div>
            
            <div 
              v-for="item in filteredItems" 
              :key="item.id"
              @click="editItem(item)"
              :class="['p-5 rounded-2xl border transition-all cursor-pointer group flex items-center justify-between', selectedId === item.id ? 'bg-gradient-to-r from-cyan-500/10 to-indigo-600/10 border-cyan-500/40 shadow-lg shadow-cyan-500/5 text-white' : 'bg-white/5 border-white/5 text-gray-300 hover:bg-white/10 hover:border-white/10']"
            >
              <div class="flex items-center gap-4 overflow-hidden pr-2">
                <div :class="['w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors relative', selectedId === item.id ? 'bg-cyan-500/20 text-cyan-400' : 'bg-black/50 text-gray-500 group-hover:text-gray-300 group-hover:bg-white/5']">
                  <svg v-if="activeTab === 'Works'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                  <svg v-else-if="activeTab === 'Certs'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                  <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                  <!-- Featured Star Indicator -->
                  <span v-if="(activeTab === 'Works' && featuredWorks.includes(item.id)) || (activeTab === 'Certs' && featuredCerts.includes(item.id))" class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-amber-400 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 text-black" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  </span>
                </div>
                <div class="truncate">
                  <h3 class="font-bold text-sm truncate">{{ item.title || item.name }}</h3>
                  <p class="text-[10px] text-gray-500 uppercase tracking-widest font-black truncate mt-1">{{ activeTab === 'Works' ? item.stacks || 'No stacks' : activeTab === 'Certs' ? item.issuer : item.category }}</p>
                </div>
              </div>
              <div class="flex items-center gap-1 flex-shrink-0">
                <!-- Star / Feature Toggle (Works & Certs only) -->
                <button 
                  v-if="activeTab === 'Works' || activeTab === 'Certs'"
                  @click.stop="toggleFeatured(item)"
                  :title="isFeatured(item.id) ? 'Remove from showcase' : 'Feature in showcase'"
                  :class="[
                    'p-2 rounded-lg transition-all',
                    isFeatured(item.id)
                      ? 'text-amber-400 bg-amber-500/10 opacity-100'
                      : 'opacity-0 group-hover:opacity-100 text-gray-500 hover:text-amber-400 hover:bg-amber-500/10'
                  ]"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" :fill="isFeatured(item.id) ? 'currentColor' : 'none'" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </button>
                <button @click.stop="deleteItem(item.id)" class="p-2 opacity-0 group-hover:opacity-100 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Delete Item">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Editor View -->
          <div class="lg:col-span-2 order-1 bg-white/5 border border-white/5 rounded-[32px] p-8 lg:p-12 relative overflow-hidden h-fit">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600 opacity-50"></div>
            
            <div class="flex items-center gap-3 mb-8">
              <div class="w-8 h-8 rounded-full bg-cyan-500/20 text-cyan-400 flex items-center justify-center">
                <svg v-if="selectedId" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                <svg v-else class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
              </div>
              <h2 class="text-2xl font-black">{{ selectedId ? 'Edit Item' : 'Create New' }}</h2>
            </div>
            
            <form @submit.prevent="handleSubmit" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Common Title/Name field -->
                <div class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">{{ activeTab === 'Stacks' ? 'Stack Name' : 'Title' }}</label>
                  <input 
                    v-model="form.title" 
                    type="text" 
                    required
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                    :placeholder="'Enter ' + (activeTab === 'Stacks' ? 'name' : 'title')"
                  >
                </div>

                <!-- Works & Certs: Link -->
                <div v-if="activeTab === 'Works' || activeTab === 'Certs'" class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">{{ activeTab === 'Works' ? 'Project Link' : 'Verification Link' }}</label>
                  <input 
                    v-model="form.link" 
                    type="text" 
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                    :placeholder="activeTab === 'Works' ? 'https://github.com/...' : 'https://verification.com/...'"
                  >
                </div>

                <!-- Works: GitHub Link -->
                <div v-if="activeTab === 'Works'" class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">GitHub Link</label>
                  <input 
                    v-model="form.github_link" 
                    type="text" 
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                    placeholder="https://github.com/username/repo"
                  >
                </div>

                <!-- Certs specific: Issuer -->
                <div v-if="activeTab === 'Certs'" class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Issuer</label>
                  <input 
                    v-model="form.issuer" 
                    type="text" 
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                    placeholder="e.g. Meta, Google, STI College"
                  >
                </div>

                <!-- Certs specific: Year Issued -->
                <div v-if="activeTab === 'Certs'" class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Year Issued</label>
                  <input 
                    v-model="form.year_issued" 
                    type="text" 
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                    placeholder="e.g. 2024"
                  >
                </div>

                <!-- Stacks specific: Category -->
                <div v-if="activeTab === 'Stacks'" class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Category</label>
                  <select 
                    v-model="form.category" 
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)] appearance-none cursor-pointer"
                  >
                    <option value="Frontend">Frontend</option>
                    <option value="Backend">Backend</option>
                    <option value="Tools">Tools</option>
                  </select>
                </div>

                <!-- Works specific: Stacks -->
                <div v-if="activeTab === 'Works'" class="space-y-2 md:col-span-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Stacks (comma separated)</label>
                  <input 
                    v-model="form.stacks" 
                    type="text" 
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                    placeholder="Vue.js, Laravel, Tailwind"
                  >
                </div>

                <!-- Common: Description -->
                <div v-if="activeTab === 'Works'" class="space-y-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Summary Description</label>
                  <textarea 
                    v-model="form.summary" 
                    rows="2"
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all resize-none"
                    placeholder="A very short 1-2 sentence hook..."
                  ></textarea>
                </div>

                <div v-if="activeTab !== 'Stacks'" class="space-y-2" :class="activeTab === 'Works' ? '' : 'md:col-span-2'">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Full Description (Overview)</label>
                  <textarea 
                    v-model="form.description" 
                    rows="5"
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all resize-none"
                    placeholder="Tell the full story of the project..."
                  ></textarea>
                </div>

                <div v-if="activeTab === 'Works'" class="space-y-2 md:col-span-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Key Features (One per line)</label>
                  <textarea 
                    v-model="form.features" 
                    rows="4"
                    class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all resize-none"
                    placeholder="Feature 1&#10;Feature 2&#10;Feature 3"
                  ></textarea>
                </div>

                <!-- Global Upload Progress Tracker -->
                <div v-if="currentUploads.length > 0" class="md:col-span-2 space-y-3 mb-4 animate-fade-in">
                  <div v-for="upload in currentUploads" :key="upload.id" class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                       <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded-lg bg-cyan-500/20 flex items-center justify-center text-cyan-400">
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                          </div>
                          <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white truncate max-w-[200px]">{{ upload.name }}</p>
                            <p class="text-[8px] text-gray-500 font-bold uppercase tracking-widest">{{ upload.size }} • {{ upload.progress }}% Complete</p>
                          </div>
                       </div>
                    </div>
                    <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden">
                       <div 
                         class="h-full bg-gradient-to-r from-cyan-500 to-indigo-600 transition-all duration-300"
                         :style="{ width: upload.progress + '%' }"
                       ></div>
                    </div>
                  </div>
                </div>

                <!-- Works: Multiple File Upload (Video, Images) -->
                <div v-if="activeTab === 'Works'" class="space-y-3 md:col-span-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Project Media (Multiple Video & Images)</label>
                  <div 
                    class="relative border-2 border-dashed border-white/10 rounded-2xl p-8 transition-all hover:bg-white/5 group cursor-pointer"
                    @click="$refs.worksFile.click()"
                  >
                    <input 
                      type="file" 
                      ref="worksFile" 
                      multiple 
                      accept="image/jpeg,image/png,video/mp4,video/webm" 
                      class="hidden" 
                      @change="(e) => handleFileUpload(e, 'works')"
                    >
                    <div class="flex flex-col items-center gap-2 text-gray-500 group-hover:text-cyan-400">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                      <span class="text-[10px] font-black uppercase tracking-widest">Click to upload media</span>
                    </div>
                  </div>

                  <!-- Works File Previews -->
                  <div v-if="form.files.length > 0" class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4">
                    <div 
                      v-for="(file, index) in form.files" 
                      :key="index" 
                      class="relative aspect-video rounded-xl bg-black overflow-hidden border border-white/10 group"
                    >
                      <img v-if="file.type.startsWith('image/')" :src="file.data" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity" />
                      <video v-else-if="file.type.startsWith('video/')" :src="file.data" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity"></video>
                      <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-2">
                        <p class="text-[8px] truncate font-bold text-white/50">{{ file.name }}</p>
                      </div>
                      <button 
                        @click.stop="removeFile(index)" 
                        type="button"
                        class="absolute top-1 right-1 p-1 bg-red-500 rounded-lg text-white opacity-0 group-hover:opacity-100 transition-opacity hover:scale-110"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Certs: File Upload (Image, PDF) -->
                <div v-if="activeTab === 'Certs'" class="space-y-3 md:col-span-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Certificate File (PNG, JPEG, or PDF)</label>
                  <div 
                    class="relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:bg-white/5 group cursor-pointer flex items-center gap-4"
                    @click="$refs.certsFile.click()"
                  >
                    <input 
                      type="file" 
                      ref="certsFile" 
                      accept="image/png,image/jpeg,application/pdf" 
                      class="hidden" 
                      @change="(e) => handleFileUpload(e, 'certs')"
                    >
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500 group-hover:text-black transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div>
                      <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Click to upload document</p>
                      <p v-if="form.cert_file" class="text-[9px] text-gray-500 mt-1">Uploaded: {{ form.cert_file.name }}</p>
                    </div>
                    <button v-if="form.cert_file" @click.stop="form.cert_file = null" type="button" class="ml-auto text-red-500 hover:text-red-400">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                  </div>
                </div>

                <!-- Stacks: Logo Upload (PNG/JPG) -->
                <div v-if="activeTab === 'Stacks'" class="space-y-3 md:col-span-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Stack Logo (PNG preferred)</label>
                  <div 
                    class="relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:bg-white/5 group cursor-pointer flex items-center gap-4"
                    @click="$refs.stacksFile.click()"
                  >
                    <input 
                      type="file" 
                      ref="stacksFile" 
                      accept="image/png,image/jpeg" 
                      class="hidden" 
                      @change="(e) => handleFileUpload(e, 'stacks')"
                    >
                    <div class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500 group-hover:text-black transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    </div>
                    <div>
                      <p class="text-[10px] font-black uppercase tracking-widest text-cyan-400">Click to upload brand logo</p>
                      <p v-if="form.image && form.image.includes('images/')" class="text-[9px] text-gray-500 mt-1">Brand logo active</p>
                    </div>
                    <div v-if="form.image" class="ml-auto w-12 h-12 bg-black rounded-lg border border-white/10 p-1">
                       <img :src="form.image" class="w-full h-full object-contain" />
                    </div>
                  </div>
                </div>

                <!-- Common: Image URL (Main Display/Hero) -->
                <div class="space-y-2 md:col-span-2">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">{{ activeTab === 'Stacks' ? 'Alternative Logo URL' : 'Hero Image URL (Primary Display)' }}</label>
                  <div class="flex flex-col sm:flex-row gap-4">
                    <input 
                      v-model="form.image" 
                      type="text" 
                      class="flex-1 bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all focus:shadow-[0_0_15px_rgba(34,211,238,0.1)]"
                      placeholder="e.g. /images/logo.png"
                    >
                    <div v-if="form.image" class="w-16 h-12 bg-[#0a0a0a] rounded-xl border border-white/10 p-1 flex-shrink-0">
                      <img :src="form.image" alt="Preview" class="w-full h-full object-cover rounded-lg opacity-80" @error="(e) => e.target.style.display='none'">
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex flex-col-reverse sm:flex-row justify-end gap-4 mt-10 pt-8 border-t border-white/5">
                <button 
                  type="button"
                  @click="resetForm" 
                  class="px-8 py-4 rounded-xl border border-white/10 text-xs font-bold text-gray-400 hover:text-white hover:bg-white/5 transition-all text-center"
                >
                  Clear Form
                </button>
                <button 
                  type="submit" 
                  class="px-12 py-4 rounded-xl bg-cyan-500 text-black text-xs font-black uppercase tracking-[0.1em] hover:bg-cyan-400 transition-all shadow-[0_0_20px_rgba(34,211,238,0.2)] hover:shadow-[0_0_25px_rgba(34,211,238,0.4)] hover:-translate-y-0.5 text-center"
                >
                  {{ selectedId ? 'Update Item' : 'Add Item' }}
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Resume Editor View -->
        <div v-else-if="activeTab === 'Resume'" class="space-y-8 animate-fade-in pb-12 mt-4">
          <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 items-start">
            <!-- Left Column: Basic Info & Personal Info -->
            <div class="space-y-8 w-full">
              <!-- Basic Information -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600 opacity-50"></div>
                <h3 class="text-xl font-black mb-6">Basic Information</h3>
                
                <!-- Profile Image Uploads (Light & Dark) -->
                <div class="mb-10">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 block mb-6">Profile Photos (Dual Mode)</label>
                  
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Light Mode Photo -->
                    <div class="space-y-4">
                      <p class="text-[9px] font-black uppercase tracking-widest text-cyan-400/80">Light Mode Version</p>
                      <div class="flex items-center gap-5 p-4 rounded-3xl bg-white/[0.03] border border-white/5 hover:border-cyan-500/20 transition-all">
                        <div class="w-20 h-20 rounded-2xl bg-white border border-gray-200 overflow-hidden relative group/img-light cursor-pointer" @click="$refs.profileLightInput.click()">
                          <img v-if="resumeData.basicInfo.profileImageLight" :src="resumeData.basicInfo.profileImageLight" class="w-full h-full object-cover transition-transform group-hover/img-light:scale-110" />
                          <div v-else class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v8"/><path d="m16 6-4 4-4-4"/><rect width="20" height="8" x="2" y="14" rx="2"/></svg>
                          </div>
                          <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/img-light:opacity-100 transition-opacity flex items-center justify-center">
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                          </div>
                          <input type="file" ref="profileLightInput" accept="image/*" class="hidden" @change="(e) => handleFileUpload(e, 'resume-profile-light')" />
                        </div>
                        <div class="flex-1 min-w-0">
                          <button v-if="resumeData.basicInfo.profileImageLight" @click="resumeData.basicInfo.profileImageLight = ''" class="text-[9px] font-black uppercase tracking-widest text-red-400 hover:text-red-300 transition-colors mb-1 block">Remove</button>
                          <button @click="$refs.profileLightInput.click()" class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-cyan-400 transition-colors truncate">
                            {{ resumeData.basicInfo.profileImageLight ? 'Change Photo' : 'Upload Light' }}
                          </button>
                        </div>
                      </div>
                    </div>

                    <!-- Dark Mode Photo -->
                    <div class="space-y-4">
                      <p class="text-[9px] font-black uppercase tracking-widest text-indigo-400/80">Dark Mode Version</p>
                      <div class="flex items-center gap-5 p-4 rounded-3xl bg-white/[0.03] border border-white/5 hover:border-indigo-500/20 transition-all">
                        <div class="w-20 h-20 rounded-2xl bg-[#0a0a0a] border border-white/10 overflow-hidden relative group/img-dark cursor-pointer" @click="$refs.profileDarkInput.click()">
                          <img v-if="resumeData.basicInfo.profileImageDark" :src="resumeData.basicInfo.profileImageDark" class="w-full h-full object-cover transition-transform group-hover/img-dark:scale-110 border border-white/5" />
                          <div v-else class="w-full h-full flex flex-col items-center justify-center text-gray-600">
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v8"/><path d="m16 6-4 4-4-4"/><rect width="20" height="8" x="2" y="14" rx="2"/></svg>
                          </div>
                          <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/img-dark:opacity-100 transition-opacity flex items-center justify-center">
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                          </div>
                          <input type="file" ref="profileDarkInput" accept="image/*" class="hidden" @change="(e) => handleFileUpload(e, 'resume-profile-dark')" />
                        </div>
                        <div class="flex-1 min-w-0">
                          <button v-if="resumeData.basicInfo.profileImageDark" @click="resumeData.basicInfo.profileImageDark = ''" class="text-[9px] font-black uppercase tracking-widest text-red-400 hover:text-red-300 transition-colors mb-1 block">Remove</button>
                          <button @click="$refs.profileDarkInput.click()" class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-indigo-400 transition-colors truncate">
                            {{ resumeData.basicInfo.profileImageDark ? 'Change Photo' : 'Upload Dark' }}
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- PDF Resume Upload -->
                <div class="mt-8 pt-8 border-t border-white/5">
                  <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 block mb-4">Resume PDF Document</label>
                  <div 
                    class="relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:bg-white/5 group cursor-pointer flex items-center gap-4"
                    @click="$refs.resumePdfInput.click()"
                  >
                    <input 
                      type="file" 
                      ref="resumePdfInput" 
                      accept="application/pdf" 
                      class="hidden" 
                      @change="(e) => handleFileUpload(e, 'resume-pdf')"
                    >
                    <div class="w-12 h-12 bg-red-500/10 rounded-xl flex items-center justify-center text-red-400 group-hover:bg-red-500 group-hover:text-black transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div>
                      <p class="text-[10px] font-black uppercase tracking-widest text-red-400">Click to upload Resume PDF</p>
                      <p v-if="resumeData.basicInfo.resumePdf" class="text-[9px] text-gray-500 mt-1">Status: Document Uploaded Successfully</p>
                    </div>
                    <div v-if="resumeData.basicInfo.resumePdf" class="ml-auto flex items-center gap-2">
                       <a :href="resumeData.basicInfo.resumePdf" target="_blank" class="p-2 bg-white/5 rounded-lg hover:bg-white/10 transition-colors" @click.stop>
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                       </a>
                       <button @click.stop="resumeData.basicInfo.resumePdf = ''" class="p-2 bg-white/5 rounded-lg hover:bg-red-500/20 transition-colors">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                       </button>
                    </div>
                  </div>
                </div>

                <div class="space-y-4 mt-8">
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Full Name</label>
                    <input v-model="resumeData.basicInfo.name" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Address</label>
                    <input v-model="resumeData.basicInfo.address" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                      <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Contact #</label>
                      <input v-model="resumeData.basicInfo.contact" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-cyan-500/50 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                      <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Email Address</label>
                      <input v-model="resumeData.basicInfo.email" type="email" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-cyan-500/50 outline-none transition-all">
                    </div>
                  </div>
                </div>
              </div>

              <!-- Career Objective -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-50"></div>
                <h3 class="text-xl font-black mb-6">Career Objective</h3>
                <textarea v-model="resumeData.careerObjective" rows="4" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-indigo-500/50 outline-none transition-all resize-none"></textarea>
              </div>

              <!-- Personal Information -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-600 opacity-50"></div>
                <h3 class="text-xl font-black mb-6">Personal Information</h3>
                <div class="grid grid-cols-2 gap-4 gap-y-6">
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Age</label>
                    <input v-model="resumeData.personalInfo.age" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-purple-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Date of Birth</label>
                    <input v-model="resumeData.personalInfo.dob" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-purple-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Sex</label>
                    <input v-model="resumeData.personalInfo.sex" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-purple-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Citizenship</label>
                    <input v-model="resumeData.personalInfo.citizenship" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-purple-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Civil Status</label>
                    <input v-model="resumeData.personalInfo.civilStatus" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-purple-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Religion</label>
                    <input v-model="resumeData.personalInfo.religion" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-3 text-sm focus:border-purple-500/50 outline-none transition-all">
                  </div>
                </div>
              </div>
              
              <!-- Character References (Moved from right) -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-rose-600 opacity-50"></div>
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-xl font-black">Character References</h3>
                  <button @click="addReference" class="text-xs font-bold text-red-400 hover:text-red-300 bg-red-500/10 px-4 py-2 rounded-xl transition-all">+ Add</button>
                </div>
                <div class="space-y-4">
                  <div v-for="(ref, index) in resumeData.references" :key="index" class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-5 relative group">
                    <button @click="resumeData.references.splice(index, 1)" class="absolute top-4 right-4 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                    <input v-model="ref.name" placeholder="Name" class="w-[90%] bg-transparent text-sm font-black tracking-wide text-red-400 outline-none mb-3 block" />
                    <input v-model="ref.position" placeholder="Position" class="w-[90%] bg-transparent font-bold outline-none mb-2 text-base block focus:text-white transition-colors" />
                    <input v-model="ref.company" placeholder="Company Name" class="w-[90%] bg-transparent text-gray-400 text-sm outline-none mb-3 block" />
                    <div class="flex flex-col sm:flex-row gap-3">
                       <input v-model="ref.email" placeholder="Email" class="w-full sm:w-1/2 bg-white/5 px-3 py-2 rounded-lg text-gray-300 text-xs outline-none focus:bg-white/10 transition-colors" />
                       <input v-model="ref.contact" placeholder="Contact #" class="w-full sm:w-1/2 bg-white/5 px-3 py-2 rounded-lg text-gray-300 text-xs outline-none focus:bg-white/10 transition-colors" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column: Lists -->
            <div class="space-y-8 w-full">
              
              <!-- Educational Background -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-500 to-teal-600 opacity-50"></div>
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-xl font-black">Educational Background</h3>
                  <button @click="addEducation" class="text-xs font-bold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 px-4 py-2 rounded-xl transition-all">+ Add</button>
                </div>
                <div class="space-y-4">
                  <div v-for="(edu, index) in resumeData.educationalBackground" :key="index" class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-5 relative group">
                    <button @click="resumeData.educationalBackground.splice(index, 1)" class="absolute top-4 right-4 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                    <input v-model="edu.level" placeholder="Level (e.g. Tertiary)" class="w-[90%] bg-transparent text-xs font-black uppercase tracking-wider text-emerald-400 outline-none mb-3 block" />
                    <input v-model="edu.school" placeholder="School Name" class="w-[90%] bg-transparent font-bold outline-none mb-2 text-base block focus:text-white transition-colors" />
                    <input v-model="edu.course" placeholder="Course / Degree" class="w-[90%] bg-transparent text-emerald-500/80 font-bold text-sm outline-none mb-2 block" />
                    <input v-model="edu.address" placeholder="Address" class="w-[90%] bg-transparent text-gray-400 text-sm outline-none mb-2 block" />
                    <input v-model="edu.year" placeholder="Year" class="w-[90%] bg-transparent text-gray-500 text-[10px] uppercase font-black tracking-widest outline-none block" />
                  </div>
                </div>
              </div>

              <!-- Work Experience -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-orange-600 opacity-50"></div>
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-xl font-black">Work Experience</h3>
                  <button @click="addWorkExp" class="text-xs font-bold text-amber-400 hover:text-amber-300 bg-amber-500/10 px-4 py-2 rounded-xl transition-all">+ Add</button>
                </div>
                <div class="space-y-4">
                  <div v-for="(exp, index) in resumeData.workExperience" :key="index" class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-5 relative group">
                    <button @click="resumeData.workExperience.splice(index, 1)" class="absolute top-4 right-4 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                    <input v-model="exp.company" placeholder="Company Name" class="w-[90%] bg-transparent text-sm font-black tracking-wide text-amber-400 outline-none mb-3 block" />
                    <input v-model="exp.position" placeholder="Position" class="w-[90%] bg-transparent font-bold outline-none mb-2 text-base block focus:text-white transition-colors" />
                    <input v-model="exp.address" placeholder="Address" class="w-[90%] bg-transparent text-gray-400 text-sm outline-none mb-2 block" />
                    <input v-model="exp.year" placeholder="Year" class="w-[90%] bg-transparent text-gray-500 text-[10px] uppercase font-black tracking-widest outline-none block" />
                  </div>
                </div>
              </div>

              <!-- Trainings / Certificates -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-cyan-600 opacity-50"></div>
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-xl font-black flex items-center gap-2">Trainings <span class="font-normal text-sm text-gray-400">& Certificates</span></h3>
                  <button @click="addTraining" class="text-xs font-bold text-blue-400 hover:text-blue-300 bg-blue-500/10 px-4 py-2 rounded-xl transition-all">+ Add</button>
                </div>
                <div class="space-y-4">
                  <div v-for="(training, index) in resumeData.trainings" :key="index" class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-5 relative group">
                    <button @click="resumeData.trainings.splice(index, 1)" class="absolute top-4 right-4 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                    <input v-model="training.name" placeholder="Certificate Name" class="w-[90%] bg-transparent text-sm font-black tracking-wide text-blue-400 outline-none mb-3 block" />
                    <input v-model="training.issuer" placeholder="Name of Issuer (School or Company)" class="w-[90%] bg-transparent font-bold outline-none mb-2 text-base block focus:text-white transition-colors" />
                    <input v-model="training.date_issued" placeholder="Date Issued (e.g. 2024)" class="w-[90%] bg-transparent text-gray-500 text-[10px] uppercase font-black tracking-widest outline-none block" />
                  </div>
                </div>
              </div>

              <!-- Skills -->
              <div class="bg-white/5 border border-white/5 rounded-[32px] p-6 lg:p-8">
                <h3 class="text-sm font-black mb-4 flex items-center gap-2">Skills <span class="font-normal text-xs text-gray-500">(1 per line)</span></h3>
                <textarea v-model="skillsText" rows="6" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-4 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all resize-none leading-relaxed" placeholder="Skill 1&#10;Skill 2..."></textarea>
              </div>



            </div>
          </div>
        </div>

        <!-- Requests View -->
        <div v-else-if="activeTab === 'Requests'" class="space-y-8 animate-fade-in">
          <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 lg:p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600 opacity-50"></div>
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
              <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center flex-shrink-0">
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                <div>
                  <p class="text-[10px] text-cyan-400/80 font-black uppercase tracking-[0.2em] mb-2">Resume Access Inbox</p>
                  <h3 class="text-2xl font-black text-white">Requests</h3>
                  <p class="text-sm text-gray-500 max-w-2xl mt-2">This section now shows the email address and purpose submitted by visitors who request access to your resume.</p>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <div class="px-4 py-2 rounded-2xl border border-cyan-500/20 bg-cyan-500/10 text-cyan-400 text-xs font-black uppercase tracking-widest">
                  {{ requestCount }} Total
                </div>
                <div class="px-4 py-2 rounded-2xl border border-amber-500/20 bg-amber-500/10 text-amber-300 text-xs font-black uppercase tracking-widest">
                  {{ pendingRequestCount }} Pending
                </div>
                <button @click="fetchResumeRequests" class="px-5 py-3 rounded-2xl border border-white/10 bg-white/5 text-xs font-black uppercase tracking-widest text-gray-200 hover:bg-white/10 transition-all">
                  Refresh
                </button>
              </div>
            </div>
          </div>

          <!-- Requests Search & Filter Bar -->
          <div class="flex flex-col md:flex-row gap-4 items-stretch">
            <div class="relative flex-1">
              <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
              </div>
              <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by email or purpose..."
                class="w-full bg-white/5 border border-white/5 rounded-2xl pl-14 pr-6 py-5 text-sm focus:border-cyan-500/30 outline-none transition-all placeholder:text-gray-600 text-white"
              >
            </div>
            
            <div class="relative min-w-[200px]">
              <select 
                v-model="statusFilter"
                class="w-full h-full bg-white/5 border border-white/5 rounded-2xl px-6 py-5 text-sm focus:border-cyan-500/30 outline-none transition-all text-white appearance-none cursor-pointer"
              >
                <option value="all" class="bg-[#0a0a0a]">All Statuses</option>
                <option value="pending" class="bg-[#0a0a0a]">Pending Only</option>
                <option value="accepted" class="bg-[#0a0a0a]">Accepted Only</option>
                <option value="declined" class="bg-[#0a0a0a]">Declined Only</option>
              </select>
              <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
              </div>
            </div>
          </div>

          <div v-if="isLoadingRequests" class="rounded-[32px] border border-white/10 bg-white/5 p-12 text-center text-sm text-gray-400">
            Loading resume requests...
          </div>

          <div v-else-if="requestsError" class="rounded-[32px] border border-red-500/20 bg-red-500/5 p-8 text-sm text-red-300">
            {{ requestsError }}
          </div>

          <div v-else-if="filteredResumeRequests.length === 0" class="rounded-[32px] border border-dashed border-white/10 bg-white/5 p-12 text-center">
            <div class="w-20 h-20 mx-auto rounded-3xl bg-white/5 border border-white/10 flex items-center justify-center mb-6 text-white/40">
              <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>
            <h4 class="text-xl font-black text-white mb-2">{{ searchQuery ? 'No Matches Found' : 'No Requests Yet' }}</h4>
            <p class="text-sm text-gray-500">{{ searchQuery ? 'Try adjusting your search terms to find what you are looking for.' : 'Once someone requests access to your resume, their email and purpose will appear here.' }}</p>
          </div>

          <div v-else class="bg-white/5 border border-white/5 rounded-[32px] overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full text-left">
                <thead class="bg-white/[0.03] border-b border-white/5">
                  <tr>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Email</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Purpose</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Submitted</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="request in filteredResumeRequests"
                    :key="request.id"
                    class="border-b border-white/5 last:border-b-0 hover:bg-white/[0.03] transition-colors"
                  >
                    <td class="px-6 py-5 align-top">
                      <a :href="`mailto:${request.email}`" class="text-sm font-bold text-white break-all hover:text-cyan-400 transition-colors">
                        {{ request.email }}
                      </a>
                    </td>
                    <td class="px-6 py-5 align-top">
                      <p class="text-sm leading-relaxed text-gray-200 whitespace-pre-line min-w-[280px] max-w-xl">
                        {{ request.purpose }}
                      </p>
                    </td>
                    <td class="px-6 py-5 align-top">
                      <p class="text-sm text-gray-300 whitespace-nowrap">{{ formatRequestDate(request.submitted_at || request.created_at) }}</p>
                    </td>
                    <td class="px-6 py-5 align-top">
                      <span :class="statusBadgeClass(request.status)">
                        {{ formatRequestStatus(request.status) }}
                      </span>
                    </td>
                    <td class="px-6 py-5 align-top">
                      <div class="flex items-center justify-end gap-3">
                        <button
                          @click="updateResumeRequestStatus(request, 'accepted')"
                          :disabled="isRequestActionLoading(request.id) || request.status === 'accepted'"
                          :class="[
                            'px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all',
                            isRequestActionLoading(request.id) || request.status === 'accepted'
                              ? 'bg-emerald-500/10 text-emerald-300/50 cursor-not-allowed'
                              : 'bg-emerald-500/15 text-emerald-300 hover:bg-emerald-500/25'
                          ]"
                        >
                          {{ isRequestActionLoading(request.id) && pendingRequestAction.status === 'accepted' ? 'Saving...' : 'Accept' }}
                        </button>
                        <button
                          @click="updateResumeRequestStatus(request, 'declined')"
                          :disabled="isRequestActionLoading(request.id) || request.status === 'declined'"
                          :class="[
                            'px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all',
                            isRequestActionLoading(request.id) || request.status === 'declined'
                              ? 'bg-red-500/10 text-red-300/50 cursor-not-allowed'
                              : 'bg-red-500/15 text-red-300 hover:bg-red-500/25'
                          ]"
                        >
                          {{ isRequestActionLoading(request.id) && pendingRequestAction.status === 'declined' ? 'Saving...' : 'Decline' }}
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Settings View -->
        <div v-else-if="activeTab === 'Settings'" class="space-y-8 animate-fade-in pb-20">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Account Security -->
            <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 lg:p-10 relative overflow-hidden">
               <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-orange-600 opacity-50"></div>
               <div class="flex items-center gap-3 mb-8">
                 <div class="w-10 h-10 rounded-2xl bg-red-500/20 text-red-400 flex items-center justify-center">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                 </div>
                 <h3 class="text-xl font-black">Account Security</h3>
               </div>
               
               <form @submit.prevent="updateAccountSecurity" class="space-y-6">
                 <div class="space-y-2">
                   <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Username</label>
                   <input v-model="settingsData.security.username" type="text" required class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-red-500/50 outline-none transition-all">
                 </div>
                 <div class="space-y-2">
                   <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Current Password (Required to Save)</label>
                   <input v-model="settingsData.security.oldPassword" type="password" required class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-red-500/50 outline-none transition-all">
                 </div>
                 <div class="space-y-2">
                   <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">New Password (Leave blank to keep current)</label>
                   <input v-model="settingsData.security.newPassword" type="password" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-red-500/50 outline-none transition-all">
                 </div>
                 <div class="space-y-2">
                   <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Confirm New Password</label>
                   <input v-model="settingsData.security.confirmPassword" type="password" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-red-500/50 outline-none transition-all">
                 </div>
                 
                 <button 
                   type="submit" 
                   class="w-full py-4 rounded-xl bg-gradient-to-r from-red-500 to-orange-600 text-white font-black uppercase tracking-widest text-xs hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-red-500/20 mt-2"
                 >
                   Update Security Credentials
                 </button>
               </form>
            </div>

            <!-- Social Links -->
            <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 lg:p-10 relative overflow-hidden">
               <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600 opacity-50"></div>
               <div class="flex items-center gap-3 mb-8">
                 <div class="w-10 h-10 rounded-2xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                 </div>
                 <h3 class="text-xl font-black">Social Connectivity</h3>
               </div>
               
                <form @submit.prevent="updateSettings" class="space-y-6">
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Gmail Address</label>
                    <input v-model="settingsData.social.gmail" type="email" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">LinkedIn Profile</label>
                    <input v-model="settingsData.social.linkedin" type="url" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">GitHub Profile</label>
                    <input v-model="settingsData.social.github" type="url" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Instagram Profile</label>
                    <input v-model="settingsData.social.instagram" type="url" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Facebook Profile</label>
                    <input v-model="settingsData.social.facebook" type="url" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Viber Number</label>
                    <input v-model="settingsData.social.viber" type="text" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-5 py-4 text-sm focus:border-cyan-500/50 outline-none transition-all">
                  </div>
                  
                  <button 
                    type="submit" 
                    class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 text-white font-black uppercase tracking-widest text-xs hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-cyan-500/20 mt-2"
                  >
                    Save Social Connectivity
                  </button>
                </form>
            </div>

            <!-- Profile Gallery (About Section) -->
            <div class="bg-white/5 border border-white/5 rounded-[32px] p-8 lg:p-10 relative overflow-hidden lg:col-span-2">
               <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-500 to-teal-600 opacity-50"></div>
               <div class="flex items-center justify-between mb-8">
                 <div class="flex items-center gap-3">
                   <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                   </div>
                   <div>
                     <h3 class="text-xl font-black">About Profile Gallery</h3>
                     <p class="text-xs text-gray-500 mt-1">Upload multiple images for your portfolio's About section.</p>
                   </div>
                 </div>
                 <button 
                   @click="updateSettings" 
                   class="px-6 py-2 rounded-xl bg-emerald-500/15 text-emerald-400 text-[10px] font-black uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-lg shadow-emerald-500/10"
                 >
                   Save Gallery
                 </button>
               </div>

               <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                  <!-- Upload Slot -->
                  <label class="aspect-square rounded-2xl border-2 border-dashed border-white/10 hover:border-emerald-500/30 hover:bg-emerald-500/5 transition-all cursor-pointer flex flex-col items-center justify-center gap-2 group">
                    <input type="file" multiple class="hidden" @change="handleFileUpload($event, 'about-images')" accept="image/*">
                    <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-500 group-hover:scale-110 group-hover:text-emerald-400 transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                    </div>
                    <span class="text-[9px] font-black uppercase tracking-widest text-gray-600 group-hover:text-emerald-500/60">Upload</span>
                  </label>

                  <!-- Preview Cards -->
                  <div v-for="(img, idx) in settingsData.portfolio.aboutImages" :key="idx" class="aspect-square rounded-2xl bg-[#0a0a0a] border border-white/5 overflow-hidden relative group">
                    <img :src="img.data" class="w-full h-full object-cover transition-transform group-hover:scale-110" />
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                       <button @click="settingsData.portfolio.aboutImages.splice(idx, 1)" class="w-10 h-10 rounded-full bg-red-500 text-white flex items-center justify-center hover:scale-110 transition-transform shadow-xl">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                       </button>
                    </div>
                    <div class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-black/50 backdrop-blur-md border border-white/10 text-[8px] font-black text-white/70 uppercase">
                      Image {{ idx + 1 }}
                    </div>
                  </div>
               </div>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const settingsData = reactive({
  security: {
    username: JSON.parse(localStorage.getItem('admin_credentials'))?.username || 'Dev_Joms',
    oldPassword: '',
    newPassword: '',
    confirmPassword: ''
  },
  social: {
    gmail: JSON.parse(localStorage.getItem('portfolio_settings'))?.social?.gmail || 'yourname@gmail.com',
    linkedin: JSON.parse(localStorage.getItem('portfolio_settings'))?.social?.linkedin || 'https://linkedin.com/in/yourname',
    github: JSON.parse(localStorage.getItem('portfolio_settings'))?.social?.github || 'https://github.com/yourname',
    instagram: JSON.parse(localStorage.getItem('portfolio_settings'))?.social?.instagram || 'https://instagram.com/yourname',
    facebook: JSON.parse(localStorage.getItem('portfolio_settings'))?.social?.facebook || 'https://facebook.com/yourname',
    viber: JSON.parse(localStorage.getItem('portfolio_settings'))?.social?.viber || '+1234567890'
  },
  portfolio: {
    aboutImages: JSON.parse(localStorage.getItem('portfolio_settings'))?.portfolio?.aboutImages || []
  }
});

const menus = [
  { id: 'Dashboard', label: 'Overview', icon: 'dashboard' },
  { id: 'Works', label: 'Works & Projects', icon: 'works' },
  { id: 'Certs', label: 'Certifications', icon: 'certs' },
  { id: 'Stacks', label: 'Tech Stacks', icon: 'stacks' },
  { id: 'Resume', label: 'Resume', icon: 'resume' },
  { id: 'Requests', label: 'Requests', icon: 'requests' },
  { id: 'Settings', label: 'Settings', icon: 'settings' }
];

const activeTab = ref('Dashboard');
const selectedId = ref(null);
const searchQuery = ref('');
const resumeRequests = ref([]);
const isLoadingRequests = ref(false);
const requestsError = ref('');
const statusFilter = ref('all');
const pendingRequestAction = reactive({
  id: null,
  status: '',
});

watch(activeTab, (newTab) => {
  searchQuery.value = '';
  statusFilter.value = 'all';
  resetForm();

  if (newTab === 'Requests') {
    fetchResumeRequests();
  }
});

const filteredResumeRequests = computed(() => {
  let filtered = resumeRequests.value;

  // Status Filter
  if (statusFilter.value !== 'all') {
    filtered = filtered.filter(request => request.status === statusFilter.value);
  }

  // Search Query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    filtered = filtered.filter(request => {
      return (request.email || '').toLowerCase().includes(query) || 
             (request.purpose || '').toLowerCase().includes(query);
    });
  }

  return filtered;
});

const activeMenuObj = computed(() => menus.find(m => m.id === activeTab.value));
const requestCount = computed(() => resumeRequests.value.length);
const pendingRequestCount = computed(() => resumeRequests.value.filter(request => request.status === 'pending').length);
const acceptedRequestCount = computed(() => resumeRequests.value.filter(request => request.status === 'accepted').length);
const declinedRequestCount = computed(() => resumeRequests.value.filter(request => request.status === 'declined').length);
const latestRequests = computed(() => {
  return resumeRequests.value
    .filter(request => request.status === 'pending')
    .sort((a, b) => new Date(b.submitted_at || b.created_at) - new Date(a.submitted_at || a.created_at))
    .slice(0, 5);
});

const works = ref([]);
const certs = ref([]);
const stacks = ref([]);
const featuredWorks = ref([]);
const featuredCerts = ref([]);

const isFeatured = (id) => {
  if (activeTab.value === 'Works') return featuredWorks.value.includes(id);
  if (activeTab.value === 'Certs') return featuredCerts.value.includes(id);
  return false;
};

const toggleFeatured = (item) => {
  const arr = activeTab.value === 'Works' ? featuredWorks : featuredCerts;
  const idx = arr.value.indexOf(item.id);
  if (idx !== -1) {
    arr.value.splice(idx, 1);
  } else {
    if (arr.value.length >= 3) {
      alert('You can only feature up to 3 items. Remove one first.');
      return;
    }
    arr.value.push(item.id);
  }
  // Auto-save featured selections immediately
  localStorage.setItem('portfolio_featured_works', JSON.stringify(featuredWorks.value));
  localStorage.setItem('portfolio_featured_certs', JSON.stringify(featuredCerts.value));
};

const activeItems = computed(() => {
  if (activeTab.value === 'Works') return works.value;
  if (activeTab.value === 'Certs') return certs.value;
  if (activeTab.value === 'Stacks') return stacks.value;
  return [];
});

const filteredItems = computed(() => {
  if (!searchQuery.value) return activeItems.value;
  
  const query = searchQuery.value.toLowerCase();
  return activeItems.value.filter(item => {
    const title = (item.title || item.name || '').toLowerCase();
    const desc = (item.description || '').toLowerCase();
    const more = (item.stacks || item.issuer || item.category || '').toLowerCase();
    return title.includes(query) || desc.includes(query) || more.includes(query);
  });
});

const resumeData = reactive({
  basicInfo: {
    name: 'JHO MARI MATUGUINAS MALACA',
    address: '1445 New Site Street, San Gabriel, Santa Maria, Bulacan',
    contact: '09657109042',
    email: 'jhomarimalaca1@gmail.com',
    profileImageLight: '',
    profileImageDark: '',
    resumePdf: ''
  },
  careerObjective: 'To contribute to a progressive organization by applying knowledge, developing new skills, and supporting the achievement of organizational goals while building a strong foundation for long-term professional growth.',
  educationalBackground: [
    { level: 'Tertiary:', school: 'STI College Sta. Maria', course: 'Bachelor of Science in Information Technology', address: 'Poblacion, Santa Maria, Bulacan', year: '2022-2025' }
  ],
  skills: [
    'Problem-Solving and Analytical Thinking',
    'Critical Thinking',
    'Team Collaboration and Communication',
    'Eagerness to Learn and Improve',
    'Programming (Java, C#, Python, PHP)',
    'Web Development (HTML, CSS, Laravel, Django)',
    'Database Management (MySQL)',
    'Software and Hardware Installation'
  ],
  trainings: [
    { name: 'SAP University Alliance', date_issued: '2024', issuer: 'STI College Sta. Maria' },
    { name: 'Java Fundamentals', date_issued: '2023', issuer: 'STI College Sta. Maria' },
    { name: 'System Administration', date_issued: '2023', issuer: 'STI College Sta. Maria' }
  ],
  workExperience: [
    { company: 'Jollibee Sta. Maria Highway', address: 'Bypass Road, Sta. Clara, Sta. Maria, Bulacan', position: 'Crew', year: '2022-2025' },
    { company: 'Software House / SGK', address: 'Poblacion, Santa Maria, Bulacan', position: 'Junior Technician', year: '2020- 2022' }
  ],
  personalInfo: {
    age: '25 Years Old',
    dob: 'October 01, 2000',
    sex: 'Male',
    citizenship: 'Filipino',
    civilStatus: 'Single',
    religion: 'Roman Catholic'
  },
  references: [
    { name: 'Mr. Alfie B. Benito, MIT', company: 'STI College Sta. Maria', position: 'Assistant Professor', email: 'Alfiebernardobenito@gmail.com', contact: '09774767391' },
    { name: 'Ms. Reymalyn Villanueva Obar', company: 'Jollibee Waltermart Guiguinto', position: 'Assistant Restaurant Manager 2', email: 'reymalynobar@gmail.com', contact: '09999182293' },
    { name: 'Mr. Jhoselle Tus, Phd, DPA', company: 'Jesus Is Lord College Inc.', position: 'Professor', email: 'Profjo@gmail.com', contact: '09750918100' }
  ]
});

const skillsText = computed({
  get: () => resumeData.skills.join('\n'),
  set: (val) => { resumeData.skills = val.split('\n').filter(Boolean); }
});

const addEducation = () => resumeData.educationalBackground.push({level: '', school: '', course: '', address: '', year: ''});
const addWorkExp = () => resumeData.workExperience.push({company: '', position: '', address: '', year: ''});
const addTraining = () => resumeData.trainings.push({name: '', date_issued: '', issuer: ''});
const addReference = () => resumeData.references.push({name: '', company: '', position: '', email: '', contact: ''});

const saveResume = () => {
  localStorage.setItem('portfolio_resume', JSON.stringify(resumeData));
  alert('Resume saved successfully to LocalStorage!');
};

const form = reactive({
  title: '',
  description: '',
  summary: '', // Short summary for card/overview
  features: '', // Multi-line string for key features
  image: '', // Hero image
  link: '', // Project/Cert link
  github_link: '', // GitHub Source link
  stacks: '',
  issuer: '',
  year_issued: '',
  category: 'Frontend',
  files: [], // Multiple files for Works
  cert_file: null, // For Certificates (image or PDF)
});

const currentUploads = ref([]); // Track active processing progress


const handleFileUpload = (e, target) => {
  const fileList = e.target.files;
  if (!fileList.length) return;

  const filesArray = Array.from(fileList);
  
  filesArray.forEach(file => {
    // Add to progress tracker
    const uploadId = Date.now() + Math.random();
    const uploadInfo = reactive({
      id: uploadId,
      name: file.name,
      progress: 0,
      size: (file.size / 1024 / 1024).toFixed(2) + ' MB'
    });
    currentUploads.value.push(uploadInfo);

    // Prepare FormData
    const formData = new FormData();
    formData.append('file', file);

    // Upload to Laravel
    axios.post('/upload', formData, {
      onUploadProgress: (progressEvent) => {
        const percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);
        uploadInfo.progress = percent;
      }
    }).then(response => {
      // response.data.url is the Laravel public URL
      const uploadedData = {
          name: file.name,
          type: file.type,
          data: response.data.url, // Real URL location
          size: uploadInfo.size
      };

      if (target === 'works') {
        form.files.push(uploadedData);
      } else if (target === 'certs') {
        form.cert_file = uploadedData;
      } else if (target === 'stacks') {
        form.image = response.data.url;
      } else if (target === 'resume-profile-light') {
        resumeData.basicInfo.profileImageLight = response.data.url;
      } else if (target === 'resume-profile-dark') {
        resumeData.basicInfo.profileImageDark = response.data.url;
      } else if (target === 'resume-pdf') {
        resumeData.basicInfo.resumePdf = response.data.url;
      } else if (target === 'about-images') {
        settingsData.portfolio.aboutImages.push(uploadedData);
      }

      // Success feedback
      setTimeout(() => {
        currentUploads.value = currentUploads.value.filter(u => u.id !== uploadId);
      }, 500);
    }).catch(error => {
      console.error('Upload Error:', error);
      alert(`Upload failed for ${file.name}. Please check file type and size.`);
      currentUploads.value = currentUploads.value.filter(u => u.id !== uploadId);
    });
  });
};

const removeFile = (index) => {
  form.files.splice(index, 1);
};


const defaultWorks = [];
const defaultCerts = [];
const defaultStacks = [];

const formatRequestStatus = (status) => {
  if (status === 'accepted') return 'Accepted';
  if (status === 'declined') return 'Declined';
  return 'Pending';
};

const statusBadgeClass = (status) => {
  if (status === 'accepted') {
    return 'inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/15 border border-emerald-500/20 text-emerald-300 text-[10px] font-black uppercase tracking-widest';
  }

  if (status === 'declined') {
    return 'inline-flex items-center px-3 py-1 rounded-full bg-red-500/15 border border-red-500/20 text-red-300 text-[10px] font-black uppercase tracking-widest';
  }

  return 'inline-flex items-center px-3 py-1 rounded-full bg-amber-500/15 border border-amber-500/20 text-amber-300 text-[10px] font-black uppercase tracking-widest';
};

const formatRequestDate = (value) => {
  if (!value) return 'Just now';

  return new Date(value).toLocaleString('en-PH', {
    dateStyle: 'medium',
    timeStyle: 'short',
  });
};

const isRequestActionLoading = (requestId) => pendingRequestAction.id === requestId;

const fetchResumeRequests = async () => {
  isLoadingRequests.value = true;
  requestsError.value = '';

  try {
    const response = await axios.get('/resume-requests');
    resumeRequests.value = Array.isArray(response.data) ? response.data : [];
  } catch (error) {
    console.error('Unable to load resume requests:', error);
    requestsError.value = 'Unable to load resume requests right now. Please try refreshing the list.';
  } finally {
    isLoadingRequests.value = false;
  }
};

const updateResumeRequestStatus = async (request, status) => {
  if (!request?.id || request.status === status) return;

  pendingRequestAction.id = request.id;
  pendingRequestAction.status = status;
  requestsError.value = '';

  try {
    const response = await axios.patch(`/resume-requests/${request.id}/status`, { status });
    
    const updatedRequest = response.data;
    const index = resumeRequests.value.findIndex(item => item.id === request.id);
    if (index !== -1) {
      resumeRequests.value[index] = updatedRequest;
    }
  } catch (error) {
    console.error('Unable to update resume request status:', error);
    requestsError.value = 'Unable to update the request status right now. Please try again.';
  } finally {
    pendingRequestAction.id = null;
    pendingRequestAction.status = '';
  }
};

const loadData = () => {
  const storedWorks = localStorage.getItem('portfolio_works');
  const storedCerts = localStorage.getItem('portfolio_certs');
  const storedStacks = localStorage.getItem('portfolio_stacks');
  const storedResume = localStorage.getItem('portfolio_resume');
  const storedFeaturedWorks = localStorage.getItem('portfolio_featured_works');
  const storedFeaturedCerts = localStorage.getItem('portfolio_featured_certs');

  works.value = storedWorks ? JSON.parse(storedWorks) : [];
  certs.value = storedCerts ? JSON.parse(storedCerts) : [];
  stacks.value = storedStacks ? JSON.parse(storedStacks) : [];
  featuredWorks.value = storedFeaturedWorks ? JSON.parse(storedFeaturedWorks) : [];
  featuredCerts.value = storedFeaturedCerts ? JSON.parse(storedFeaturedCerts) : [];

  if (storedResume) {
    const parsed = JSON.parse(storedResume);
    const currentBasic = { ...resumeData.basicInfo };
    Object.assign(resumeData, parsed);
    if (parsed.basicInfo) {
      resumeData.basicInfo = { ...currentBasic, ...parsed.basicInfo };
    }
  }
};

onMounted(() => {
  loadData();
  fetchResumeRequests();
});

const resetForm = () => {
  selectedId.value = null;
  form.title = '';
  form.description = '';
  form.summary = '';
  form.features = '';
  form.image = '';
  form.link = '';
  form.github_link = '';
  form.stacks = '';
  form.issuer = '';
  form.year_issued = '';
  form.category = 'Frontend';
  form.files = [];
  form.cert_file = null;
};

const editItem = (item) => {
  selectedId.value = item.id;
  form.title = item.title || item.name || '';
  form.description = item.description || '';
  form.summary = item.summary || '';
  form.features = item.features || '';
  form.image = item.image || '';
  form.link = item.link || '';
  form.github_link = item.github_link || '';
  form.stacks = item.stacks || '';
  form.issuer = item.issuer || '';
  form.year_issued = item.year_issued || '';
  form.category = item.category || 'Frontend';
  form.files = item.files || [];
  form.cert_file = item.cert_file || null;
};

const handleSubmit = () => {
  const currentArray = activeTab.value === 'Works' ? works : activeTab.value === 'Certs' ? certs : stacks;
  
  const newItem = {
    id: selectedId.value || Date.now(),
    title: form.title,
    name: form.title, // Support both naming styles
    description: form.description,
    summary: form.summary,
    features: form.features,
    image: form.image,
    link: form.link,
    github_link: form.github_link,
    stacks: form.stacks,
    issuer: form.issuer,
    year_issued: form.year_issued,
    category: form.category,
    files: JSON.parse(JSON.stringify(form.files)), // Deep copy
    cert_file: form.cert_file ? JSON.parse(JSON.stringify(form.cert_file)) : null
  };

  if (selectedId.value) {
    const index = currentArray.value.findIndex(i => i.id === selectedId.value);
    if (index !== -1) currentArray.value[index] = newItem;
  } else {
    currentArray.value.push(newItem);
  }

  resetForm();
  saveAll();
};

const deleteItem = (id) => {
  const currentArray = activeTab.value === 'Works' ? works : activeTab.value === 'Certs' ? certs : stacks;
  currentArray.value = currentArray.value.filter(i => i.id !== id);
  if (selectedId.value === id) resetForm();
  saveAll();
};

const updateAccountSecurity = () => {
  const adminAuth = JSON.parse(localStorage.getItem('admin_credentials')) || {
    username: 'Dev_Joms',
    password: 'Tsuitachi_01'
  };

  if (settingsData.security.oldPassword !== adminAuth.password) {
    alert('Invalid current password!');
    return;
  }

  // Determine what we're changing
  let updatedUsername = settingsData.security.username || adminAuth.username;
  let updatedPassword = adminAuth.password;

  if (settingsData.security.newPassword) {
    if (settingsData.security.newPassword !== settingsData.security.confirmPassword) {
      alert('New passwords do not match!');
      return;
    }
    updatedPassword = settingsData.security.newPassword;
  }

  // Update credentials
  const newCredentials = {
    username: updatedUsername,
    password: updatedPassword
  };

  localStorage.setItem('admin_credentials', JSON.stringify(newCredentials));
  
  // Clear sensitive fields
  settingsData.security.oldPassword = '';
  settingsData.security.newPassword = '';
  settingsData.security.confirmPassword = '';

  alert('Security credentials updated successfully!');
};

const updateSettings = () => {
  localStorage.setItem('portfolio_settings', JSON.stringify(settingsData));
  alert('Settings saved successfully!');
};

const saveAll = () => {
  localStorage.setItem('portfolio_works', JSON.stringify(works.value));
  localStorage.setItem('portfolio_certs', JSON.stringify(certs.value));
  localStorage.setItem('portfolio_stacks', JSON.stringify(stacks.value));
  localStorage.setItem('portfolio_featured_works', JSON.stringify(featuredWorks.value));
  localStorage.setItem('portfolio_featured_certs', JSON.stringify(featuredCerts.value));
  localStorage.setItem('portfolio_settings', JSON.stringify(settingsData));
  
  // Handle Password logic if changing
  if (activeTab.value === 'Settings' && settingsData.security.newPassword) {
    if (settingsData.security.newPassword !== settingsData.security.confirmPassword) {
      alert('New passwords do not match!');
      return;
    }
    // In a real app, you'd verify old password here via API
    alert('Password change initiated (Verification would happen on backend)');
  }

  alert('Changes saved successfully to LocalStorage!');
};

const logout = () => {
  sessionStorage.removeItem('admin_auth');
  router.push('/login');
};
</script>

<style scoped>
.scroll-hide::-webkit-scrollbar {
  display: none;
}
.scroll-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.4s ease-out forwards;
}
</style>
