<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Termos de Uso" />

    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <Link href="/">
                    <img src="/assets/img/logo_ico.png" alt="Logo Poupaí" class="w-20 h-20" />
                    </Link>
                </div>

                <div class="w-full sm:max-w-4xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                    <h1 class="text-center text-3xl mb-3">Termos de Uso do Poupaí</h1>
                    <p class="lead">Última atualização: 31 de agosto de 2025</p>

                    <h2 class="font-bold mt-3">1. Bem-vindo ao Poupaí!</h2>
                    <p>Estes Termos de Uso ("Termos") regem seu acesso e uso do aplicativo Poupaí ("Serviço"), fornecido
                        por [Nome da sua Empresa/Seu Nome]. Ao criar uma conta ou usar nosso Serviço, você concorda em
                        cumprir estes Termos.</p>

                    <h2 class="font-bold mt-3">2. Descrição do Serviço</h2>
                    <p>O Poupaí é um aplicativo de gestão de finanças pessoais que permite aos usuários registrar,
                        categorizar e visualizar suas receitas e despesas para melhor controle financeiro. O Serviço é
                        uma ferramenta de auxílio e não deve ser considerado como consultoria financeira.</p>

                    <h2 class="font-bold mt-3">3. Contas de Usuário</h2>
                    <p>Para utilizar o Serviço, você precisa se registrar e criar uma conta. Você é o único responsável
                        por manter a confidencialidade da sua senha e por todas as atividades que ocorram em sua conta.
                        Você concorda em nos notificar imediatamente sobre qualquer uso não autorizado de sua conta.</p>

                    <h2 class="font-bold mt-3">4. Seus Dados Financeiros</h2>
                    <p>Todos os dados de transações (receitas, despesas, categorias, etc.) que você insere no Poupaí são
                        de sua propriedade. Nós não reivindicamos qualquer propriedade sobre suas informações
                        financeiras. A nossa responsabilidade sobre esses dados é descrita em nossa Política de
                        Privacidade.</p>

                    <h2 class="font-bold mt-3">5. Uso Aceitável</h2>
                    <p>Você concorda em não usar o Serviço para qualquer finalidade ilegal ou proibida por estes Termos.
                        É proibido tentar obter acesso não autorizado aos nossos sistemas ou redes.</p>

                    <h2 class="font-bold mt-3">6. Isenção de Responsabilidade</h2>
                    <p>O Poupaí é fornecido "como está". Não garantimos que o Serviço será ininterrupto ou livre de
                        erros. Você é o único responsável por suas decisões financeiras.</p>

                    <h2 class="font-bold mt-3">7. Alterações nos Termos</h2>
                    <p>Podemos modificar estes Termos a qualquer momento. Notificaremos você sobre quaisquer alterações,
                        publicando os novos Termos no aplicativo. O uso continuado do Serviço após tais alterações
                        constitui sua aceitação dos novos Termos.</p>

                    <h2 class="font-bold mt-3">8. Contato</h2>
                    <p>Se você tiver alguma dúvida sobre estes Termos, entre em contato conosco pelo e-mail:
                        <a href="mailto:contato@poupai.app.br"><code
                                class="text-blue-500">contato@poupai.app.br</code></a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
