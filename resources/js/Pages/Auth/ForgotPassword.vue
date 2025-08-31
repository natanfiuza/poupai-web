<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>

        <Head title="Recuperar Senha" />

        <!-- <div class="flex justify-center mb-6">
            <Link href="/">
            <img src="/assets/img/logo_ico.png" alt="Logo Poupaí" class="w-20 h-20" />
            </Link>
        </div> -->

        <div class="mb-4 text-sm text-poupai-dark-gray">
            Esqueceu sua senha? Sem problemas. Apenas nos informe seu endereço de e-mail e enviaremos um link de
            redefinição de senha que permitirá que você escolha uma nova.
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton class="w-full justify-center bg-poupai-green hover:bg-opacity-90"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enviar Link de Redefinição
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
