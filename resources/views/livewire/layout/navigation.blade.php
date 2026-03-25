<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-[#050b14]/90 border-b border-cyan-900/50 backdrop-blur-md sticky top-0 z-50 overflow-hidden">
    <!-- Neon border top -->
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-cyan-600/0 via-cyan-400 to-fuchsia-600/0 opacity-50"></div>
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-fuchsia-500 font-black tracking-[0.2em] text-xl drop-shadow-[0_0_10px_rgba(6,182,212,0.8)]">
                        SYS.LINK
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-cyan-100 hover:text-cyan-300 focus:text-cyan-300 font-mono tracking-widest uppercase text-sm !border-cyan-500 hover:drop-shadow-[0_0_8px_rgba(6,182,212,0.8)] transition-all">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 font-mono tracking-wider">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-cyan-900/50 text-xs leading-4 font-bold rounded-lg text-cyan-400 bg-cyan-950/20 hover:bg-cyan-900/40 hover:text-cyan-200 focus:outline-none transition ease-in-out duration-300 shadow-[inset_0_0_10px_rgba(6,182,212,0.1)] uppercase">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-cyan-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-[#0b1120] border border-cyan-900/50 shadow-[0_0_15px_rgba(0,0,0,0.8)] rounded-md overflow-hidden ring-1 ring-black ring-opacity-5">
                            <x-dropdown-link :href="route('profile')" wire:navigate class="text-cyan-100 hover:bg-cyan-900/30 hover:text-cyan-300 focus:bg-cyan-900/40 transition-colors uppercase text-xs">
                                {{ __('Profile Settings') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="text-fuchsia-400 hover:bg-fuchsia-900/20 hover:text-fuchsia-300 focus:bg-fuchsia-900/30 transition-colors uppercase text-xs">
                                    {{ __('TERMINATE SESSION') }}
                                </x-dropdown-link>
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-cyan-500 hover:text-cyan-300 hover:bg-cyan-900/30 focus:outline-none focus:bg-cyan-900/40 focus:text-cyan-200 transition duration-150 ease-in-out border border-transparent hover:border-cyan-800/50">
                    <svg class="h-6 w-6 drop-shadow-[0_0_5px_rgba(6,182,212,0.5)]" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#060c18] border-b border-cyan-900/50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-cyan-100 font-mono text-sm uppercase tracking-widest hover:text-cyan-300 hover:bg-cyan-900/20 focus:text-cyan-300 border-cyan-500 transition-colors">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-cyan-900/50 font-mono">
            <div class="px-4">
                <div class="font-bold text-base text-cyan-400 drop-shadow-[0_0_2px_rgba(6,182,212,0.8)] tracking-wider" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-cyan-700/80">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="text-cyan-300 text-xs uppercase tracking-widest hover:bg-cyan-900/20 hover:text-cyan-100 transition-colors border-transparent">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="text-fuchsia-400 text-xs uppercase tracking-widest hover:bg-fuchsia-900/20 hover:text-fuchsia-300 transition-colors border-transparent">
                        {{ __('Terminate Session') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
