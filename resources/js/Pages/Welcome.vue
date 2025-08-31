<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

// Variável reativa para controlar a visibilidade do menu mobile
const isMobileMenuOpen = ref(false);
</script>

<template>

    <Head title="Bem-vindo" />

    <div class="bg-poupai-light text-poupai-dark-gray min-h-screen flex flex-col">
        <header class="p-6 relative">
            <nav class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <img src="/assets/img/logo_ico.png" alt="Logo Poupaí" class="w-10 h-10" />
                    <span class="text-2xl font-bold text-poupai-dark">Poupaí</span>
                </div>

                <div v-if="canLogin" class="hidden md:flex items-center space-x-4">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900">
                    Dashboard
                    </Link>

                    <template v-else>
                        <Link :href="route('login')" class="font-semibold hover:text-poupai-green transition-colors">
                        Acessar
                        </Link>
                        <Link v-if="canRegister" :href="route('register')"
                            class="font-semibold bg-poupai-green text-white px-4 py-2 rounded-lg hover:opacity-90 transition-opacity">
                        Criar Conta
                        </Link>
                    </template>
                </div>

                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-poupai-dark focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </nav>

            <div v-if="isMobileMenuOpen"
                class="md:hidden mt-4 bg-white rounded-lg shadow-lg p-4 absolute top-full left-6 right-6">
                <div v-if="canLogin" class="flex flex-col space-y-4">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900 text-center">
                    Dashboard
                    </Link>
                    <template v-else>
                        <Link :href="route('login')"
                            class="font-semibold hover:text-poupai-green transition-colors text-center">
                        Acessar
                        </Link>
                        <Link v-if="canRegister" :href="route('register')"
                            class="font-semibold bg-poupai-green text-white px-4 py-2 rounded-lg hover:opacity-90 transition-opacity text-center">
                        Criar Conta
                        </Link>
                    </template>
                </div>
            </div>
        </header>

        <main class="flex-grow flex flex-col items-center justify-center text-center p-6">
            <h1 class="text-5xl md:text-6xl font-bold text-poupai-dark mb-4">
                Vamos cuidar do <span class="text-poupai-green">seu bolso</span> hoje?
            </h1>
            <p class="max-w-xl text-lg text-gray-600 mb-8">
                Um aplicativo fácil de usar que ajuda você a controlar suas finanças pessoais com simplicidade.
            </p>
            <div v-if="!$page.props.auth.user" class="space-x-4">
                <Link :href="route('register')"
                    class="bg-poupai-green text-white font-bold py-3 px-8 rounded-full text-lg hover:opacity-90 transition-opacity">
                Começar Agora
                </Link>
            </div>
            <div class="flex items-center space-x-3">
                <img src="/assets/img/googleplay.png" alt="Baixe agora o Poupaí" class="mt-4 w-80 h-20" />
            </div>
        </main>

        <footer class="text-center p-6 text-sm text-gray-500">
            Poupaí &copy; {{ new Date().getFullYear() }}
        </footer>
    </div>
</template>
