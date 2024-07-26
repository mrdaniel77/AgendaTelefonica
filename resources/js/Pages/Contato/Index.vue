<template>
  <div class="flex justify-center py-12 ">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th v-for="header in headers" :key="header" scope="col" class="px-6 py-3">
                  {{ header }}
                </th>                  
              </tr>
          </thead>
          <tbody>
            <tr v-for="contato in contatos" :key="contato.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
              <td class="px-6 py-4">{{ contato.telefone }}</td>
              <td class="px-6 py-4">{{ contato.nome }}</td>
              <td class="px-6 py-4">{{ contato.email }}</td>
              <td class="px-6 py-4">
                <img :src="getImageUrl(contato.imagem)" alt="Imagem do contato" class="w-12 h-12 object-cover rounded">
              </td>             
              <td>
                <div class="flex">
                    <button class="flex-auto font-medium text-blue-600 dark:text-blue-500 ">
                      <Link :href="`/contatos/${contato.id}/edit`" class="font-medium text-blue-600 dark:text-blue-500 "><i class="pi pi-user-edit" style="font-size: 1rem"></i></Link>
                    </button>
                    <button @click="deleteContato(contato.id)" class="flex-auto font-medium text-blue-600 dark:text-blue-500"><i class="pi pi-trash" style="font-size: 1rem"></i></button>
                </div>                
              </td>            
            </tr>                       
          </tbody>
      </table>
    </div>
    <div>
      <div class="px-6 pt-4 pb-2">
        <button class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
            <Link href="/contatos/create/">Novo contato</Link>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
  contatos: {
    type: Array,
    default: () => [],
  },
});

const getImageUrl = (imagem) => {
  return `/storage/${imagem}`;
};

const headers = [
    "telefone",
    "nome",
    "email",
    "imagem",
    "ações"
    ];

const form = useForm({});

const deleteContato = (id) => {
    form.delete(`/contatos/${id}`);
};
</script>

<style scoped>
.botao{
  background-color: aquamarine;
  padding: 0.5%;
  border: 2%;
}
</style>