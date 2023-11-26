<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    user: {
        type: Object,
    },
});

const form = useForm({
    nome: props.user.nome,
    email: props.user.email,
    dni: props.user.dni,
    num_socia: props.user.num_socia,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Datos da socia</h2>
        </header>

        <form @submit.prevent="form.patch(route('users.update', user))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="nome" value="Nome" />

                <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" required autofocus
                    autocomplete="nome" />

                <InputError class="mt-2" :message="form.errors.nome" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="dni" value="DNI" />

                <TextInput id="dni" type="text" class="mt-1 block w-full" v-model="form.dni" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.dni" />
            </div>

            <div>
                <InputLabel for="num_socia" value="Número de socia" />

                <TextInput id="num_socia" type="number" class="mt-1 block w-full" v-model="form.num_socia" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.num_socia" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
