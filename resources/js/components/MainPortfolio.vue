<template>
  <div :class="['h-screen overflow-hidden transition-colors duration-500 flex items-center justify-center p-0 md:p-8 font-sans relative', isDark ? 'bg-[#050505] text-white dark' : 'bg-grid-paper text-black']">
    <!-- Luxury Splash Loader -->
    <transition name="fade-overlay">
      <div v-if="isLoading" class="fixed inset-0 z-[1000] bg-black flex flex-col items-center justify-center overflow-hidden">
        <!-- Brand Reveal -->
        <div class="relative mb-12 flex flex-col items-center">
          <div class="text-7xl font-black tracking-tighter text-white flex items-center gap-1">
             <span>J</span>
             <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-500 animate-pulse">O</span>
             <span>Ms</span>
          </div>
          <div class="h-[2px] w-24 bg-gradient-to-r from-transparent via-cyan-500 to-transparent mt-4 opacity-50"></div>
        </div>

        <!-- Progress Track -->
        <div class="w-48 h-[1px] bg-white/10 relative overflow-hidden rounded-full">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-indigo-500 animate-loading-progress"></div>
        </div>
        
        <p class="mt-8 text-[10px] font-black uppercase tracking-[0.5em] text-white/40 animate-pulse">Initializing Ecosystem</p>
      </div>
    </transition>

    <!-- Particle Canvas for Dark Mode -->
    <canvas 
      v-if="isDark"
      ref="canvasRef" 
      class="absolute inset-0 z-0 pointer-events-none opacity-80"
    ></canvas>
    
    <!-- Admin Power Button -->
    <!-- <router-link 
      to="/admin" 
      :class="['fixed bottom-6 left-6 z-[100] w-12 h-12 rounded-full flex items-center justify-center border transition-all duration-300 shadow-xl group hover:scale-110 active:scale-95', isDark ? 'bg-white/10 backdrop-blur-md border-white/10 text-gray-400 hover:text-cyan-400' : 'bg-white/80 backdrop-blur-md border-gray-200 text-gray-500 hover:text-cyan-500']"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.8)] transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg>
    </router-link> -->

    <!-- Main Container Card -->
    <div :class="['relative w-full h-full lg:max-w-[1200px] lg:max-h-[850px] transition-all duration-500', windowWidth < 1024 ? 'max-w-none max-h-none' : '']">
      
      <!-- Desktop Sidebar (Relative to Card) -->
      <div 
        v-if="windowWidth >= 1024"
        class="absolute -left-[60px] top-10 z-0 flex flex-col gap-0 transition-all duration-500"
      >
        <!-- Portfolio Tab -->
        <button 
          @click="activeMainTab = 'Portfolio'"
          :class="[
            'w-[60px] h-[160px] flex items-center justify-center rounded-l-[24px] transition-all duration-500 border-l border-y origin-right hover:pr-4',
            activeMainTab === 'Portfolio' 
              ? (isDark ? 'bg-[#151515] text-white z-20 border-white/5 shadow-[-12px_0_30px_rgba(0,0,0,0.4)]' : 'bg-white text-black z-20 border-transparent shadow-[-12px_0_30px_rgba(0,0,0,0.1)]') 
              : (isDark ? 'bg-black text-gray-700 z-10 border-white/5 hover:text-gray-400 hover:bg-[#0A0A0A]' : 'bg-[#E5E5E5] text-gray-400 z-10 border-gray-200/50 hover:text-gray-600 hover:bg-gray-100')
          ]"
        >
          <div class="-rotate-90 flex items-center gap-3 whitespace-nowrap font-bold tracking-wider text-[15px] transition-transform duration-500 group-hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            <span>Portfolio</span>
          </div>
        </button>
        <!-- Resume Tab -->
        <button 
          @click="openResumeSection"
          :class="[
            'w-[60px] h-[160px] flex items-center justify-center rounded-l-[24px] transition-all duration-500 border-l border-y origin-right hover:pr-4',
            activeMainTab === 'Resume' 
              ? (isDark ? 'bg-[#151515] text-white z-20 border-white/5 shadow-[-12px_0_30px_rgba(0,0,0,0.4)]' : 'bg-white text-black z-20 border-transparent shadow-[-12px_0_30px_rgba(0,0,0,0.1)]') 
              : (isDark ? 'bg-black text-gray-700 z-10 border-white/5 hover:text-gray-400 hover:bg-[#0A0A0A]' : 'bg-[#E5E5E5] text-gray-400 z-10 border-gray-200/50 hover:text-gray-600 hover:bg-gray-100')
          ]"
        >
          <div class="-rotate-90 flex items-center gap-3 whitespace-nowrap font-bold tracking-wider text-[15px] transition-transform duration-500 group-hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
            <span>Resume</span>
          </div>
        </button>

        <!-- Social Icons Column -->
        <div class="flex flex-col gap-6 items-center py-6 mt-2 overflow-y-auto max-h-[300px] scroll-hide">
            <a v-for="social in socials" :key="social.name" :href="social.link" target="_blank"
              :class="[
                'group relative transition-all duration-500 rounded-xl flex-shrink-0', 
                activeSocialName === social.name ? 'scale-150 ' + (social.name === 'GitHub' ? (isDark ? 'text-white' : 'text-black') : social.hoverColor.replace('hover:', '')) : (isDark ? 'text-gray-600' : 'text-gray-400'),
                'hover:scale-150',
                social.name === 'GitHub' ? (isDark ? 'hover:text-white' : 'hover:text-black') : social.hoverColor
              ]"
            >
                <div v-html="social.iconSVG" :class="['w-5 h-5 transition-all duration-500 group-hover:rotate-12', activeSocialName === social.name ? 'rotate-12' : '']"></div>
            </a>
        </div>
      </div>

      <div 
        v-if="windowWidth >= 1024"
        class="absolute -right-[70px] top-20 flex flex-col items-center gap-6 z-[30] transition-all duration-700"
      >
        <!-- Showcase Sub-Nav Icons -->
        <div class="relative group">
          <button 
            @click="activeMainTab = 'Portfolio'; portfolioMode = 'Works'; activeNavItem = 'Showcase'"
            :class="['w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500 active:scale-90', portfolioMode === 'Works' ? (isDark ? 'bg-[#121212] border border-white/5 text-cyan-400 shadow-xl' : 'bg-white text-cyan-500 shadow-xl') : (isDark ? 'text-gray-600 hover:text-gray-300' : 'text-gray-500 hover:text-cyan-500')]"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
          </button>
          <div class="absolute left-full ml-2 top-1/2 -translate-y-1/2 px-4 py-2 bg-gradient-to-r from-cyan-500 to-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl opacity-0 scale-90 pointer-events-none group-hover:opacity-100 group-hover:scale-100 transition-all shadow-xl shadow-cyan-500/20 whitespace-nowrap">Works</div>
        </div>

        <div class="relative group">
          <button 
            @click="activeMainTab = 'Portfolio'; portfolioMode = 'Certificates'; activeNavItem = 'Showcase'"
            :class="['w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500 active:scale-90', portfolioMode === 'Certificates' ? (isDark ? 'bg-[#121212] border border-white/5 text-cyan-400 shadow-xl' : 'bg-white text-cyan-500 shadow-xl') : (isDark ? 'text-gray-600 hover:text-gray-300' : 'text-gray-500 hover:text-cyan-500')]"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
          </button>
          <div class="absolute left-full ml-2 top-1/2 -translate-y-1/2 px-4 py-2 bg-gradient-to-r from-cyan-500 to-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl opacity-0 scale-90 pointer-events-none group-hover:opacity-100 group-hover:scale-100 transition-all shadow-xl shadow-cyan-500/20 whitespace-nowrap">Certs</div>
        </div>

        <div class="relative group">
          <button 
            @click="activeMainTab = 'Portfolio'; portfolioMode = 'Stack'; activeNavItem = 'Showcase'"
            :class="['w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500 active:scale-90', portfolioMode === 'Stack' ? (isDark ? 'bg-[#121212] border border-white/5 text-cyan-400 shadow-xl' : 'bg-white text-cyan-500 shadow-xl') : (isDark ? 'text-gray-600 hover:text-gray-300' : 'text-gray-500 hover:text-cyan-500')]"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
          </button>
          <div class="absolute left-full ml-2 top-1/2 -translate-y-1/2 px-4 py-2 bg-gradient-to-r from-cyan-500 to-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl opacity-0 scale-90 pointer-events-none group-hover:opacity-100 group-hover:scale-100 transition-all shadow-xl shadow-cyan-500/20 whitespace-nowrap">Stack</div>
        </div>
      </div>
      
      <!-- Mobile Sidebar Toggle (Floating Pill) -->
      <div v-if="windowWidth < 1024" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] flex bg-black/80 backdrop-blur-xl border border-white/10 p-1 rounded-full shadow-2xl">
          <button @click="activeMainTab = 'Portfolio'" :class="['px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest transition-all', activeMainTab === 'Portfolio' ? 'bg-gradient-to-br from-cyan-400 to-indigo-500 text-white border-transparent shadow-[0_0_20px_rgba(6,182,212,0.4)]' : 'text-white/40']">
            Portfolio
          </button>
          <button @click="openResumeSection" :class="['px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest transition-all', activeMainTab === 'Resume' ? 'bg-gradient-to-br from-cyan-400 to-indigo-500 text-white border-transparent shadow-[0_0_20px_rgba(6,182,212,0.4)]' : 'text-white/40']">
            Resume
          </button>
      </div>

      <!-- Main Card -->
      <div :class="['w-full h-full flex flex-col transition-all duration-500 relative border z-10', 
        isDark ? 'bg-[#121212] border-white/5' : 'bg-white border-transparent',
        windowWidth < 1024 ? 'rounded-0 border-0' : 'rounded-[40px] shadow-[0_0_100px_rgba(0,0,0,0.3)] overflow-hidden'
      ]">
        <!-- Active View Indicator (Top Bar Glow) -->
        <div v-if="activeMainTab !== 'Portfolio'" class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600 shadow-[0_0_20px_rgba(6,182,212,0.5)] z-50"></div>

        <!-- Scroll Progress Bar (Global for Portfolio) -->
        <div v-if="activeMainTab === 'Portfolio' && portfolioMode === 'scroll'" class="absolute top-0 left-0 w-full h-[3px] bg-transparent z-[100]">
           <div 
             class="h-full bg-gradient-to-r from-cyan-500 to-indigo-600 shadow-[0_0_15px_rgba(34,211,238,0.6)] transition-all duration-150 ease-out"
             :style="{ width: `${scrollProgress}%` }"
           ></div>
        </div>

        <!-- Connectivity Lines (Internal Glow) -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-[40px]">
           <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-cyan-500/20 to-transparent"></div>
           <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent"></div>
        </div>
        
        <!-- Top Navigation (Compact) -->
        <nav :class="['flex items-center justify-between z-10', windowWidth < 1024 ? 'px-6 py-4' : 'px-10 py-4 lg:py-6']">
          <div class="flex items-center gap-4 lg:gap-6">
            <div 
              @click="activeMainTab = 'Portfolio'; portfolioMode = 'scroll'; scrollToSection('Home')" 
              :class="['flex items-center font-bold text-xl lg:text-2xl tracking-tighter transition-all cursor-pointer hover:scale-110 active:scale-95', isDark ? 'text-white' : 'text-black']"
            >
              <span>J</span>
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-indigo-600">O</span>
              <span>Ms</span>
            </div>
            
            <!-- Email -->
            <div 
              @click="triggerMessage"
              v-if="windowWidth > 640" 
              :class="['flex items-center gap-2 text-[11px] lg:text-sm font-bold transition-all duration-300 cursor-pointer hover:bg-gradient-to-r hover:from-cyan-500 hover:to-indigo-600 hover:text-white hover:-rotate-2 hover:px-4 hover:py-2 hover:rounded-xl hover:shadow-xl hover:scale-110 active:scale-95 group', isDark ? 'text-gray-400' : 'text-gray-500']"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 lg:w-4 h-4 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              <span class="max-w-[120px] lg:max-w-none text-[10px] lg:text-sm">{{ settings.social.gmail }}</span>
            </div>
          </div>

          <div v-if="activeMainTab === 'Portfolio' && portfolioMode !== 'scroll'" class="absolute left-1/2 -translate-x-1/2 flex items-center pointer-events-none">
              <h2 class="text-xl lg:text-3xl font-black whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-indigo-600">
                {{ portfolioMode === 'Works' ? 'My Works' : (portfolioMode === 'Certificates' ? 'Certifications' : 'Tech Stacks') }}
              </h2>
          </div>

          <div class="flex items-center gap-3 lg:gap-6 flex-1 justify-end">
              <!-- Standardized Sliding Navigation (Symmetry Fix) -->
              <div v-if="activeMainTab === 'Portfolio' && portfolioMode === 'scroll'" :class="['flex items-center p-1 rounded-full relative overflow-hidden transition-all duration-500', isDark ? 'bg-white/[0.03] border border-white/5 shadow-inner' : 'bg-gray-100 shadow-inner']">
                
                <!-- Sliding Indicator (Truly Global Slide - Hardware Accelerated) -->
                  <div 
                    class="absolute transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] rounded-full z-0 shadow-lg shadow-cyan-500/30 bg-gradient-to-r from-cyan-500 to-indigo-600 will-change-transform"
                    :style="{
                      transform: `translateX(${navItems.findIndex(i => i.name === activeNavItem) * (windowWidth < 640 ? 50 : 100)}px)`,
                      width: (windowWidth < 640 ? 50 : 100) + 'px',
                      top: '4px',
                      bottom: '4px',
                      left: '4px'
                    }"
                  ></div>

                <div class="flex items-center gap-0">
                  <button 
                    v-for="item in navItems" 
                    :key="item.name"
                    @click="scrollToSection(item.name)"
                    :class="[
                      'relative z-10 flex items-center justify-center gap-2 rounded-full transition-all duration-500 h-9 lg:h-10',
                      windowWidth < 640 ? 'w-[50px]' : 'w-[100px]',
                      activeNavItem === item.name ? 'text-white' : (isDark ? 'text-gray-500 hover:text-gray-300 hover:scale-110 active:scale-95' : 'text-gray-500 hover:text-black hover:scale-110 active:scale-95')
                    ]"
                  >
                    <div 
                      v-html="item.icon" 
                      :class="[
                        'w-4 h-4 lg:w-4.5 lg:h-4.5 transition-all duration-500',
                        activeNavItem === item.name ? 'scale-110' : 'scale-100 opacity-60'
                      ]"
                    ></div>
                    <span v-if="windowWidth >= 640" :class="['text-[11px] font-black uppercase tracking-tight transition-all duration-500', activeNavItem === item.name ? 'opacity-100' : '']">
                      {{ item.name }}
                    </span>
                  </button>
                </div>
              </div>

              <!-- Resume Actions (Only in Resume View for Authorized Users) -->
              <div v-if="activeMainTab === 'Resume' && isResumeAuthorized && resumeData.basicInfo.resumePdf" class="flex items-center gap-2">
                <!-- Toggle View Button (Normal / PDF) -->
                <button 
                  @click="resumeViewMode = resumeViewMode === 'normal' ? 'pdf' : 'normal'"
                  :class="['px-5 py-2.5 rounded-full border-2 font-black text-[10px] uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-2', isDark ? 'bg-white/5 border-white/10 text-gray-400 hover:text-white hover:border-white/20' : 'bg-gray-100 border-gray-200 text-gray-500 hover:text-black']"
                >
                  <svg v-if="resumeViewMode === 'normal'" xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                  <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                  <span v-if="windowWidth > 640">{{ resumeViewMode === 'normal' ? 'View PDF' : 'Normal View' }}</span>
                </button>

                <!-- Download Resume Button -->
                <a 
                  :href="resumeData.basicInfo.resumePdf" 
                  download="JhoMariMalacaResume" 
                  class="px-5 py-2.5 rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 text-white font-black text-[10px] uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg shadow-cyan-500/20 flex items-center gap-2 group"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 group-hover:bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                  <span v-if="windowWidth > 640">Download PDF</span>
                </a>
              </div>

              <div v-if="activeMainTab === 'Portfolio' && (portfolioMode === 'Works' || portfolioMode === 'Certificates')" :class="['flex items-center gap-1.5 p-1 rounded-xl border transition-colors mr-2', isDark ? 'bg-white/5 border-white/10' : 'bg-gray-100 border-gray-200']">
                  <button 
                    @click="portfolioMode === 'Works' ? worksViewMode = 'grid' : certsViewMode = 'grid'" 
                    :class="['w-8 h-8 rounded-lg flex items-center justify-center transition-all', (portfolioMode === 'Works' ? worksViewMode : certsViewMode) === 'grid' ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:text-gray-600']"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                  </button>
                  <button 
                    @click="portfolioMode === 'Works' ? worksViewMode = 'list' : certsViewMode = 'list'" 
                    :class="['w-8 h-8 rounded-lg flex items-center justify-center transition-all', (portfolioMode === 'Works' ? worksViewMode : certsViewMode) === 'list' ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:text-gray-600']"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                  </button>
              </div>

              <!-- Dark Mode Toggle (Unified Background) -->
              <button @click="isDark = !isDark" :class="['p-2.5 rounded-full transition-all duration-500 hover:rotate-90 hover:scale-125 shadow-sm active:scale-95 border transition-all', isDark ? 'bg-white/[0.03] border-white/5 text-yellow-400 hover:bg-white/10' : 'bg-gray-100 border-transparent text-gray-400 hover:bg-gray-200 hover:text-black']">
                  <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                  <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
              </button>
          </div>
        </nav>

        <!-- Content Views -->
        <!-- Content Views (Scrollable Portfolio) -->
        <div class="flex-1 relative overflow-hidden flex flex-col">
          <!-- Global Detailed View Back Button (Sticky) -->
          <button 
            v-if="activeMainTab === 'Portfolio' && portfolioMode !== 'scroll'"
            @click="scrollToSection('Home')" 
            :class="['absolute top-4 left-6 lg:left-10 w-12 h-12 rounded-full flex items-center justify-center transition-all z-50 group shadow-xl', 
              isDark ? 'bg-white/5 text-white border border-white/10 hover:border-white/20' : 'bg-white text-black border border-gray-100 hover:border-gray-200',
              portfolioMode === 'Certificates' ? 'hover:bg-indigo-500 hover:text-white' : 'hover:bg-cyan-500 hover:text-white'
            ]"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
          </button>

          <transition name="fade-slide" mode="out-in">

            <!-- Portfolio Section -->
            <div v-if="activeMainTab === 'Portfolio'" key="portfolio" class="h-full flex flex-col">
              
              <!-- Portfolio Sub-Views (Detailed Sections) -->
              <transition name="fade-slide" mode="out-in">
                <!-- Main Scrollable Content (The Portfolio List) -->
                <div 
                  v-if="portfolioMode === 'scroll'" 
                  key="scroll" 
                  class="h-full overflow-y-auto scroll-smooth scroll-hide relative" 
                  id="portfolio-scroll-container" 
                  @scroll="handleScroll"
                >
                  <!-- Home Section (Shifted Up) -->
                  <section id="Home" class="min-h-full flex flex-col md:flex-row items-center relative pt-2 px-6 lg:px-12">
                    <div class="flex-1 md:ml-6 pr-4 py-12 flex flex-col justify-center max-w-[500px]">
                      <div class="mb-5 relative">
                          <div :class="['px-4 py-2 rounded-[12px] text-[13px] font-bold w-fit relative transition-colors duration-500 flex items-center gap-2', isDark ? 'bg-white text-black after:border-t-white' : 'bg-black text-white after:border-t-black', 'after:content-[\'\'] after:absolute after:top-full after:left-1/2 after:-translate-x-1/2 after:border-[6px] after:border-transparent']">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Available for work
                          </div>
                      </div>
                      <h1 class="text-5xl lg:text-7xl font-black tracking-tighter mb-4 leading-none">
                        Web <br/> 
                        <span @mouseenter="handleMouseEnterMatrix" @mouseleave="handleMouseLeaveMatrix" class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-indigo-600 relative inline-block cursor-default select-none transition-transform duration-500 hover:scale-105 hover:rotate-1">
                          {{ revealedTitle }}
                          <span class="absolute -bottom-2 lg:-bottom-4 left-0 w-full h-1.5 lg:h-2.5 bg-gradient-to-r from-cyan-500/20 to-indigo-600/20 rounded-full overflow-hidden">
                            <span class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-300 to-transparent w-full animate-shimmer shadow-[0_0_15px_rgba(34,211,238,0.8)]"></span>
                          </span>
                        </span>
                      </h1>
                      <p :class="['text-base lg:text-lg mb-8 max-w-[400px] font-medium leading-relaxed transition-colors', isDark ? 'text-gray-400' : 'text-gray-500']">
                        BSIT Degree Holder | Aspiring Developer <br/>
                        Building strong foundations for long-term professional growth.
                      </p>
                      
                      <div class="flex items-center gap-4">
                        <button @click="scrollToSection('Contact')" class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-all">
                          Let's Talk
                        </button>
                        <button @click="scrollToSection('Showcase')" :class="['px-8 py-4 rounded-2xl font-black text-sm flex items-center gap-3 border transition-all hover:scale-105 active:scale-95', isDark ? 'bg-black border-white/10 text-white' : 'bg-white border-gray-200 text-black shadow-sm']">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#00D2FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                          View Projects
                        </button>
                      </div>
                    </div>

                    <!-- Profile Art -->
                    <div class="flex-1 flex justify-center items-center py-10 lg:py-0">
                      <div class="relative group">
                        <!-- Circle Loading Light Animation -->
                        <div class="absolute -inset-4 lg:-inset-6 rounded-full z-0 pointer-events-none">
                           <!-- Pulsing Base Glow -->
                           <div class="absolute inset-0 rounded-full bg-cyan-500/5 animate-pulse"></div>
                           <!-- Spinning Light Trail -->
                           <div class="absolute inset-0 rounded-full border-[2px] border-transparent border-t-cyan-500/40 border-r-indigo-500/20 animate-[spin_4s_linear_infinite]"></div>
                           <div class="absolute inset-0 rounded-full border-[1px] border-transparent border-b-cyan-400/30 animate-[spin_6s_linear_infinite_reverse]"></div>
                           <!-- Glowing Orbit Dot -->
                           <div class="absolute inset-0 animate-[spin_3s_linear_infinite]">
                              <div class="w-2 h-2 rounded-full bg-cyan-400 shadow-[0_0_15px_#22d3ee] absolute top-0 left-1/2 -translate-x-1/2"></div>
                           </div>
                        </div>

                        <div :class="['w-64 h-64 lg:w-96 lg:h-96 rounded-full overflow-hidden relative z-10 flex items-center justify-center transition-all duration-700', isDark ? 'bg-black shadow-[0_40px_80px_-20px_rgba(6,182,212,0.5),0_30px_40px_-10px_rgba(79,70,229,0.4)]' : 'bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]']">
                           <!-- Light Mode Video -->
                           <video src="/images/vid1.mp4" :class="['absolute inset-0 w-full h-full object-contain transition-opacity duration-700', isDark ? 'opacity-0' : 'opacity-100']" autoplay muted loop playsinline disablePictureInPicture></video>
                           <!-- Dark Mode Video -->
                           <video src="/images/vid2.mp4" :class="['absolute inset-0 w-full h-full object-contain transition-opacity duration-700', isDark ? 'opacity-100' : 'opacity-0']" autoplay muted loop playsinline disablePictureInPicture></video>
                        </div>

                        <transition-group name="fade-tech">
                           <div v-for="icon in floatingTech" :key="icon.id"
                             class="absolute pointer-events-none select-none z-50 transition-all duration-1000"
                             :style="{
                               left: icon.x + '%',
                               top: icon.y + '%',
                               transform: `scale(${icon.scale})`
                             }"
                           >
                             <div :class="['w-14 h-14 lg:w-16 lg:h-16 flex items-center justify-center rounded-2xl border backdrop-blur-md shadow-xl transition-all duration-1000 overflow-hidden relative', isDark ? 'bg-white/5 border-white/10' : 'bg-white/40 border-white/20']"
                                  :style="{ animation: `spin ${icon.spinDuration}s linear infinite ${icon.spinDirection}` }"
                             >
                                <!-- Gradient Logo Mask (Light Mode Unhovered) -->
                                <div v-if="icon.image && !isDark" 
                                     class="absolute m-auto inset-0 w-8 h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-cyan-400 to-indigo-500 z-20 transition-opacity duration-1000 group-hover:opacity-0"
                                     :style="{ 
                                        WebkitMaskImage: `url(${icon.image})`, WebkitMaskSize: 'contain', WebkitMaskRepeat: 'no-repeat', WebkitMaskPosition: 'center',
                                        maskImage: `url(${icon.image})`, maskSize: 'contain', maskRepeat: 'no-repeat', maskPosition: 'center'
                                     }">
                                </div>
                                
                                <img v-if="icon.image" :src="icon.image" :class="['relative z-10 w-8 h-8 lg:w-10 lg:h-10 object-contain transition-all duration-1000', !isDark ? 'opacity-0 group-hover:opacity-100 drop-shadow-md' : 'opacity-60 grayscale group-hover:grayscale-0 group-hover:opacity-100 filter drop-shadow-md']" />
                                <div v-else :class="['relative z-10 text-[8px] font-black uppercase tracking-widest truncate w-full text-center px-1 transition-all duration-1000', isDark ? 'text-cyan-500 opacity-40 group-hover:opacity-100' : 'text-transparent bg-clip-text bg-gradient-to-br from-cyan-400 to-indigo-500 group-hover:from-cyan-600 group-hover:to-cyan-600']">{{ icon.name }}</div>
                             </div>
                           </div>
                        </transition-group>
                      </div>
                    </div>
                  </section>

                  <!-- About Section -->
                  <section id="About" class="min-h-full flex flex-col justify-center px-6 lg:px-24 py-12 reveal-on-scroll">
                    <div class="max-w-6xl w-full flex flex-col md:flex-row items-center gap-16 mr-auto">
                      <!-- Left Side: Text and Metrics -->
                      <div class="flex-1 max-w-2xl">
                        <div class="mb-1">
                          <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-500 font-medium text-l">Hello, I'm</span>
                        </div>
                        <h2 :class="['text-4xl lg:text-[60px] font-black leading-none mb-6 transition-colors', isDark ? 'text-white' : 'text-black']">
                          Jho Mari Malaca
                        </h2>
                        <p :class="['text-lg lg:text-l leading-relaxed mb-8 transition-colors max-w-xl', isDark ? 'text-gray-400' : 'text-gray-600']">
                          I am studying Information Technology and specialize in Web Development, crafting modern and user-friendly websites with purpose and impact. <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-500 font-bold">Let's create something great together.</span>
                        </p>

                        <div class="flex items-center gap-6 mb-12">
                           <button @click="openResumeSection" class="px-10 py-5 bg-gradient-to-r from-[#00D2FF] to-[#4A5DFF] text-white rounded-2xl font-black text-sm transition-all hover:scale-105 active:scale-95 shadow-lg shadow-cyan-500/20">
                             Download CV
                           </button>
                           <button @click="scrollToSection('Contact')" :class="['px-10 py-5 rounded-2xl font-black text-sm flex items-center gap-3 border transition-all hover:scale-105 active:scale-95', isDark ? 'bg-black border-white/10 text-white' : 'bg-white border-gray-200 text-black shadow-sm']">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#00D2FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8"/></svg>
                              Contact Me
                           </button>
                        </div>

                        <!-- Metric Cards -->
                        <div :class="['grid grid-cols-1 md:grid-cols-3 gap-4 transition-all duration-500 max-w-xl', isDark ? 'opacity-60 hover:opacity-100' : 'opacity-100']">
                          <!-- Works Summary -->
                          <div @click="portfolioMode = 'Works'; activeNavItem = 'Showcase'" :class="['p-6 rounded-[24px] border transition-all duration-500 cursor-pointer group hover:-translate-y-2', isDark ? 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-cyan-500/30' : 'bg-white border-gray-200 shadow-md shadow-black/[0.06] hover:shadow-xl hover:border-cyan-300']">
                            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-500 flex items-center justify-center mb-4 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                            </div>
                            <div :class="['text-2xl font-black mb-1 tracking-tighter', isDark ? 'text-white' : 'text-black']">{{ projects.length }}+</div>
                            <div :class="['text-[10px] font-bold uppercase tracking-widest', isDark ? 'text-gray-500' : 'text-gray-400']">Works</div>
                          </div>

                          <!-- Certificates Summary -->
                          <div @click="portfolioMode = 'Certificates'; activeNavItem = 'Showcase'" :class="['p-6 rounded-[24px] border transition-all duration-500 cursor-pointer group hover:-translate-y-2', isDark ? 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-indigo-500/30' : 'bg-white border-gray-200 shadow-md shadow-black/[0.06] hover:shadow-xl hover:border-indigo-300']">
                            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center mb-4 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            </div>
                            <div :class="['text-2xl font-black mb-1 tracking-tighter', isDark ? 'text-white' : 'text-black']">{{ certificates.length }}+</div>
                            <div :class="['text-[10px] font-bold uppercase tracking-widest', isDark ? 'text-gray-500' : 'text-gray-400']">Certs</div>
                          </div>

                          <!-- Stack Summary -->
                          <div @click="portfolioMode = 'Stack'; activeNavItem = 'Showcase'" :class="['p-6 rounded-[24px] border transition-all duration-500 cursor-pointer group hover:-translate-y-2', isDark ? 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-cyan-500/30' : 'bg-white border-gray-200 shadow-md shadow-black/[0.06] hover:shadow-xl hover:border-cyan-300']">
                            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-500 flex items-center justify-center mb-4 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                            </div>
                            <div :class="['text-2xl font-black mb-1 tracking-tighter', isDark ? 'text-white' : 'text-black']">{{ techStacks.length }}+</div>
                            <div :class="['text-[10px] font-bold uppercase tracking-widest', isDark ? 'text-gray-500' : 'text-gray-400']">Stack</div>
                          </div>
                        </div>
                      </div>

                      <!-- Right Side: Profile Image Placeholder -->
                      <div class="flex-shrink-0 w-72 lg:w-96 flex justify-center items-center">
                        <div class="relative group">
                          <!-- Rotating Background Orbits (Restored Circular) -->
                          <div class="absolute -inset-4 rounded-full border-2 border-dashed border-cyan-500/50 animate-[spin_20s_linear_infinite] shadow-[0_0_15px_rgba(6,182,212,0.1)]"></div>
                          <div class="absolute -inset-8 rounded-full border border-indigo-500/40 animate-[spin_30s_linear_infinite_reverse] shadow-[0_0_20px_rgba(99,102,241,0.1)]"></div>
                          
                          <!-- Image Card -->
                          <div class="w-72 h-72 lg:w-96 lg:h-96 rounded-[60px] lg:rounded-[80px] bg-gradient-to-br from-cyan-400/20 to-indigo-600/20 overflow-hidden rotate-6 group-hover:rotate-0 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.16,1,0.3,1)] shadow-2xl relative border border-white/10 isolate" style="-webkit-mask-image: -webkit-radial-gradient(white, black);">
                             <div v-if="settings.portfolio?.aboutImages?.length > 0" class="w-full h-full relative rounded-[inherit] overflow-hidden">
                                <transition-group name="profile-fade" tag="div" class="w-full h-full relative rounded-[inherit] overflow-hidden">
                                  <div v-for="(img, idx) in settings.portfolio.aboutImages" 
                                       v-show="idx === currentAboutImageIndex"
                                       :key="idx" 
                                       class="absolute inset-0 w-full h-full rounded-[inherit] overflow-hidden">
                                     <img :src="img.data" alt="Profile About" class="w-full h-full object-cover -rotate-6 group-hover:rotate-0 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.16,1,0.3,1)] scale-110 opacity-100" />
                                  </div>
                                </transition-group>
                             </div>
                             <img v-else src="/images/profile_art.png" alt="Profile About" class="w-full h-full object-cover -rotate-6 group-hover:rotate-0 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.16,1,0.3,1)] scale-110 opacity-100" />
                             
                             <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent pointer-events-none rounded-[inherit]"></div>
                             
                             <!-- Floating "IT" Badge -->
                             <div class="absolute top-6 right-6 px-4 py-2 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 text-[10px] font-black uppercase tracking-tighter text-white">
                                Dev Joms
                             </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>

                  <!-- Showcase Summary Dashboard -->
                  <section id="Showcase" class="min-h-full flex flex-col justify-center px-6 lg:px-12 py-8 relative reveal-on-scroll">
                    <div class="text-center mb-5">
                       <h2 :class="['text-4xl font-black transition-colors mb-4', isDark ? 'text-white' : 'text-black']">
                          My <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-indigo-600">Showcase</span>
                       </h2>
                       <p :class="['text-sm  opacity-60', isDark ? 'text-gray-400' : 'text-gray-500']">
                         Explore my journey through projects, certifications, and technical expertise. Each section represents a milestone in my continuous learning path.
                       </p>
                    </div>

                    <!-- Centered Tab Navigation -->
                    <div class="flex justify-center mb-8">
                      <div :class="['p-1.5 rounded-2xl flex items-center gap-2 border', isDark ? 'bg-white/5 border-white/10' : 'bg-gray-100 border-gray-200']">
                        <button 
                          v-for="tab in ['Works', 'Certificates', 'Stack']" 
                          :key="tab"
                          @click="showcaseTab = tab"
                          :class="['px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-500', 
                            showcaseTab === tab 
                              ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-xl shadow-cyan-500/20 scale-105' 
                              : (isDark ? 'text-gray-500 hover:text-white' : 'text-gray-400 hover:text-black')
                          ]"
                        >
                          {{ tab === 'Stack' ? 'Tech Stack' : tab === 'Works' ? 'Projects' : tab }}
                        </button>
                      </div>
                    </div>

                    <!-- Inner Showcase Preview Content -->
                    <div class="min-h-[400px]">
                      <transition name="fade-slide" mode="out-in">
                        <!-- Works Tab Preview -->
                        <div v-if="showcaseTab === 'Works'" key="works-preview" class="space-y-12">
                          <div v-if="featuredProjects.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div v-for="project in featuredProjects" :key="project.id || project.title" @click="project.link ? window.open(project.link, '_blank') : null" :class="['p-8 rounded-[32px] border transition-all duration-500 group relative overflow-hidden', project.link ? 'cursor-pointer hover:-translate-y-2' : '', isDark ? 'bg-white/5 border-white/10 hover:border-cyan-500/30' : 'bg-white border-gray-200 shadow-md shadow-black/[0.06] hover:shadow-xl hover:border-cyan-300']">
                              <!-- Gradient accent line -->
                              <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                              <div class="w-full aspect-video rounded-2xl bg-gradient-to-br from-cyan-500/10 to-indigo-600/10 mb-6 flex items-center justify-center overflow-hidden relative group/thumb">
                                <!-- Hero Image fallback -->
                                <img v-if="project.image && (!project.files || project.files.length === 0)" :src="project.image" alt="Project Thumbnail" class="w-full h-full object-cover transition-transform group-hover:scale-105" />
                                
                                <!-- Showcase Gallery Loop -->
                                <div v-else-if="project.files?.length > 0" ref="showcaseGalleries" class="w-full h-full flex overflow-x-auto scroll-hide snap-x">
                                  <!-- If hero image exists, put it first in the loop -->
                                  <div v-if="project.image" class="w-full h-full flex-shrink-0 snap-center">
                                    <img :src="project.image" class="w-full h-full object-cover" />
                                  </div>
                                  <!-- Then the gallery files -->
                                  <div v-for="(file, fIdx) in project.files" :key="fIdx" class="w-full h-full flex-shrink-0 snap-center bg-black/20">
                                    <img v-if="file.type.startsWith('image/')" :src="file.data" class="w-full h-full object-cover" />
                                    <video v-else-if="file.type.startsWith('video/')" :src="file.data" class="w-full h-full object-cover" autoplay muted loop playsinline disablePictureInPicture controlsList="nopictureinpicture" disableRemotePlayback></video>
                                  </div>
                                </div>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-cyan-500/40 group-hover:scale-125 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 8h10"/><path d="M7 12h10"/><path d="M7 16h6"/></svg>
                                

                              </div>
                              <h3 :class="['text-xl font-black mb-2 flex items-center justify-between', isDark ? 'text-white' : 'text-black']">
                                {{ project.title || project.name }}
                              </h3>
                              <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">{{ project.summary }}</p>
                              
                              <div class="mt-6">
                                <button @click.stop="selectedProject = project" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-cyan-500 group-hover:gap-3 transition-all">
                                  View Details
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                                </button>
                              </div>
                            </div>

                          </div>
                          <div v-else class="py-24 flex flex-col items-center justify-center border-2 border-dashed border-white/5 rounded-[40px] bg-white/[0.01] animate-fade-in">
                            <div class="w-16 h-16 rounded-full bg-cyan-500/10 flex items-center justify-center text-cyan-500/40 mb-5">
                               <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                            </div>
                            <p class="text-gray-500 font-bold text-sm">No projects currently featured.</p>
                            <p class="text-[10px] text-gray-600 uppercase tracking-[0.2em] mt-1 font-black">Feature items in your admin panel to show them here.</p>
                          </div>
                          <div class="flex justify-center">
                            <button @click="portfolioMode = 'Works'; activeNavItem = 'Showcase'" class="group flex items-center gap-3 px-10 py-5 bg-cyan-500/10 text-cyan-500 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-cyan-500 hover:text-white transition-all">
                              See All Works <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                          </div>
                        </div>

                        <!-- Certificates Tab Preview -->
                        <div v-else-if="showcaseTab === 'Certificates'" key="certs-preview" class="space-y-12">
                          <div v-if="featuredCertificates.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div v-for="cert in featuredCertificates" :key="cert.title" @click="selectedProject = cert" :class="['p-6 rounded-[28px] border transition-all duration-500 group hover:-translate-y-1 text-left cursor-pointer relative overflow-hidden', isDark ? 'bg-white/5 border-white/10 hover:border-indigo-500/30' : 'bg-white border-gray-100 shadow-md shadow-black/[0.06] hover:shadow-xl hover:border-indigo-300']">
                              <!-- Gradient accent line -->
                              <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                              <!-- Icon + Year pill row -->
                              <div class="flex items-start justify-between mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30 flex-shrink-0">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                                </div>
                                <span v-if="cert.year_issued" class="text-[10px] font-black px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-widest">{{ cert.year_issued }}</span>
                              </div>
                              <!-- Title -->
                              <h3 :class="['text-base font-black mb-1 leading-snug line-clamp-2', isDark ? 'text-white' : 'text-black']">{{ cert.title }}</h3>
                              <!-- Issuer -->
                              <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-3">{{ cert.issuer || 'Verified Partner' }}</p>
                              <!-- Description -->
                              <p :class="['text-xs leading-relaxed line-clamp-3', isDark ? 'text-gray-500' : 'text-gray-400']">{{ cert.description || 'Verified certification for excellence in software development.' }}</p>
                            </div>
                          </div>
                          <div v-else class="py-24 flex flex-col items-center justify-center border-2 border-dashed border-white/5 rounded-[40px] bg-white/[0.01] animate-fade-in">
                            <div class="w-16 h-16 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-500/40 mb-5">
                               <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            </div>
                            <p class="text-gray-500 font-bold text-sm">No certifications currently featured.</p>
                            <p class="text-[10px] text-gray-600 uppercase tracking-[0.2em] mt-1 font-black">Feature items in your admin panel to show them here.</p>
                          </div>

                          <div class="flex justify-center">
                            <button @click="portfolioMode = 'Certificates'; activeNavItem = 'Showcase'" class="group flex items-center gap-3 px-10 py-5 bg-indigo-500/10 text-indigo-500 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-indigo-500 hover:text-white transition-all">
                              View More Certs <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                          </div>
                        </div>

                          <!-- Stack Tab Preview -->
                          <div v-else-if="showcaseTab === 'Stack'" key="stack-preview" class="space-y-16">
                            <div v-if="featuredStacks.length > 0" class="flex flex-wrap justify-center gap-12">
                              <div v-for="skill in featuredStacks" :key="skill.name"
                                    :class="['flex flex-col items-center gap-1.5 transition-all duration-500 group cursor-default', activeStackName === skill.name ? 'scale-110' : 'hover:scale-110']">
                                  <!-- Icon/Indicator -->
                                  <div :class="['w-12 h-12 flex items-center justify-center transition-all duration-500 relative', activeStackName === skill.name ? 'scale-110 rotate-12' : 'group-hover:scale-110 group-hover:rotate-12']">
                                    <svg v-if="!skill.image" xmlns="http://www.w3.org/2000/svg" :class="['w-7 h-7 transition-all duration-500', isDark ? (activeStackName === skill.name ? 'text-cyan-500 drop-shadow-[0_0_8px_rgba(6,182,212,0.6)]' : 'text-white/20 group-hover:text-cyan-500 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.6)]') : (activeStackName === skill.name ? 'text-cyan-500 drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]' : 'text-gray-300 group-hover:text-cyan-500 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]')]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="12" x="3" y="4" rx="2" ry="2"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
                                    <img v-else :src="skill.image" :class="['w-8 h-8 object-contain transition-all duration-500 filter', activeStackName === skill.name ? 'grayscale-0 drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]' : 'grayscale group-hover:grayscale-0 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]']" alt="Tech Logo" />
                                  </div>

                                  <span :class="['text-xs font-black tracking-[0.1em] uppercase transition-all duration-500', isDark ? (activeStackName === skill.name ? 'text-white' : 'text-white/20 group-hover:text-white') : (activeStackName === skill.name ? 'text-black' : 'text-gray-300 group-hover:text-black')]">{{ skill.name }}</span>
                              </div>
                            </div>
                            <div v-else class="py-24 flex flex-col items-center justify-center border-2 border-dashed border-white/5 rounded-[40px] bg-white/[0.01] animate-fade-in">
                              <div class="w-16 h-16 rounded-full bg-cyan-500/10 flex items-center justify-center text-cyan-500/40 mb-5">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                              </div>
                              <p class="text-gray-500 font-bold text-sm">No tech stacks currently featured.</p>
                              <p class="text-[10px] text-gray-600 uppercase tracking-[0.2em] mt-1 font-black">Feature items in your admin panel to show them here.</p>
                            </div>
                          <div class="flex justify-center">
                            <button @click="portfolioMode = 'Stack'; activeNavItem = 'Showcase'" class="group flex items-center gap-3 px-10 py-5 bg-cyan-500/10 text-cyan-500 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-cyan-500 hover:text-white transition-all">
                              Explore Full Stack <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                          </div>
                        </div>
                      </transition>
                    </div>
                  </section>

                  <!-- Contact / Footer Section with Multiple Waves -->
                  <section id="Contact" class="relative mt-16 reveal-on-scroll">
                    
                    <!-- Section Header -->
                    <div class="text-center mb-8 pt-8 relative z-30">
                      <h2 :class="['text-4xl lg:text-5xl font-black tracking-tight mb-3 transition-colors', isDark ? 'text-white' : 'text-gray-900']">
                        Get in <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-500">Touch</span>
                      </h2>
                      <p :class="['text-sm lg:text-base font-medium max-w-md mx-auto transition-colors', isDark ? 'text-gray-400' : 'text-indigo-900/60']">
                        Interested in working together? Drop me a line or visit my socials.
                      </p>
                    </div>

                    <!-- Overlapping Wave Container -->
                    <div class="relative w-full" style="height: 70px;">
                      <!-- Wave Layer 1 (Back - Tallest, widest curves) -->
                      <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="absolute bottom-0 left-0 w-full z-0" style="height: 220px;">
                        <defs>
                          <linearGradient :id="'wave1-grad'" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" :stop-color="isDark ? '#0891b2' : '#06b6d4'" />
                            <stop offset="100%" :stop-color="isDark ? '#4f46e5' : '#6366f1'" />
                          </linearGradient>
                        </defs>
                        <path fill="url(#wave1-grad)" fill-opacity="0.35" d="M0,160L48,170.7C96,181,192,203,288,202.7C384,203,480,181,576,165.3C672,149,768,139,864,149.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                          <animate attributeName="d" dur="8s" repeatCount="indefinite" values="
                            M0,160L48,170.7C96,181,192,203,288,202.7C384,203,480,181,576,165.3C672,149,768,139,864,149.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z;
                            M0,192L48,181.3C96,171,192,149,288,154.7C384,160,480,192,576,202.7C672,213,768,203,864,186.7C960,171,1056,149,1152,149.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z;
                            M0,160L48,170.7C96,181,192,203,288,202.7C384,203,480,181,576,165.3C672,149,768,139,864,149.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z
                          "/>
                        </path>
                      </svg>

                      <!-- Wave Layer 2 (Middle) -->
                      <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="absolute bottom-0 left-0 w-full z-10" style="height: 200px;">
                        <defs>
                          <linearGradient :id="'wave2-grad'" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" :stop-color="isDark ? '#0891b2' : '#06b6d4'" />
                            <stop offset="100%" :stop-color="isDark ? '#4f46e5' : '#6366f1'" />
                          </linearGradient>
                        </defs>
                        <path fill="url(#wave2-grad)" fill-opacity="0.6" d="M0,224L60,213.3C120,203,240,181,360,181.3C480,181,600,203,720,213.3C840,224,960,224,1080,208C1200,192,1320,160,1380,144L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                          <animate attributeName="d" dur="6s" repeatCount="indefinite" values="
                            M0,224L60,213.3C120,203,240,181,360,181.3C480,181,600,203,720,213.3C840,224,960,224,1080,208C1200,192,1320,160,1380,144L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z;
                            M0,192L60,197.3C120,203,240,213,360,218.7C480,224,600,224,720,208C840,192,960,160,1080,160C1200,160,1320,192,1380,208L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z;
                            M0,224L60,213.3C120,203,240,181,360,181.3C480,181,600,203,720,213.3C840,224,960,224,1080,208C1200,192,1320,160,1380,144L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z
                          "/>
                        </path>
                      </svg>

                      <!-- Wave Layer 3 (Front - Shortest, tightest curves) -->
                      <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="absolute bottom-0 left-0 w-full z-0" style="height: 190px;">
                        <defs>
                          <linearGradient :id="'wave3-grad'" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" :stop-color="isDark ? '#0891b2' : '#06b6d4'" />
                            <stop offset="100%" :stop-color="isDark ? '#4f46e5' : '#6366f1'" />
                          </linearGradient>
                        </defs>
                        <path fill="url(#wave3-grad)" fill-opacity="1" d="M0,256L80,250.7C160,245,320,235,480,234.7C640,235,800,245,960,250.7C1120,256,1280,256,1360,256L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                          <animate attributeName="d" dur="5s" repeatCount="indefinite" values="
                            M0,256L80,250.7C160,245,320,235,480,234.7C640,235,800,245,960,250.7C1120,256,1280,256,1360,256L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z;
                            M0,245L80,250.7C160,256,320,267,480,261.3C640,256,800,235,960,229.3C1120,224,1280,235,1360,240L1440,245L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z;
                            M0,256L80,250.7C160,245,320,235,480,234.7C640,235,800,245,960,250.7C1120,256,1280,256,1360,256L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z
                          "/>
                        </path>
                      </svg>
                    </div>

                    <!-- Main Footer Content Area -->
                    <div :class="['relative z-30 transition-all duration-500']" :style="{ background: isDark ? 'linear-gradient(to right, #0891b2, #4f46e5)' : 'linear-gradient(to right, #06b6d4, #6366f1)', marginTop: '-2px' }">
                      <div class="max-w-5xl mx-auto px-6 lg:px-12 pt-8 pb-6">
                        <!-- Contact Layout Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-12">
                            
                            <!-- Left Side: Cards -->
                            <div class="lg:col-span-5 flex flex-col gap-4">
                              <div class="text-white mb-2 ml-2">
                                <h3 class="text-2xl font-black tracking-tight mb-1">Direct Contact</h3>
                                <p class="text-white/70 text-sm font-medium">Reach out via these platforms anytime.</p>
                              </div>
                              <!-- Facebook Card -->
                              <a :href="settings.social.facebook || '#'" target="_blank" class="group p-5 rounded-[24px] border border-white/20 bg-white/10 backdrop-blur-xl transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl hover:bg-white/20 hover:border-white/40 flex items-center gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-black/10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                  <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1 text-white/70">Facebook</p>
                                  <p class="text-sm font-semibold text-white truncate w-full">{{ settings.social.facebook?.replace(/^https?:\/\/(www\.)?/, '') || 'Facebook Profile' }}</p>
                                </div>
                              </a>

                              <!-- Email Card -->
                              <div 
                                @click="contactViaGmail"
                                class="group p-5 rounded-[24px] border border-white/20 bg-white/10 backdrop-blur-xl transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl hover:bg-white/20 hover:border-white/40 flex items-center gap-5 cursor-pointer"
                              >
                                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-black/10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                  <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1 text-white/70">Email Address</p>
                                  <p class="text-sm font-semibold text-white truncate w-full">{{ settings.social.gmail }}</p>
                                </div>
                              </div>

                              <!-- Phone Card -->
                              <a :href="getViberLink(settings.social.viber)" target="_blank" class="group p-5 rounded-[24px] border border-white/20 bg-white/10 backdrop-blur-xl transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl hover:bg-white/20 hover:border-white/40 flex items-center gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-black/10 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                  <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1 text-white/70">Phone / Viber</p>
                                  <p class="text-sm font-semibold text-white truncate w-full">{{ settings.social.viber || '0965-710-9042' }}</p>
                                </div>
                              </a>

                              <!-- Response Expectation Text -->
                              <div class="mt-2 flex items-center gap-2 px-6 py-3 rounded-2xl bg-white/10 border border-white/20 text-white/90 text-[10px] sm:text-xs font-bold tracking-wide">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                Please expect a response within 24 hours
                              </div>
                            </div>

                            <!-- Right Side: Contact Form -->
                            <div class="lg:col-span-7">
                              <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-[32px] shadow-2xl h-full flex flex-col justify-center">
                                <h3 class="text-2xl font-black text-white tracking-tight mb-6 text-center">Send Me a Message</h3>
                                <form @submit.prevent="handleContactSubmit" class="space-y-4 text-left">
                                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1.5">
                                      <label class="text-[10px] font-black uppercase tracking-widest text-white/70 ml-2">Your Name</label>
                                      <input v-model="contactForm.name" type="text" required placeholder="Input Your Name" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/40 focus:outline-none focus:border-white/40 focus:bg-white/20 transition-all font-medium text-sm">
                                    </div>
                                    <div class="space-y-1.5">
                                      <label class="text-[10px] font-black uppercase tracking-widest text-white/70 ml-2">Email Address</label>
                                      <input v-model="contactForm.email" type="email" required placeholder="Input Your Email (name@example.com) " class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/40 focus:outline-none focus:border-white/40 focus:bg-white/20 transition-all font-medium text-sm">
                                    </div>
                                  </div>
                                  <div class="space-y-1.5">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-white/70 ml-2">Your Message</label>
                                    <textarea v-model="contactForm.message" required rows="4" placeholder="How can I help you?" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/40 focus:outline-none focus:border-white/40 focus:bg-white/20 transition-all font-medium text-sm resize-none"></textarea>
                                  </div>
                                  <button type="submit" class="w-full mt-2 py-4 bg-white text-indigo-600 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg hover:shadow-xl hover:-translate-y-1 hover:bg-gray-50 active:scale-95 transition-all flex items-center justify-center gap-2">
                                    Send Message
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                  </button>
                                </form>
                              </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="h-px w-24 mx-auto mb-6 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>

                        <!-- Footer Bar -->
                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-4 pb-3">
                          <!-- Right Side: Copyright (Social Icons Removed) -->
                          <div class="flex items-center justify-end gap-2 text-xs font-bold text-white/60">
                            <span class="text-white font-black text-sm">JOMs</span>
                            <span>© {{ new Date().getFullYear() }} All rights reserved.</span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </section>
                </div>

                <!-- Detailed Works View -->
                <div v-else-if="portfolioMode === 'Works'" key="works" class="flex-1 overflow-y-auto px-10 py-16 scroll-hide relative">
                  <div class="max-w-5xl mx-auto">
                    <!-- Header moved to Top Bar -->
                     <div :class="['transition-all duration-500', worksViewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 gap-10' : 'space-y-6']">
                        <div v-for="project in projects" :key="project.id || project.title" @click="selectedProject = project" :class="['rounded-[28px] border transition-all duration-500 group cursor-pointer hover:-translate-y-1 flex relative overflow-hidden', worksViewMode === 'grid' ? 'flex-col p-8' : 'flex-col md:flex-row gap-8 items-center p-5', isDark ? 'bg-white/5 border-white/10 hover:border-cyan-500/30' : 'bg-white border-gray-200 shadow-md shadow-black/[0.04] hover:shadow-xl hover:border-cyan-300']">
                              <!-- Gradient accent lines -->
                              <div :class="['absolute opacity-0 group-hover:opacity-100 transition-all duration-500', worksViewMode === 'grid' ? 'top-0 left-0 w-full h-1 bg-gradient-to-r' : 'top-0 right-0 h-full w-1 bg-gradient-to-b', 'from-cyan-500 to-indigo-600']"></div>
                              <div v-if="worksViewMode === 'list'" class="absolute top-0 left-0 h-full w-1 bg-gradient-to-b from-cyan-500 to-indigo-600 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                              <div :class="['rounded-2xl bg-gradient-to-br from-cyan-500/10 to-indigo-600/10 flex items-center justify-center overflow-hidden relative group/thumb transition-all duration-500 shrink-0', worksViewMode === 'grid' ? 'w-full aspect-video mb-6' : 'w-full md:w-60 aspect-video md:mb-0']">
                                <!-- Hero Image fallback -->
                                <img v-if="project.image && (!project.files || project.files.length === 0)" :src="project.image" alt="Project Thumbnail" class="w-full h-full object-cover transition-transform group-hover:scale-105" />
                                
                                <!-- Showcase Gallery Loop -->
                                <div v-else-if="project.files?.length > 0" ref="portfolioGalleries" class="w-full h-full flex overflow-x-auto scroll-hide snap-x">
                                  <!-- If hero image exists, put it first in the loop -->
                                  <div v-if="project.image" class="w-full h-full flex-shrink-0 snap-center">
                                    <img :src="project.image" class="w-full h-full object-cover" />
                                  </div>
                                  <!-- Then the gallery files -->
                                  <div v-for="(file, fIdx) in project.files" :key="fIdx" class="w-full h-full flex-shrink-0 snap-center bg-black/20">
                                    <img v-if="file.type.startsWith('image/')" :src="file.data" class="w-full h-full object-cover" />
                                    <video v-else-if="file.type.startsWith('video/')" :src="file.data" class="w-full h-full object-cover" autoplay muted loop playsinline disablePictureInPicture controlsList="nopictureinpicture" disableRemotePlayback></video>
                                  </div>
                                </div>

                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-cyan-500/40 group-hover:scale-125 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 8h10"/><path d="M7 12h10"/><path d="M7 16h6"/></svg>
                              </div>

                              <div class="flex-1 flex flex-col h-full w-full">
                                <h3 :class="['font-black mb-1 flex items-center justify-between', worksViewMode === 'grid' ? 'text-xl' : 'text-lg', isDark ? 'text-white' : 'text-black']">
                                  {{ project.title || project.name }}
                                </h3>
                                <p :class="['text-gray-500 leading-relaxed line-clamp-2 mb-4', worksViewMode === 'grid' ? 'text-xs' : 'text-sm']">{{ project.summary }}</p>
                                
                                <div class="mt-auto">
                                  <button @click.stop="selectedProject = project" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-cyan-500 group-hover:gap-3 transition-all">
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                                  </button>
                                </div>
                              </div>
                        </div>

                    </div>
                  </div>
                </div>

                <!-- Detailed Certificates View -->
                <div v-else-if="portfolioMode === 'Certificates'" key="certs" class="flex-1 overflow-y-auto px-10 py-16 scroll-hide relative">
                  <div class="max-w-5xl mx-auto text-center">
                    <!-- Header moved to Top Bar -->
                      
                      <div :class="['transition-all duration-500', certsViewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-3 gap-8' : 'space-y-6']">
                        <div v-for="cert in certificates" :key="cert.title" @click="selectedProject = cert" :class="['rounded-[28px] border transition-all duration-500 group hover:-translate-y-1 text-left relative overflow-hidden cursor-pointer flex', certsViewMode === 'grid' ? 'flex-col p-8' : 'flex-col md:flex-row gap-8 items-center p-5', isDark ? 'border-white/10 bg-white/5 hover:border-indigo-500/30' : 'border-gray-200 bg-white shadow-md shadow-black/[0.04] hover:shadow-xl hover:border-indigo-300']">
                            <!-- Gradient accent lines -->
                            <div :class="['absolute opacity-0 group-hover:opacity-100 transition-all duration-500', certsViewMode === 'grid' ? 'top-0 left-0 w-full h-1 bg-gradient-to-r' : 'top-0 right-0 h-full w-1 bg-gradient-to-b', 'from-indigo-500 to-purple-600']"></div>
                            <div v-if="certsViewMode === 'list'" class="absolute top-0 left-0 h-full w-1 bg-gradient-to-b from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>

                            <!-- Icon Left for List, Top for Grid -->
                            <div :class="['flex-shrink-0', certsViewMode === 'grid' ? 'mb-6' : '']">
                              <div :class="['rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-xl shadow-indigo-500/30 transition-all duration-500', certsViewMode === 'grid' ? 'w-16 h-16' : 'w-20 h-20']">
                                <svg xmlns="http://www.w3.org/2000/svg" :class="[certsViewMode === 'grid' ? 'w-8 h-8' : 'w-10 h-10']" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                              </div>
                            </div>

                            <div class="flex-1 flex flex-col h-full w-full">
                              <div class="flex items-start justify-between mb-2">
                                <h3 :class="['font-black leading-snug', certsViewMode === 'grid' ? 'text-xl' : 'text-lg', isDark ? 'text-white' : 'text-black']">{{ cert.title }}</h3>
                                <span v-if="cert.year_issued" class="text-[9px] font-black px-2 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-widest whitespace-nowrap ml-4">{{ cert.year_issued }}</span>
                              </div>

                              <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-3">{{ cert.issuer || 'Verified Partner' }}</p>
                              
                              <p :class="['leading-relaxed mb-6 line-clamp-2', certsViewMode === 'grid' ? 'text-sm' : 'text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">{{ cert.description || 'Verified certification for excellence.' }}</p>

                              <!-- Footer Action -->
                              <div class="mt-auto flex items-center justify-between">
                                <span class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400 group-hover:gap-3 transition-all">
                                   View Certificate
                                   <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                                </span>
                              </div>
                            </div>
                        </div>
                      </div>

                  </div>
                </div>

                <!-- Detailed Stack View -->
                <div v-else-if="portfolioMode === 'Stack'" key="stack" class="flex-1 overflow-y-auto px-10 py-16 scroll-hide relative">
                  <div class="max-w-5xl mx-auto">
                    <!-- Header moved to Top Bar -->
                      
                       <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-20">
                         <div v-for="category in ['Frontend', 'Backend', 'Tools']" :key="category"
                              :class="['p-8 lg:p-10 rounded-[48px] border-2 transition-all duration-500 relative overflow-hidden group/cat', isDark ? 'bg-white/[0.02] border-white/10 hover:border-cyan-500/40' : 'bg-white border-gray-200/50 shadow-2xl shadow-black/5 hover:border-cyan-500/20']">
                          
                          <!-- Subtle Background Glow for each box -->
                          <div class="absolute -top-24 -right-24 w-48 h-48 bg-cyan-500/5 blur-[80px] group-hover/cat:bg-cyan-500/10 transition-colors duration-500"></div>

                          <!-- Category Section Header -->
                          <div class="flex items-center gap-4 mb-10">
                            <h3 :class="['text-xl font-black uppercase tracking-[0.2em]', isDark ? 'text-white' : 'text-black']">
                              {{ category }}
                            </h3>
                            <div class="flex-1 h-px bg-gradient-to-r from-cyan-500/40 via-indigo-500/10 to-transparent"></div>
                          </div>

                          <div class="flex flex-wrap gap-8">
                            <div v-for="skill in techStacks.filter(s => s.category === category)" :key="skill.name"
                                   :class="['flex flex-col items-center gap-1.5 transition-all duration-500 group cursor-default', activeStackName === skill.name ? 'scale-110' : 'hover:scale-110']">

                                 <!-- Icon/Indicator -->
                                 <div :class="['w-12 h-12 flex items-center justify-center transition-all duration-500 relative', activeStackName === skill.name ? 'scale-110 rotate-12' : 'group-hover:scale-110 group-hover:rotate-12']">
                                   <svg v-if="!skill.image" xmlns="http://www.w3.org/2000/svg" :class="['w-7 h-7 transition-all duration-500', isDark ? (activeStackName === skill.name ? 'text-cyan-500 drop-shadow-[0_0_8px_rgba(6,182,212,0.6)]' : 'text-white/20 group-hover:text-cyan-500 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.6)]') : (activeStackName === skill.name ? 'text-cyan-500 drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]' : 'text-gray-300 group-hover:text-cyan-500 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]')]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="12" x="3" y="4" rx="2" ry="2"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
                                   <img v-else :src="skill.image" :class="['w-8 h-8 object-contain transition-all duration-500 filter', activeStackName === skill.name ? 'grayscale-0 drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]' : 'grayscale group-hover:grayscale-0 group-hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.4)]']" alt="Tech Logo" />
                                 </div>

                                 <span :class="['text-xs font-black tracking-[0.1em] uppercase transition-all duration-500', isDark ? (activeStackName === skill.name ? 'text-white' : 'text-white/20 group-hover:text-white') : (activeStackName === skill.name ? 'text-black' : 'text-gray-300 group-hover:text-black')]">{{ skill.name }}</span>

                            </div>
                          </div>
                        </div>

                      </div>
                  </div>
                </div>
              </transition>
            </div>

            <!-- Resume View -->
            <main v-else-if="activeMainTab === 'Resume'" key="resume" class="absolute inset-0 p-6 lg:p-12 flex flex-col pt-12 lg:pt-0 overflow-hidden">
                <!-- Normal HTML View -->
                <div v-if="resumeViewMode === 'normal'" class="h-full flex flex-col overflow-hidden">
                    <!-- Resume Content (Blurred if not authorized) -->
                <div :class="['h-full overflow-y-auto scroll-hide pr-2 pb-12 flex flex-col gap-12 transition-all duration-700', !isResumeAuthorized ? 'blur-lg pointer-events-none scale-100 opacity-80' : '']">
                    
                    <!-- Header / Basic Info -->
                    <div class="flex flex-col-reverse md:flex-row justify-between items-center gap-10 border-b border-gray-200 dark:border-white/10 pb-12">
                       <!-- Text Content -->
                       <div class="flex-1 text-center md:text-left">
                           <h1 :class="['text-4xl lg:text-6xl font-black mb-4 tracking-tighter transition-colors', isDark ? 'text-white' : 'text-black']">{{ resumeData.basicInfo.name || 'Your Name' }}</h1>
                           <div :class="['flex flex-col justify-center md:justify-start gap-2.5 text-sm font-medium opacity-90', isDark ? 'text-gray-300' : 'text-gray-600']">
                              <span class="flex items-center gap-2.5"><svg class="w-4 h-4 text-cyan-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> {{ resumeData.basicInfo.contact }}</span>
                              <span class="flex items-center gap-2.5"><svg class="w-4 h-4 text-cyan-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg> {{ resumeData.basicInfo.email }}</span>
                              <span class="flex items-center gap-2.5"><svg class="w-4 h-4 text-cyan-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg> {{ resumeData.basicInfo.address }}</span>
                           </div>
                       </div>

                       <!-- Profile Image with Gradient Border (Dual Mode Support) -->
                       <div v-if="resumeData.basicInfo.profileImageLight || resumeData.basicInfo.profileImageDark" class="p-[3.5px] bg-gradient-to-br from-cyan-400 via-indigo-500 to-purple-600 rounded-[19px] flex-shrink-0 animate-fade-in shadow-xl shadow-cyan-500/10">
                           <div class="w-32 h-32 lg:w-44 lg:h-44 rounded-[15px] overflow-hidden bg-black flex-shrink-0">
                               <img 
                                 :src="isDark ? (resumeData.basicInfo.profileImageDark || resumeData.basicInfo.profileImageLight) : (resumeData.basicInfo.profileImageLight || resumeData.basicInfo.profileImageDark)" 
                                 alt="Profile" 
                                 class="w-full h-full object-cover" 
                               />
                           </div>
                       </div>
                    </div>

                    <!-- Career Objective -->
                    <section v-if="resumeData.careerObjective">
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-indigo-600 mb-4">Career Objective</h2>
                        <p :class="['text-base lg:text-lg leading-relaxed font-medium transition-colors max-w-4xl', isDark ? 'text-gray-300' : 'text-gray-700']">
                            {{ resumeData.careerObjective }}
                        </p>
                    </section>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8">
                        
                        <!-- Left Column (Experience & Education) -->
                        <div class="lg:col-span-7 space-y-12">
                            <!-- Work Experience -->
                            <section v-if="resumeData.workExperience && resumeData.workExperience.length > 0">
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-600 mb-6 flex items-center gap-2">Work Experience</h2>
                                <div class="space-y-6">
                                    <div v-for="(exp, idx) in resumeData.workExperience" :key="idx" :class="['p-6 rounded-3xl transition-all duration-300 border flex flex-col relative group overflow-hidden', isDark ? 'bg-white/5 border-white/10 hover:bg-white/[0.08]' : 'bg-gray-50 border-gray-100 hover:bg-gray-100/80']">
                                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-amber-500 to-orange-600 transform -translate-x-1 group-hover:translate-x-0 transition-transform"></div>
                                        <span class="text-xs font-black tracking-widest uppercase opacity-50 mb-1" :class="isDark ? 'text-white' : 'text-black'">{{ exp.year }}</span>
                                        <h3 :class="['text-xl font-bold transition-colors mb-1', isDark ? 'text-white' : 'text-black']">{{ exp.position }}</h3>
                                        <p :class="['text-amber-500 font-bold text-sm mb-2']">{{ exp.company }}</p>
                                        <p :class="['text-xs font-medium opacity-60', isDark ? 'text-gray-300' : 'text-gray-500']">{{ exp.address }}</p>
                                    </div>
                                </div>
                            </section>

                            <!-- Educational Background -->
                            <section v-if="resumeData.educationalBackground && resumeData.educationalBackground.length > 0">
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600 mb-6 flex items-center gap-2">Educational Background</h2>
                                <div class="space-y-6">
                                    <div v-for="(edu, idx) in resumeData.educationalBackground" :key="idx" :class="['p-6 rounded-3xl transition-all duration-300 border flex flex-col relative group overflow-hidden', isDark ? 'bg-white/5 border-white/10 hover:bg-white/[0.08]' : 'bg-gray-50 border-gray-100 hover:bg-gray-100/80']">
                                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-teal-600 transform -translate-x-1 group-hover:translate-x-0 transition-transform"></div>
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="text-[10px] font-black tracking-widest text-emerald-500 uppercase bg-emerald-500/10 px-2 py-1 rounded-md">{{ edu.level }}</span>
                                            <span class="text-xs font-black tracking-widest uppercase opacity-50" :class="isDark ? 'text-white' : 'text-black'">{{ edu.year }}</span>
                                        </div>
                                        <h3 :class="['text-xl font-bold transition-colors mt-2 mb-0.5', isDark ? 'text-white' : 'text-black']">{{ edu.school }}</h3>
                                        <p v-if="edu.course" class="text-sm font-bold text-emerald-500 mb-1.5">{{ edu.course }}</p>
                                        <p :class="['text-xs font-medium opacity-60 mt-1', isDark ? 'text-gray-300' : 'text-gray-500']">{{ edu.address }}</p>
                                    </div>
                                </div>
                            </section>
                            
                            <!-- Seminars / Trainings -->
                            <section v-if="resumeData.trainings && resumeData.trainings.length > 0">
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-600 mb-6 flex items-center gap-2">Seminars & Trainings</h2>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div v-for="(training, idx) in resumeData.trainings" :key="idx" :class="['p-5 rounded-2xl transition-all duration-300 border', isDark ? 'bg-white/5 border-white/10' : 'bg-white border-gray-200']">
                                        <p class="text-xs font-black tracking-widest uppercase opacity-50 mb-2 truncate" :class="isDark ? 'text-white' : 'text-black'">{{ training.date_issued }}</p>
                                        <h3 :class="['text-sm font-bold mb-1 transition-colors leading-tight', isDark ? 'text-white' : 'text-black']">{{ training.name }}</h3>
                                        <p class="text-[10px] uppercase font-black tracking-wider text-blue-500 truncate">{{ training.issuer }}</p>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <!-- Right Column (Skills, Info, References) -->
                        <div class="lg:col-span-5 space-y-12">
                            <!-- Skills -->
                            <section v-if="resumeData.skills && resumeData.skills.length > 0">
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-indigo-600 mb-6">Core Skills</h2>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="(skill, idx) in resumeData.skills" :key="idx" :class="['px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider border transition-colors', isDark ? 'bg-white/5 text-gray-300 border-white/10' : 'bg-gray-100 text-gray-700 border-gray-200']">
                                        {{ skill }}
                                    </span>
                                </div>
                            </section>

                            <!-- Personal Information -->
                            <section>
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-600 mb-6">Personal details</h2>
                                <div :class="['p-6 rounded-3xl border transition-colors', isDark ? 'bg-white/5 border-white/10' : 'bg-gray-50 border-gray-200']">
                                   <div class="space-y-4">
                                      <div v-for="(val, key) in resumeData.personalInfo" :key="key" v-show="val" class="flex justify-between items-center border-b border-gray-200 dark:border-white/5 pb-3 last:border-0 last:pb-0">
                                         <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ key.replace(/([A-Z])/g, ' $1').trim() }}</span>
                                         <span class="text-sm font-bold capitalize text-right" :class="isDark ? 'text-white' : 'text-black'">{{ val }}</span>
                                      </div>
                                   </div>
                                </div>
                            </section>

                            <!-- Character References -->
                            <section v-if="resumeData.references && resumeData.references.length > 0">
                                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-rose-600 mb-6">Character References</h2>
                                <div class="space-y-4">
                                    <div v-for="(ref, idx) in resumeData.references" :key="idx" :class="['p-5 rounded-3xl border transition-colors', isDark ? 'bg-white/5 border-white/10' : 'bg-white border-gray-200']">
                                        <h3 :class="['text-base font-bold mb-1', isDark ? 'text-white' : 'text-black']">{{ ref.name }}</h3>
                                        <p class="text-xs font-bold text-red-500 mb-2">{{ ref.position }} &bull; <span class="opacity-70 text-gray-500 font-medium">{{ ref.company }}</span></p>
                                        <div class="flex flex-col gap-1 text-[10px] font-medium tracking-wide" :class="isDark ? 'text-gray-400' : 'text-gray-500'">
                                            <span v-if="ref.email" class="flex items-center gap-2"><svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg> {{ ref.email }}</span>
                                            <span v-if="ref.contact" class="flex items-center gap-2"><svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> {{ ref.contact }}</span>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                    </div>
                </div>

                 <!-- PDF Viewer Mode -->
                 <div v-if="resumeViewMode === 'pdf'" class="h-full flex flex-col overflow-hidden animate-fade-in relative">
                    <div :class="['h-full w-full rounded-[40px] overflow-hidden border shadow-2xl transition-all duration-700 pb-12', isDark ? 'bg-black/40 border-white/5 shadow-white/5' : 'bg-gray-50 border-gray-100', !isResumeAuthorized ? 'blur-lg pointer-events-none' : '']">
                       <iframe v-if="resumeData.basicInfo.resumePdf" :src="resumeData.basicInfo.resumePdf" class="w-full h-full border-0 rounded-[30px]" title="Resume PDF View"></iframe>
                    </div>
                 </div>

                <!-- Private Overlay -->
                <div v-if="!isResumeAuthorized" class="absolute inset-0 z-[10] flex items-center justify-center p-6 bg-transparent">
                  <div class="flex flex-col items-center text-center space-y-8 animate-fade-in group">
                     <!-- Animated Lock Icon -->
                     <button @click="requestResumeAccess" class="relative group active:scale-95 transition-all">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-indigo-600 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div :class="['w-24 h-24 rounded-full border flex items-center justify-center shadow-2xl relative z-10 transition-all duration-500', isDark ? 'bg-[#151515] border-white/10 group-hover:border-white/30' : 'bg-white border-gray-200 group-hover:border-cyan-200']">
                           <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 transition-all duration-500 group-hover:scale-110" :class="isDark ? 'text-cyan-400' : 'text-cyan-600'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                     </button>
                     
                     <div class="space-y-3 max-w-sm">
                        <h3 :class="['text-2xl font-black tracking-tight', isDark ? 'text-white' : 'text-black']">Private Access Required</h3>
                        <p :class="['text-sm font-medium leading-relaxed opacity-60', isDark ? 'text-gray-300' : 'text-gray-600']">This section contains sensitive professional information. Enter an approved email to unlock the resume or submit an access request.</p>
                      </div>

                     <button 
                        @click="requestResumeAccess"
                        class="px-10 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-indigo-600 text-white font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-3"
                     >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                        Request Resume
                     </button>
                  </div>
                </div>

                <!-- Resume Access Card -->
                <transition name="modal-fade">
                  <div v-if="showResumeAccessModal" class="absolute inset-0 z-[110] flex items-center justify-center p-4">
                     <div @click="showResumeAccessModal = false" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

                     <div :class="['relative w-full max-w-sm p-8 rounded-[32px] border shadow-2xl transition-all duration-500 animate-slide-up', isDark ? 'bg-[#151515] border-white/5' : 'bg-white border-gray-100']">
                        <div class="flex items-center justify-between mb-6">
                           <div>
                             <p class="text-[10px] font-black uppercase tracking-[0.2em] text-cyan-500 mb-2">Resume Access</p>
                             <h4 :class="['text-lg font-black tracking-tight', isDark ? 'text-white' : 'text-black']">Enter Your Approved Email</h4>
                           </div>
                           <button @click="showResumeAccessModal = false" :class="['w-8 h-8 rounded-full flex items-center justify-center transition-all', isDark ? 'hover:bg-white/10 text-gray-400' : 'hover:bg-gray-100 text-gray-500']">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                           </button>
                        </div>

                        <div class="space-y-4">
                           <p :class="['text-sm leading-relaxed', isDark ? 'text-gray-300' : 'text-gray-600']"> Only emails approved by the owner are allowed to open and view the resume without any restrictions.</p>

                           <div class="space-y-2">
                             <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Email Address</label>
                             <input
                               v-model="resumeAccessForm.email"
                               type="email"
                               placeholder="Enter your email"
                               :class="['w-full px-5 py-3.5 rounded-2xl border text-sm font-medium transition-all outline-none', isDark ? 'bg-white/5 border-white/5 focus:border-cyan-500/50 text-white placeholder:text-white/20' : 'bg-gray-50 border-gray-200 focus:border-cyan-500/50 text-black placeholder:text-gray-400']"
                             />
                           </div>

                           <div v-if="resumeAccessFeedback.message" :class="[
                             'rounded-2xl border px-4 py-3 text-sm leading-relaxed',
                             resumeAccessFeedback.type === 'success'
                               ? (isDark ? 'border-emerald-500/20 bg-emerald-500/10 text-emerald-300' : 'border-emerald-200 bg-emerald-50 text-emerald-700')
                               : resumeAccessFeedback.type === 'warning'
                                 ? (isDark ? 'border-amber-500/20 bg-amber-500/10 text-amber-300' : 'border-amber-200 bg-amber-50 text-amber-700')
                                 : (isDark ? 'border-red-500/20 bg-red-500/10 text-red-300' : 'border-red-200 bg-red-50 text-red-700')
                           ]">
                             {{ resumeAccessFeedback.message }}
                           </div>

                           <button
                             @click="verifyResumeAccess"
                             :disabled="isCheckingResumeAccess"
                              :class="[
                                'w-full py-4 rounded-2xl text-white font-black text-xs uppercase tracking-widest shadow-xl shadow-cyan-500/20 transition-all',
                                isCheckingResumeAccess
                                  ? (isDark ? 'bg-white/10 text-white cursor-not-allowed opacity-70' : 'bg-gray-100 text-gray-500 border border-gray-200 shadow-none cursor-not-allowed')
                                  : 'bg-gradient-to-br from-cyan-400 to-indigo-600 hover:scale-[1.02] active:scale-[0.98]'
                              ]"
                            >
                             {{ isCheckingResumeAccess ? 'Checking...' : 'Continue To Resume' }}
                           </button>

                           <button
                             @click="requestResumeAccess"
                             type="button"
                             :class="['w-full py-3 rounded-2xl border text-[10px] font-black uppercase tracking-widest transition-all', isDark ? 'border-white/10 text-gray-300 hover:bg-white/5' : 'border-gray-200 text-gray-600 hover:bg-gray-50']"
                           >
                             Request Access Instead
                           </button>
                        </div>
                     </div>
                  </div>
                </transition>

                <!-- Floating Request Form Card -->
                <transition name="modal-fade">
                  <div v-if="showRequestModal" class="absolute inset-0 z-[100] flex items-center justify-center p-4">
                     <!-- Local Backdrop -->
                     <div @click="showRequestModal = false" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
                     
                     <!-- Small Floating Card -->
                     <div :class="['relative w-full max-w-sm p-8 rounded-[32px] border shadow-2xl transition-all duration-500 animate-slide-up', isDark ? 'bg-[#151515] border-white/5' : 'bg-white border-gray-100']">
                        <div class="flex items-center justify-between mb-6">
                           <h4 :class="['text-lg font-black tracking-tight', isDark ? 'text-white' : 'text-black']">Request View</h4>
                           <button @click="showRequestModal = false" :class="['w-8 h-8 rounded-full flex items-center justify-center transition-all', isDark ? 'hover:bg-white/10 text-gray-400' : 'hover:bg-gray-100 text-gray-500']">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                           </button>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                              <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Your Gmail</label>
                              <input 
                                v-model="requestForm.email"
                                @blur="checkRequestEmailStatus"
                                type="email" 
                                placeholder="Enter your Gmail address"
                                :class="['w-full px-5 py-3.5 rounded-2xl border text-sm font-medium transition-all outline-none', isDark ? 'bg-white/5 border-white/5 focus:border-cyan-500/50 text-white placeholder:text-white/20' : 'bg-gray-50 border-gray-200 focus:border-cyan-500/50 text-black placeholder:text-gray-400']"
                              />
                            </div>
                            <div v-if="requestStatusFeedback.message" :class="[
                              'rounded-2xl border px-4 py-3 text-sm leading-relaxed',
                              requestStatusFeedback.type === 'success'
                                ? (isDark ? 'border-emerald-500/20 bg-emerald-500/10 text-emerald-300' : 'border-emerald-200 bg-emerald-50 text-emerald-700')
                                : requestStatusFeedback.type === 'warning'
                                  ? (isDark ? 'border-amber-500/20 bg-amber-500/10 text-amber-300' : 'border-amber-200 bg-amber-50 text-amber-700')
                                  : (isDark ? 'border-red-500/20 bg-red-500/10 text-red-300' : 'border-red-200 bg-red-50 text-red-700')
                            ]">
                              {{ requestStatusFeedback.message }}
                            </div>
                            <div class="space-y-2">
                              <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Purpose</label>
                              <textarea 
                                v-model="requestForm.purpose"
                                rows="3"
                                placeholder="Why do you need access?"
                                :class="['w-full px-5 py-3.5 rounded-2xl border text-sm font-medium transition-all outline-none resize-none', isDark ? 'bg-white/5 border-white/5 focus:border-cyan-500/50 text-white placeholder:text-white/20' : 'bg-gray-50 border-gray-200 focus:border-cyan-500/50 text-black placeholder:text-gray-400']"
                              ></textarea>
                           </div>
                           
                            <button 
                              @click="submitResumeRequest"
                              :disabled="isSubmittingResumeRequest || isCheckingRequestEmail || requestStatusFeedback.status === 'accepted'"
                              :class="[
                                'w-full py-4 mt-2 rounded-2xl font-black text-xs uppercase tracking-widest transition-all',
                                isSubmittingResumeRequest || isCheckingRequestEmail || requestStatusFeedback.status === 'accepted'
                                  ? (requestStatusFeedback.status === 'accepted'
                                      ? (isDark ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/20 shadow-none cursor-not-allowed' : 'bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-none cursor-not-allowed')
                                      : (isDark ? 'bg-white/10 text-white cursor-not-allowed opacity-70 shadow-none' : 'bg-gray-100 text-gray-400 border border-gray-200 shadow-none cursor-not-allowed'))
                                  : 'bg-gradient-to-br from-cyan-400 to-indigo-600 text-white shadow-xl shadow-cyan-500/20 hover:scale-[1.02] active:scale-[0.98]'
                              ]"
                            >
                              {{ isSubmittingResumeRequest ? 'Sending...' : isCheckingRequestEmail ? 'Checking...' : requestStatusFeedback.status === 'accepted' ? 'Already Approved' : 'Send Request' }}
                            </button>

                            <button
                              @click="goToResumeAccess"
                              type="button"
                              :class="['w-full py-3 rounded-2xl border text-[10px] font-black uppercase tracking-widest transition-all', isDark ? 'border-white/10 text-gray-300 hover:bg-white/5' : 'border-gray-200 text-gray-600 hover:bg-gray-50']"
                           >
                              Go To Resume Access
                            </button>

                            <p :class="['text-[12px] leading-relaxed font-bold opacity-40 text-center px-4', isDark ? 'text-white' : 'text-black']">
                               We ensure that all incoming requests are acknowledged and processed within 24 hours.
                            </p>
                         </div>
                     </div>
                  </div>
                </transition>
            </main>
          </transition>
        </div>

      </div>
    </div>

    <!-- Specific Project Details Modal (Floating Page) -->
    <transition name="modal-fade">
      <div v-if="selectedProject" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-10">
        <!-- Backdrop -->
        <div @click="selectedProject = null" class="absolute inset-0 bg-black/80 backdrop-blur-md animate-fade-in"></div>

        <!-- Modal Content -->
        <div :class="['relative w-full max-w-5xl h-fit max-h-[90vh] rounded-[40px] border shadow-2xl overflow-hidden animate-slide-up flex flex-col', isDark ? 'bg-[#0f111a] border-white/5 scroll-hide' : 'bg-white border-gray-100 overflow-y-auto']">
          
          <!-- Modal Header -->
          <div :class="['px-10 py-8 flex items-center justify-between border-b', isDark ? 'border-white/5' : 'border-gray-100']">
             <h2 :class="['text-3xl font-black tracking-tight', isDark ? 'text-white' : 'text-black']">{{ selectedProject.title }}</h2>
             <div class="flex items-center gap-4">
                <a v-if="selectedProject.cert_file?.data || selectedProject.image" :href="selectedProject.cert_file?.data || selectedProject.image" download class="hidden sm:flex items-center gap-2 px-6 py-2.5 rounded-2xl bg-cyan-500 text-white font-black text-[10px] uppercase tracking-widest hover:bg-cyan-600 transition-all shadow-lg shadow-cyan-500/20">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                   Download PDF
                </a>
                <button @click="selectedProject = null" :class="['w-10 h-10 rounded-full flex items-center justify-center transition-all border', isDark ? 'bg-white/5 border-white/10 text-white/50 hover:bg-white/10 hover:text-white' : 'bg-gray-100 border-gray-200 text-black/50 hover:bg-gray-200 hover:text-black']">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
             </div>
          </div>

          <!-- Body: Certificate Viewer (Full Scale Image) -->
          <div v-if="selectedProject.issuer" :class="['flex-1 overflow-y-auto p-6 lg:p-10', isDark ? 'bg-gray-900/40' : 'bg-gray-100/50']">
             <div class="w-full h-full flex items-center justify-center p-4">
                <div :class="['relative w-full max-w-4xl rounded-2xl overflow-hidden shadow-2xl border transition-all duration-700 bg-white', isDark ? 'border-white/10' : 'border-gray-100']">
                   <!-- PDF Viewer -->
                   <iframe 
                      v-if="(selectedProject.cert_file?.data || selectedProject.image || '').toLowerCase().endsWith('.pdf') || selectedProject.cert_file?.type === 'application/pdf'" 
                      :src="selectedProject.cert_file?.data || selectedProject.image" 
                      class="w-full h-[70vh] border-none"
                   ></iframe>
                   
                   <!-- Image Viewer -->
                   <img 
                      v-else 
                      :src="selectedProject.cert_file?.data || selectedProject.image" 
                      class="max-w-full max-h-[70vh] object-contain block ring-8 ring-white/5 mx-auto" 
                   />
                   
                   <!-- Overlay (only for images to add aesthetic) -->
                   <div v-if="!(selectedProject.cert_file?.data || selectedProject.image || '').toLowerCase().endsWith('.pdf')" class="absolute inset-0 bg-indigo-500/5 pointer-events-none"></div>
                </div>
             </div>
             <!-- Cert Metadata for context -->
             <div class="mt-10 max-w-2xl mx-auto text-center space-y-4 pb-10">
                <p class="text-cyan-500 font-black text-xs uppercase tracking-[0.3em]">{{ selectedProject.issuer }}</p>
                <p :class="['text-sm font-medium leading-relaxed', isDark ? 'text-gray-400' : 'text-gray-500']">{{ selectedProject.description }}</p>
                <p v-if="selectedProject.year_issued" :class="['text-[10px] font-bold uppercase tracking-widest', isDark ? 'text-gray-600' : 'text-gray-400']">Issued in {{ selectedProject.year_issued }}</p>
             </div>
          </div>

          <!-- Body: Case Study Viewer (Works) -->
          <div v-else class="flex-1 overflow-y-auto p-10 lg:p-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
              
              <!-- Left Column: Gallery & Overview -->
              <div class="lg:col-span-2 space-y-10">
                <!-- Large Gallery Container -->
                <div class="relative aspect-video rounded-3xl overflow-hidden bg-black/40 border border-white/5 group/modal-gal shadow-2xl">
                   <div ref="modalGallery" class="w-full h-full flex overflow-x-auto scroll-hide snap-x">
                      <div v-if="selectedProject.image" class="w-full h-full flex-shrink-0 snap-center">
                        <img :src="selectedProject.image" class="w-full h-full object-cover" />
                      </div>
                      <div v-for="(file, fIdx) in (selectedProject.files || [])" :key="fIdx" class="w-full h-full flex-shrink-0 snap-center">
                        <img v-if="file.type.startsWith('image/')" :src="file.data" class="w-full h-full object-cover" />
                        <video v-else-if="file.type.startsWith('video/')" :src="file.data" class="w-full h-full object-cover" autoplay muted loop playsinline disablePictureInPicture></video>
                      </div>
                   </div>
                   <!-- Nav Indicator -->
                   <div v-if="(selectedProject.files?.length + (selectedProject.image ? 1 : 0)) > 1" class="absolute bottom-6 right-6 px-4 py-2 rounded-xl bg-black/60 backdrop-blur-md border border-white/10 text-[8px] font-black uppercase tracking-widest text-white/80 opacity-0 group-hover/modal-gal:opacity-100 transition-opacity">
                      Swipe for Gallery
                   </div>
                </div>

                <!-- Overview Section -->
                <div class="space-y-6 text-left">
                   <h3 :class="['text-xl font-bold flex items-center gap-3', isDark ? 'text-white' : 'text-black']">
                      <span class="w-1.5 h-6 bg-cyan-500 rounded-full"></span>
                      Overview
                   </h3>
                   <p :class="['text-base leading-relaxed font-medium', isDark ? 'text-gray-400' : 'text-gray-600']">
                      {{ selectedProject.description }}
                   </p>
                </div>
              </div>

              <!-- Right Column: Info & Links -->
              <div class="space-y-12">
                <!-- Tech Stack -->
                <div class="space-y-6">
                   <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Tech Stack</h4>
                   <div class="flex flex-wrap gap-2">
                      <span v-for="tag in (selectedProject.stacks?.split(',') || [])" :key="tag" :class="['px-5 py-2.5 rounded-2xl border text-[10px] font-bold transition-colors', isDark ? 'bg-white/5 border-white/5 text-gray-300 hover:border-cyan-500/30' : 'bg-gray-50 border-gray-200 text-gray-600 hover:border-cyan-300']">{{ tag.trim() }}</span>
                   </div>
                </div>

                <div class="space-y-6">
                   <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Key Features</h4>
                   <ul class="space-y-4">
                      <li v-for="feature in (selectedProject.features ? selectedProject.features.split('\n').filter(Boolean) : ['Real Time Analytics', 'Secure Data Management', 'Automated Notifications', 'Cloud Syncing'])" :key="feature" class="flex items-center gap-3 group">
                         <div class="w-5 h-5 rounded-full bg-cyan-500/10 flex items-center justify-center text-cyan-500 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                         </div>
                         <span :class="['text-sm font-semibold transition-colors', isDark ? 'text-gray-300 hover:text-white' : 'text-gray-600 hover:text-black']">{{ feature }}</span>
                      </li>
                   </ul>
                </div>

                <!-- Primary Action -->
                <div v-if="((selectedProject.link || '').trim()) || ((selectedProject.github_link || '').trim())" class="pt-6 border-t border-white/5 space-y-4">
                   <a v-if="(selectedProject.link || '').trim()" :href="selectedProject.link" target="_blank" class="w-full py-6 rounded-2xl bg-gradient-to-r from-cyan-500 to-indigo-600 text-white font-black text-xs uppercase tracking-[0.2em] flex items-center justify-center gap-3 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-cyan-500/40">
                      Website Link
                   </a>
                   
                   <a v-if="(selectedProject.github_link || '').trim()" :href="selectedProject.github_link" target="_blank" :class="['w-full py-5 rounded-2xl border font-black text-xs uppercase tracking-[0.2em] flex items-center justify-center gap-3 transition-all group', isDark ? 'bg-white/5 border-white/10 text-white hover:bg-white/10' : 'bg-gray-50 border-gray-200 text-black hover:bg-gray-100']">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                      Github Link
                   </a>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    <!-- Project Modal Closing Tag -->
    </transition>

    <!-- TOAST NOTIFICATION SYSTEM -->
    <transition name="toast-slide">
      <div v-if="notification.show" class="fixed top-10 left-1/2 -translate-x-1/2 z-[300] w-full max-w-sm px-6">
        <div :class="[
          'px-6 py-4 rounded-3xl border shadow-2xl backdrop-blur-xl flex items-center gap-4 animate-in fade-in slide-in-from-top-5 duration-300',
          notification.type === 'success' ? (isDark ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-300' : 'bg-emerald-50 border-emerald-200 text-emerald-800') :
          notification.type === 'error' ? (isDark ? 'bg-red-500/10 border-red-500/20 text-red-300' : 'bg-red-50 border-red-200 text-red-800') :
          (isDark ? 'bg-amber-500/10 border-amber-500/20 text-amber-300' : 'bg-amber-50 border-amber-200 text-amber-800')
        ]">
          <!-- Icon -->
          <div :class="['w-10 h-10 rounded-2xl flex items-center justify-center shrink-0',
            notification.type === 'success' ? (isDark ? 'bg-emerald-500/20' : 'bg-emerald-100') :
            notification.type === 'error' ? (isDark ? 'bg-red-500/20' : 'bg-red-100') :
            (isDark ? 'bg-amber-500/20' : 'bg-amber-100')
          ]">
            <svg v-if="notification.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
            <svg v-else-if="notification.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          </div>
          
          <div class="flex-1">
            <p class="text-xs font-black uppercase tracking-widest opacity-40 mb-0.5">Notification</p>
            <p class="text-sm font-bold leading-tight">{{ notification.message }}</p>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, reactive, watch, computed, onMounted, onUnmounted, nextTick } from 'vue';
import axios from 'axios';

const activeNavItem = ref('Home');
const certs = ref([]);
const worksViewMode = ref('grid');
const certsViewMode = ref('list');
const showcaseTab = ref('Works');
const activeStackName = ref('');
let stackAnimationInterval = null;

const triggerStackWave = () => {
  if (techStacks.value.length === 0) return;
  
  techStacks.value.forEach((skill, index) => {
    setTimeout(() => {
      activeStackName.value = skill.name;
      
      // Reset after a longer duration for a slower ripple
      setTimeout(() => {
        if (activeStackName.value === skill.name) {
          activeStackName.value = '';
        }
      }, 1500); // Slower recession
    }, index * 500); 
  });
};
const activeSocialName = ref('');
let socialAnimationInterval = null;

const triggerSocialWave = () => {
  if (socials.value.length === 0) return;
  
  socials.value.forEach((social, index) => {
    setTimeout(() => {
      activeSocialName.value = social.name;
      
      setTimeout(() => {
        if (activeSocialName.value === social.name) {
          activeSocialName.value = '';
        }
      }, 1000);
    }, index * 500);
  });
};




const activeMainTab = ref('Portfolio'); // 'Portfolio' or 'Resume'
const portfolioMode = ref('scroll'); // 'scroll', 'Works', 'Certificates', 'Stack'
const selectedProject = ref(null);
const scrollProgress = ref(0);
const pendingScrollSection = ref(null);
const isLoading = ref(true);
const isDark = ref(false);
let revealObserver = null;
const isResumeAuthorized = ref(false);
const showResumeAccessModal = ref(false);
const showRequestModal = ref(false);
const isCheckingResumeAccess = ref(false);
const isSubmittingResumeRequest = ref(false);
const isCheckingRequestEmail = ref(false);
const resumeAccessForm = reactive({
  email: '',
});
const resumeAccessFeedback = reactive({
  type: '',
  message: '',
});

const requestStatusFeedback = reactive({
  type: '',
  message: '',
  status: '',
});
const requestForm = reactive({
  email: '',
  purpose: ''
});

const notification = reactive({
  show: false,
  message: '',
  type: 'success' // 'success', 'error', 'warning'
});

const showNotification = (message, type = 'success') => {
  notification.message = message;
  notification.type = type;
  notification.show = true;
  setTimeout(() => {
    notification.show = false;
  }, 4000);
};

const normalizeAccessEmail = (email) => email.trim().toLowerCase();

const setRequestStatusFeedback = (status) => {
  requestStatusFeedback.status = status;

  if (status === 'accepted') {
    requestStatusFeedback.type = 'success';
    requestStatusFeedback.message = 'This email is already accepted. You can go directly to Resume Access.';
    return;
  }

  if (status === 'pending') {
    requestStatusFeedback.type = 'warning';
    requestStatusFeedback.message = 'This email already has a pending request. Sending again will refresh its submission date.';
    return;
  }

  if (status === 'declined') {
    requestStatusFeedback.type = 'warning';
    requestStatusFeedback.message = 'This email was previously declined. Sending again will refresh the request for another review.';
    return;
  }

  requestStatusFeedback.type = '';
  requestStatusFeedback.message = '';
};

const openResumeSection = () => {
  activeMainTab.value = 'Resume';
  isResumeAuthorized.value = false;
  showResumeAccessModal.value = true;
  showRequestModal.value = false;
  resumeAccessForm.email = '';
  requestForm.email = '';
  requestForm.purpose = '';
  resumeAccessFeedback.type = '';
  resumeAccessFeedback.message = '';
  setRequestStatusFeedback('');
};

const requestResumeAccess = () => {
  resumeAccessForm.email = '';
  requestForm.email = '';
  requestForm.purpose = '';
  setRequestStatusFeedback('');
  showResumeAccessModal.value = false;
  showRequestModal.value = true;
};

const goToResumeAccess = () => {
  resumeAccessForm.email = '';
  requestForm.email = '';
  requestForm.purpose = '';
  setRequestStatusFeedback('');
  resumeAccessFeedback.type = '';
  resumeAccessFeedback.message = '';
  showRequestModal.value = false;
  showResumeAccessModal.value = true;
};

const checkRequestEmailStatus = async () => {
  if (!requestForm.email) {
    setRequestStatusFeedback('');
    return;
  }

  const normalizedEmail = normalizeAccessEmail(requestForm.email);
  requestForm.email = normalizedEmail;
  resumeAccessForm.email = normalizedEmail;
  isCheckingRequestEmail.value = true;

  try {
    const response = await axios.post('/resume-requests/check-access', {
      email: normalizedEmail,
    });

    setRequestStatusFeedback(response.data?.status || '');
  } catch (error) {
    console.error('Request email status check failed:', error);
    requestStatusFeedback.status = '';
    requestStatusFeedback.type = 'error';
    requestStatusFeedback.message = 'Unable to check this email right now. You can still try sending a request.';
  } finally {
    isCheckingRequestEmail.value = false;
  }
};

const verifyResumeAccess = async () => {
  if (!resumeAccessForm.email) {
    resumeAccessFeedback.type = 'error';
    resumeAccessFeedback.message = 'Please enter your email to continue.';
    isResumeAuthorized.value = false;
    return;
  }

  const normalizedEmail = normalizeAccessEmail(resumeAccessForm.email);
  resumeAccessForm.email = normalizedEmail;
  isCheckingResumeAccess.value = true;
  resumeAccessFeedback.type = '';
  resumeAccessFeedback.message = '';

  try {
    const response = await axios.post('/resume-requests/check-access', {
      email: normalizedEmail,
    });

    requestForm.email = normalizedEmail;

    if (response.data?.authorized) {
      isResumeAuthorized.value = true;
      localStorage.setItem('portfolio_resume_access_email', normalizedEmail);
      resumeAccessFeedback.type = 'success';
      resumeAccessFeedback.message = 'Access approved. Your resume is now available.';

      setTimeout(() => {
        showResumeAccessModal.value = false;
      }, 300);

      return;
    }

    isResumeAuthorized.value = false;

    if (response.data?.status === 'pending') {
      resumeAccessFeedback.type = 'warning';
      resumeAccessFeedback.message = 'Your request is still pending admin approval. The resume will stay blurred until it is accepted.';
    } else if (response.data?.status === 'declined') {
      resumeAccessFeedback.type = 'error';
      resumeAccessFeedback.message = 'This email has not been approved for resume access. You can submit a new request below.';
    } else {
      resumeAccessFeedback.type = 'warning';
      resumeAccessFeedback.message = 'No approved request was found for this email yet. You can request access below.';
    }
  } catch (error) {
    console.error('Resume access verification failed:', error);
    isResumeAuthorized.value = false;
    resumeAccessFeedback.type = 'error';
    resumeAccessFeedback.message = 'Unable to verify resume access right now. Please try again.';
  } finally {
    isCheckingResumeAccess.value = false;
  }
};

const submitResumeRequest = async () => {
  if (!requestForm.email || !requestForm.purpose) {
    showNotification('Please provide your Gmail and purpose.', 'warning');
    return;
  }

  const normalizedEmail = normalizeAccessEmail(requestForm.email);
  requestForm.email = normalizedEmail;
  resumeAccessForm.email = normalizedEmail;
  isSubmittingResumeRequest.value = true;

  try {
    const response = await axios.post('/resume-requests', {
      email: normalizedEmail,
      purpose: requestForm.purpose,
    });

    const action = response.data?.action;
    const message = response.data?.message;

    if (action === 'accepted') {
      requestStatusFeedback.status = 'accepted';
      requestStatusFeedback.type = 'success';
      requestStatusFeedback.message = message || 'This email is already approved for resume access.';
      return;
    }

    showNotification(message || 'Your resume request has been sent successfully.', 'success');
    setRequestStatusFeedback('pending');
    showRequestModal.value = false;
    showResumeAccessModal.value = true;
    resumeAccessFeedback.type = 'warning';
    resumeAccessFeedback.message = action === 'updated'
      ? 'Your existing request was refreshed. The resume will remain blurred until your email is approved.'
      : 'Your request was submitted. The resume will remain blurred until your email is approved.';
    localStorage.setItem('portfolio_resume_access_email', normalizedEmail);
    requestForm.purpose = '';
  } catch (error) {
    console.error('Resume request submission failed:', error);
    showNotification('Unable to send your request right now. Please try again.', 'error');
  } finally {
    isSubmittingResumeRequest.value = false;
  }
};

watch(activeMainTab, (newTab) => {
  if (newTab === 'Portfolio') {
    activeNavItem.value = 'Home';
    portfolioMode.value = 'scroll';
    showResumeAccessModal.value = false;
    showRequestModal.value = false;
    
    // Refresh observer for scroll animations
    nextTick(() => {
      setTimeout(() => {
        refreshRevealObserver();
      }, 600);
    });
    // Optionally scroll to top
    nextTick(() => {
      const container = document.getElementById('portfolio-scroll-container');
      if (container) container.scrollTop = 0;
    });
  }
});
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1200);
const featuredWorkIds = ref([]);
const featuredCertIds = ref([]);
const floatingTech = ref([]);
const maxFloatingIcons = 5;

// Matrix Reveal Animation for "Developer"
const finalTitleWord = "Developer";
const matrixLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*()_+";
const revealedTitle = ref(finalTitleWord);
let matrixInterval = null;
let matrixAutoInterval = null;
let isHoveringMatrix = false;

const startMatrixReveal = () => {
    let iteration = 0;
    
    clearInterval(matrixInterval);
    
    matrixInterval = setInterval(() => {
        revealedTitle.value = finalTitleWord.split("").map((letter, index) => {
            if(index < iteration) {
                return finalTitleWord[index];
            }
            return matrixLetters[Math.floor(Math.random() * matrixLetters.length)];
        }).join("");
        
        if(iteration >= finalTitleWord.length) {
            clearInterval(matrixInterval);
            revealedTitle.value = finalTitleWord; // Snap to final just in case
        }
        
        iteration += 1 / 3; // Adjust the denominator to change animation speed
    }, 30);
};

const handleMouseEnterMatrix = () => {
    isHoveringMatrix = true;
    startMatrixReveal();
};

const handleMouseLeaveMatrix = () => {
    isHoveringMatrix = false;
};

const settings = reactive({
  social: {
    gmail: 'jhomarimalaca1@gmail.com',
    linkedin: '#',
    github: '#',
    instagram: '#',
    facebook: '#',
    viber: '#'
  },
  portfolio: {
    aboutImages: []
  }
});
const currentAboutImageIndex = ref(0);
const aboutGallery = ref(null);
const projectGalleries = ref([]);
const portfolioGalleries = ref([]);
const showcaseGalleries = ref([]);
const contactForm = reactive({
  name: '',
  email: '',
  message: ''
});

const handleContactSubmit = () => {
    if (!contactForm.name || !contactForm.email || !contactForm.message) {
        alert('Please fill out all fields before sending.');
        return;
    }
    
    const subject = `Message from ${contactForm.name} (Portfolio Form)`;
    const body = `Name: ${contactForm.name}\nEmail: ${contactForm.email}\n\nMessage:\n${contactForm.message}`;
    
    // Using mailto to send to the admin's Gmail
    const mailtoLink = `mailto:${settings.social.gmail}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailtoLink;
    
    // Optional: Clear form after a delay
    setTimeout(() => {
        contactForm.name = '';
        contactForm.email = '';
        contactForm.message = '';
    }, 1000);
};

const spawnFloatingTech = () => {
    if (techStacks.value.length === 0) return;
    
    // Occasionally remove an old one
    if (floatingTech.value.length >= maxFloatingIcons || (Math.random() > 0.7 && floatingTech.value.length > 0)) {
        const removeIdx = Math.floor(Math.random() * floatingTech.value.length);
        floatingTech.value.splice(removeIdx, 1);
    }
    
    // Occasionally add a new one
    if (floatingTech.value.length < maxFloatingIcons && Math.random() > 0.4) {
        // Filter out skills that are currently flying
        const currentActiveNames = floatingTech.value.map(icon => icon.name);
        const availableSkills = techStacks.value.filter(skill => !currentActiveNames.includes(skill.name));
        
        // Only spawn if we have non-repeating skills available
        if (availableSkills.length > 0) {
            const skill = availableSkills[Math.floor(Math.random() * availableSkills.length)];
            
            // Spatial collision detection to avoid stacking
            let attempts = 0;
            let finalX = 0;
            let finalY = 0;
            let hasValidCoords = false;

            while (attempts < 50 && !hasValidCoords) {
                // Balance Logic: Count current left vs right to force symmetry
                let leftCount = 0;
                let rightCount = 0;
                floatingTech.value.forEach(icon => {
                    if (icon.x < 50) leftCount++;
                    else rightCount++;
                });
                
                let isLeft;
                if (leftCount > rightCount) isLeft = false;
                else if (rightCount > leftCount) isLeft = true;
                else isLeft = Math.random() > 0.5;

                // Polar Coordinate Orbit: Mathematically perfect curve matching
                // Upper hemisphere sweep: from ~198 degrees to ~342 degrees
                const angle = Math.PI * 1.1 + Math.random() * (Math.PI * 0.8);
                
                // Radius of 53% guarantees exactly 5% overlap for a 16% wide logo
                const radius = 53; 
                
                // Calculate center point of the logo mathematically
                const centerX = 50 + radius * Math.cos(angle);
                const centerY = 50 + radius * Math.sin(angle);
                
                // Offset by half the logo width (8%) to get the top-left positioning coordinate
                finalX = centerX - 8;
                finalY = centerY - 8;
                
                hasValidCoords = true;
                // Check distance against all currently flying icons
                for (const icon of floatingTech.value) {
                    const dx = icon.x - finalX;
                    const dy = icon.y - finalY;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    // Require ~28% distance to ensure absolutely no overlapping given the icon sizes
                    if (distance < 28) { 
                        hasValidCoords = false;
                        break;
                    }
                }
                attempts++;
            }
            
            // If we couldn't find a clean, non-overlapping spot after 50 tries, do not spawn.
            if (!hasValidCoords) return;
            
            const newIcon = {
                id: Date.now() + Math.random(),
                name: skill.name,
                image: skill.image,
                x: finalX,
                y: finalY,
                scale: 1.0 + Math.random() * 0.25,
                spinDuration: 10 + Math.random() * 20, // 10 to 30 seconds
                spinDirection: Math.random() > 0.5 ? 'normal' : 'reverse'
            };
            floatingTech.value.push(newIcon);
        }
    }
};

let techInterval = null;
const modalGallery = ref(null);
let galleryInterval = null;

const updateWidth = () => {
    windowWidth.value = window.innerWidth;
};

const handleScroll = (event) => {
  if (activeMainTab.value !== 'Portfolio') return;
  
  const container = event.target;
  
  // Update scroll progress percentage
  const scrolled = container.scrollTop;
  const maxScroll = container.scrollHeight - container.clientHeight;
  if (maxScroll > 0) {
    scrollProgress.value = (scrolled / maxScroll) * 100;
  }

  const sections = ['Home', 'About', 'Showcase', 'Contact'];
  
  for (const id of sections) {
    const section = document.getElementById(id);
    if (section) {
      const rect = section.getBoundingClientRect();
      const containerRect = container.getBoundingClientRect();
      
      // If the section is near the top of the container, set it as active
      if (rect.top >= containerRect.top - 150 && rect.top <= containerRect.top + 250) {
        activeNavItem.value = id;
        break;
      }
    }
  }
};

const scrollToSection = (id) => {
  activeNavItem.value = id;
  
  if (portfolioMode.value !== 'scroll') {
    // We are in a sub-view, need to switch back and wait
    pendingScrollSection.value = id;
    portfolioMode.value = 'scroll';
    return;
  }

  // We are already in scroll mode, just go there
  const element = document.getElementById(id);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
};

const triggerMessage = () => {
  if (activeMainTab.value !== 'Portfolio') {
     activeMainTab.value = 'Portfolio';
  }
  
  scrollToSection('Contact');
  
  // Wait for scroll and potential view switch
  setTimeout(() => {
    const input = document.querySelector('input[placeholder="Input Your Name"]');
    if (input) {
      input.focus();
      // Visual feedback: brief highlight
      input.classList.add('ring-2', 'ring-white/50');
      setTimeout(() => input.classList.remove('ring-2', 'ring-white/50'), 1500);
    }
  }, 800);
};

const contactViaGmail = () => {
    const email = settings.social.gmail;
    if (email) {
        const url = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}`;
        window.open(url, '_blank');
    }
};

// Watch for mode switches to handle pending scrolls
watch(portfolioMode, (newMode) => {
  if (newMode === 'scroll' && pendingScrollSection.value) {
    const target = pendingScrollSection.value;
    pendingScrollSection.value = null; // Clear it
    
    // Wait for the DOM to render the list view
    nextTick(() => {
      // Small timeout to allow the out-in transition to progress
      setTimeout(() => {
        const element = document.getElementById(target);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }, 500); // Wait for the 'out' transition of the detailed view to finish
    });
  }

  // Always re-initiate reveal observer when switching to scroll mode
  if (newMode === 'scroll') {
    nextTick(() => {
      // Longer timeout to ensure the transition 'out' is done and 'in' has started
      setTimeout(() => {
        refreshRevealObserver();
      }, 600);
    });
  }
});

const refreshRevealObserver = () => {
  // Disconnect existing observer if any
  if (revealObserver) {
    revealObserver.disconnect();
  }

  const revealCallback = (entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('reveal-active');
      } else {
        entry.target.classList.remove('reveal-active');
      }
    });
  };

  // Re-create observer to ensure it's fresh for the new DOM elements
  revealObserver = new IntersectionObserver(revealCallback, {
    root: null, // Viewport
    threshold: 0.05, // Lower threshold for more reliability
    rootMargin: '0px 0px -50px 0px'
  });

  const revealElements = document.querySelectorAll('.reveal-on-scroll');
  if (revealElements.length > 0) {
    revealElements.forEach(el => {
      // Reset state and observe
      el.classList.remove('reveal-active');
      revealObserver.observe(el);
    });
  }
};

const canvasRef = ref(null);
let particles = [];
const PARTICLE_COUNT = 100;
let animationFrameId = null;

class Particle {
  constructor(w, h) {
    this.x = Math.random() * w;
    this.y = Math.random() * h;
    this.vx = (Math.random() - 0.5) * 0.4;
    this.vy = (Math.random() - 0.5) * 0.4;
    this.radius = Math.random() * 1.5 + 0.5;
  }
  update(w, h) {
    this.x += this.vx;
    this.y += this.vy;
    if (this.x < 0 || this.x > w) this.vx *= -1;
    if (this.y < 0 || this.y > h) this.vy *= -1;
  }
}

const animate = () => {
  if (!canvasRef.value) return;
  const canvas = canvasRef.value;
  const ctx = canvas.getContext('2d');
  const w = canvas.width = window.innerWidth;
  const h = canvas.height = window.innerHeight;
  
  ctx.clearRect(0, 0, w, h);
  ctx.fillStyle = 'rgba(6, 182, 212, 1)'; // Vibrant Cyan (Cyan 500)
  ctx.strokeStyle = 'rgba(6, 182, 212, 0.4)'; // Matching transparent lines
  
  particles.forEach((p, i) => {
    p.update(w, h);
    ctx.beginPath();
    ctx.arc(p.x, p.y, p.radius * 1.5, 0, Math.PI * 2);
    ctx.fill();
    
    for (let j = i + 1; j < particles.length; j++) {
      const p2 = particles[j];
      const dist = Math.hypot(p.x - p2.x, p.y - p2.y);
      if (dist < 150) {
        ctx.lineWidth = (1 - dist / 150) * 1.5;
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(p2.x, p2.y);
        ctx.stroke();
      }
    }
  });
  animationFrameId = requestAnimationFrame(animate);
};

onMounted(() => {
    window.addEventListener('resize', updateWidth);
    updateWidth();
    loadData();
    fetchWorks();
    fetchCerts();
    fetchStacks();
    fetchAboutImages();
    fetchSocialLinks();
    
    // Initialize Particles
    for (let i = 0; i < PARTICLE_COUNT; i++) {
      particles.push(new Particle(window.innerWidth, window.innerHeight));
    }
    
    if (isDark.value) animate();

    // End Loading State
    setTimeout(() => {
      isLoading.value = false;
    }, 2200);

    setTimeout(() => {
      isLoading.value = false;
    }, 2200);

    // Auto-scroll loop for project galleries
    galleryInterval = setInterval(() => {
      // 1. My Works Section (Grid/List)
      if (portfolioMode.value === 'Works') {
        portfolioGalleries.value.forEach(el => {
          if (!el || el.children.length < 2) return;
          if (el.scrollLeft + el.clientWidth >= el.scrollWidth - 10) {
            el.scrollTo({ left: 0, behavior: 'smooth' });
          } else {
            el.scrollBy({ left: el.clientWidth, behavior: 'smooth' });
          }
        });
      }

      // 2. Showcase Tab Galleries
      if (showcaseTab.value === 'Works' && portfolioMode.value === 'scroll') {
        showcaseGalleries.value.forEach(el => {
          if (!el || el.children.length < 2) return;
          // For showcase, each slide is full width
          if (el.scrollLeft + el.clientWidth >= el.scrollWidth - 10) {
            el.scrollTo({ left: 0, behavior: 'smooth' });
          } else {
            el.scrollBy({ left: el.clientWidth, behavior: 'smooth' });
          }
        });
      }

      // 3. Modal Details Gallery
      if (selectedProject.value && modalGallery.value) {
        const el = modalGallery.value;
        if (el.children.length > 1) {
          if (el.scrollLeft + el.clientWidth >= el.scrollWidth - 10) {
            el.scrollTo({ left: 0, behavior: 'smooth' });
          } else {
            el.scrollBy({ left: el.clientWidth, behavior: 'smooth' });
          }
        }
      }
      
      // 4. About Profile Gallery (Now using index for cross-fade)
      if (settings.portfolio?.aboutImages?.length > 1) {
        currentAboutImageIndex.value = (currentAboutImageIndex.value + 1) % settings.portfolio.aboutImages.length;
      }
    }, 4000); // 4 seconds for better viewing

    // Load data from Database
    fetchWorks();
    fetchCerts();
    fetchStacks();
    fetchAboutImages();
    fetchSocialLinks();
    fetchResume();
    
    // Start tech floating animation
    techInterval = setInterval(spawnFloatingTech, 3000);
    
    // Auto-trigger Matrix Animation every 5 seconds
    matrixAutoInterval = setInterval(() => {
        if (!isHoveringMatrix) {
            startMatrixReveal();
        }
    }, 5000);

    // Start stack wave animation
    triggerStackWave(); // Initial trigger
    stackAnimationInterval = setInterval(triggerStackWave, 10000); // Repeat every 10 seconds

    // Start social wave animation
    triggerSocialWave(); // Initial trigger
    socialAnimationInterval = setInterval(triggerSocialWave, 10000); // Repeat every 10 seconds

    refreshRevealObserver();
});

onUnmounted(() => {
    window.removeEventListener('resize', updateWidth);
    if (animationFrameId) cancelAnimationFrame(animationFrameId);
    if (galleryInterval) clearInterval(galleryInterval);
    if (techInterval) clearInterval(techInterval);
    if (matrixAutoInterval) clearInterval(matrixAutoInterval);
    if (stackAnimationInterval) clearInterval(stackAnimationInterval);
    if (socialAnimationInterval) clearInterval(socialAnimationInterval);
});

// Watch for dark mode changes to start/stop animation
watch(isDark, (val) => {
  if (val) {
    setTimeout(animate, 100);
  } else {
    if (animationFrameId) cancelAnimationFrame(animationFrameId);
  }
});

const navItems = [
  { name: 'Home', icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>` },
  { name: 'About', icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>` },
  { name: 'Showcase', icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>` },
  { name: 'Contact', icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>` }
];

// Helper function for Viber link logic
const getViberLink = (val) => {
  if (!val || val === '#') return '#';
  if (val.startsWith('http') || val.startsWith('viber://')) return val;
  return `viber://chat?number=${val.replace(/[^0-9]/g, '')}`;
};

const socials = computed(() => [
  { 
    name: 'LinkedIn', 
    iconSVG: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>`, 
    hoverColor: 'hover:text-[#0077B5]', 
    link: settings.social.linkedin || '#' 
  },
  { 
    name: 'GitHub', 
    iconSVG: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>`, 
    hoverColor: 'hover:text-black dark:hover:text-white', 
    link: settings.social.github || '#' 
  },
  { 
    name: 'Facebook', 
    iconSVG: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>`, 
    hoverColor: 'hover:text-[#1877F2]', 
    link: settings.social.facebook || '#' 
  },
  { 
    name: 'Instagram', 
    iconSVG: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>`, 
    hoverColor: 'hover:text-[#D62976]', 
    link: settings.social.instagram || '#' 
  },
  { 
    name: 'Viber', 
    iconSVG: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>`, 
    hoverColor: 'hover:text-[#7360F2]', 
    link: getViberLink(settings.social.viber)
  },
  { 
    name: 'Gmail', 
    iconSVG: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>`, 
    hoverColor: 'hover:text-[#EA4335]', 
    link: settings.social.gmail ? `mailto:${settings.social.gmail}` : '#' 
  }
]);

const projects = ref([]);

const certificates = ref([]);

const techStacks = ref([]);

const resumeData = reactive({
  basicInfo: { name: '', address: '', contact: '', email: '', profileImageLight: '', profileImageDark: '', resumePdf: '' },
  careerObjective: '',
  educationalBackground: [],
  skills: [],
  trainings: [],
  workExperience: [],
  personalInfo: {},
  references: []
});

const resumeViewMode = ref('normal'); // 'normal' or 'pdf'

const loadData = () => {
  // Logic removed to ensure data is strictly database-driven.
  // This prevents "old data" from appearing via localStorage.
};

const fetchResume = async () => {
  try {
    const response = await axios.get('/resume');
    if (response.data && response.data.basicInfo) {
      const currentBasic = { ...resumeData.basicInfo };
      Object.assign(resumeData, response.data);
      resumeData.basicInfo = { ...currentBasic, ...response.data.basicInfo };
    }
  } catch (error) {
    console.error('Unable to load resume from database:', error);
  }
};

const fetchWorks = async () => {
  try {
    const response = await axios.get('/works');
    projects.value = response.data;
    // Sync featuredWorkIds from database
    featuredWorkIds.value = response.data
      .filter(p => p.is_featured)
      .map(p => p.id);
  } catch (error) {
    console.error('Unable to load works:', error);
  }
};

const fetchCerts = async () => {
  try {
    const response = await axios.get('/certificates');
    certificates.value = response.data;
    // Sync featuredCertIds from database
    featuredCertIds.value = response.data
      .filter(c => c.is_featured)
      .map(c => c.id);
  } catch (error) {
    console.error('Unable to load certificates:', error);
  }
};

const fetchStacks = async () => {
  try {
    const response = await axios.get('/stacks');
    techStacks.value = response.data;
  } catch (error) {
    console.error('Unable to load stacks:', error);
  }
};

const fetchAboutImages = async () => {
  try {
    const response = await axios.get('/about-images');
    if (!settings.portfolio) settings.portfolio = { aboutImages: [] };
    settings.portfolio.aboutImages = response.data.map(img => ({
      data: img.image,
      id: img.id
    }));
  } catch (error) {
    console.error('Unable to load about images:', error);
  }
};

const fetchSocialLinks = async () => {
  try {
    const response = await axios.get('/social-links');
    if (response.data && response.data.id) {
      Object.assign(settings.social, response.data);
    }
  } catch (error) {
    console.error('Unable to load social links:', error);
  }
};

// Showcase: show ONLY admin-featured items, no fallback
const featuredProjects = computed(() => {
  if (featuredWorkIds.value.length === 0) return [];
  return featuredWorkIds.value
    .map(id => projects.value.find(p => p.id === id))
    .filter(Boolean);
});

const featuredCertificates = computed(() => {
  if (featuredCertIds.value.length === 0) return [];
  return featuredCertIds.value
    .map(id => certificates.value.find(c => c.id === id))
    .filter(Boolean);
});

const featuredStacks = computed(() => {
  return techStacks.value.filter(s => s.is_featured);
});


</script>

<style scoped>
/* Scroll Reveal System */
.reveal-on-scroll {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  will-change: transform, opacity;
}

.reveal-active {
  opacity: 1;
  transform: translateY(0);
}

/* Staggered Delay Utilities */
.delay-100 { transition-delay: 100ms; }
.delay-200 { transition-delay: 200ms; }
.delay-300 { transition-delay: 300ms; }
.delay-400 { transition-delay: 400ms; }
.delay-500 { transition-delay: 500ms; }

/* Sidebar Tabs Text Rotation */
.vertical-text {
  writing-mode: vertical-rl;
  transform: rotate(180deg);
}

/* Smooth entrance animation */
.max-w-\[1200px\] {
    animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.animate-shimmer {
  animation: shimmer 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}

/* Tab Content Transitions */
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.fade-slide-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

/* Custom font styles */
@theme {
  --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
}

:deep(body) {
    font-family: 'Instrument Sans', sans-serif;
}

/* Custom scrollbar */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}
.overflow-y-auto::-webkit-scrollbar-thumb {
  background: rgba(0,0,0,0.1);
  border-radius: 10px;
}
.dark .overflow-y-auto::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,0.1);
}

/* Background Patterns */
.bg-grid-paper {
  background-color: #cacaca;
  background-image: 
    url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E"),
    linear-gradient(#a3a3a3 1px, transparent 1px),
    linear-gradient(90deg, #a3a3a3 1px, transparent 1px);
  background-size: auto, 30px 30px;
  background-blend-mode: overlay;
}

/* Splash Screen Transitions */
.fade-overlay-leave-active {
  transition: all 0.8s cubic-bezier(0.65, 0, 0.35, 1);
}
.fade-overlay-leave-to {
  opacity: 0;
  transform: scale(1.1);
  filter: blur(20px);
}

/* Tech Floating Transitions */
.fade-tech-enter-active,
.fade-tech-leave-active {
  transition: all 1.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.fade-tech-enter-from {
  opacity: 0;
  transform: scale(0.5) translateY(20px);
}
.fade-tech-leave-to {
  opacity: 0;
  transform: scale(0.8) translateY(-30px);
}

/* Profile Fade Transition */
.profile-fade-enter-active,
.profile-fade-leave-active {
  transition: all 1.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.profile-fade-enter-from {
  opacity: 0;
  transform: scale(1.15);
}
.profile-fade-leave-to {
  opacity: 0;
  transform: scale(1);
}

@keyframes loading-progress {
  0% { transform: translateX(-100%); }
  50% { transform: translateX(0); }
  100% { transform: translateX(100%); }
}

.animate-loading-progress {
  animation: loading-progress 1.5s ease-in-out infinite;
}

/* Modal Animations */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
.animate-fade-in {
  animation: fadeIn 0.5s ease-out forwards;
}

@keyframes slideUpModal {
  from { opacity: 0; transform: translateY(40px) scale(0.95); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}
.animate-slide-up {
  animation: slideUpModal 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@media (min-width: 1024px) {
  .bg-grid-paper {
    background-size: 40px 40px;
  }
}
</style>
