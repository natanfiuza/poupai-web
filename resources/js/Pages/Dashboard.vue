<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


const summary = {
    balance: 'R$ 1.550,00',
    income: 'R$ 4.500,00',
    expenses: 'R$ 2.950,00',
    incomeChange: '+5.2%', // Novo dado mockado
    expensesChange: '+8.1%', // Novo dado mockado
    balanceChange: '-2.5%', // Novo dado mockado
};

const recentTransactions = [
    { id: 1, description: 'Supermercado do Mês', category: 'Alimentação', amount: '- R$ 850,45', type: 'expense' },
    { id: 2, description: 'Salário', category: 'Salário', amount: '+ R$ 4.500,00', type: 'income' },
    { id: 3, description: 'Conta de Internet', category: 'Moradia', amount: '- R$ 99,90', type: 'expense' },
    { id: 4, description: 'Jantar no Restaurante', category: 'Lazer', amount: '- R$ 120,00', type: 'expense' },
];

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">

                <div>
                    <h1 class="text-4xl font-bold text-poupai-dark">Bem-vindo de volta, {{ $page.props.auth.user.first_name }}! 👋</h1>
                    <p class="mt-1 text-lg text-gray-600">Vamos cuidar do seu bolso hoje?</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-green-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-poupai-dark flex items-center">
                            <span class="text-yellow-500 mr-2">⭐</span>
                            Defina sua meta de economia
                        </h3>
                        <span class="text-sm font-bold text-poupai-green">75%</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Você está quase lá! Continue economizando para atingir seu
                        objetivo.</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-3">
                        <div class="bg-poupai-green h-2.5 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-green-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-poupai-dark flex items-center">
                            <span class="text-yellow-500 mr-2">⭐</span>
                            Defina sua meta de economia
                        </h3>
                        <span class="text-sm font-bold text-poupai-green">75%</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Você está quase lá! Continue economizando para atingir seu
                        objetivo.</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-3">
                        <div class="bg-poupai-green h-2.5 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 flex items-center">
                                <span class="mr-2">📈</span> Receitas
                            </h3>
                            <p class="text-3xl font-bold text-poupai-dark mt-2">{{ summary.income }}</p>
                            <p class="text-xs text-green-600 mt-1">{{ summary.incomeChange }} vs. Mês anterior</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 flex items-center">
                                <span class="mr-2">📉</span> Despesas
                            </h3>
                            <p class="text-3xl font-bold text-poupai-dark mt-2">{{ summary.expenses }}</p>
                            <p class="text-xs text-red-600 mt-1">{{ summary.expensesChange }} vs. Mês anterior</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 flex items-center">
                                <span class="mr-2">⚖️</span> Balanço
                            </h3>
                            <p class="text-3xl font-bold text-poupai-dark mt-2">{{ summary.balance }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ summary.balanceChange }} vs. Mês anterior</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-poupai-dark mb-4">Atividade Recente</h3>
                        <ul class="space-y-4">
                            <li v-for="tx in recentTransactions" :key="tx.id"
                                class="flex items-center justify-between hover:bg-gray-50 p-2 rounded-md">
                                <div>
                                    <p class="font-semibold text-poupai-dark-gray">{{ tx.description }}</p>
                                    <p class="text-sm text-gray-500">{{ tx.category }}</p>
                                </div>
                                <p class="font-bold text-lg"
                                    :class="tx.type === 'income' ? 'text-poupai-green' : 'text-poupai-dark-gray'">
                                    {{ tx.amount }}
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-poupai-dark mb-4">Ações Rápidas</h3>
                            <div class="space-y-3">
                                <Link href="#"
                                    class="w-full text-center bg-poupai-green text-white font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity block">
                                Adicionar Receita
                                </Link>
                                <Link href="#"
                                    class="w-full text-center bg-poupai-dark text-white font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity block">
                                Adicionar Despesa
                                </Link>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-poupai-dark">Despesas por Categoria</h3>
                            <div class="mt-4 h-48 flex items-center justify-center text-gray-400">
                                [Gráfico de Pizza]
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
