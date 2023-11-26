<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head, router } from '@inertiajs/vue3';
import { ref } from "vue";
import { watch } from "vue";

import Pagination from '@/Components/Pagination.vue';

defineProps({ users: Array });

let termo = ref('');
watch(termo, (valor) => {
    router.get(
        "/users",
        { termo: valor },
        {
            preserveState: true,
        }
    );
}); 
</script>

<template>
    <Head title="Socias" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gris leading-tight">Socias</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div
                                    class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                                    <div class="py-3 px-4">
                                        <div class="relative max-w-xs">
                                            <input type="text" name="hs-table-with-pagination-search" v-model="termo"
                                                id="hs-table-with-pagination-search"
                                                class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                                placeholder="Buscar socia">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <circle cx="11" cy="11" r="8" />
                                                    <path d="m21 21-4.3-4.3" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        # socia</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Nome</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        DNI</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                <tr v-for="user in users.data" :key="user.id">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        {{ user.num_socia }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        {{ user.nome }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ user.dni }}</td>
                                                    <td>
                                                        <Link :href="route('users.edit', user.id)"
                                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-verde hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                        Editar</Link>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="py-1 px-4">
                                        <pagination :links="users.links" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
