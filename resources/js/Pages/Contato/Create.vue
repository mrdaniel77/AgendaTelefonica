<template>
  <div class="justify-center p-5 pb-5 mt-5">
    <div class="relative overflow-x-auto sm:rounded-lg">
      <form @submit.prevent="submit" class="max-w-sm mx-auto">
        <div class="mb-5">
          <label for="telefone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
          <input v-model="form.telefone" type="text" id="telefone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="(00) 00000-0000" required />
        </div>
        <div class="mb-5">
          <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
          <input v-model="form.nome" type="text" id="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Digite o nome" required />
        </div>
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
          <input v-model="form.email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
          <label for="imagem" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
          <input @change="handleFileUpload" type="file" id="imagem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-3">Submit</button>
      </form>
    </div>
  </div>
</template>

<script setup>

import { onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  contato: {
    type: Object,
    default: () => ({
      telefone: "",
      nome: "",
      email: "",
      imagem: null,
    }),
  },
  isUpdating: {
    type: Boolean,
    default: false,
  },
});

const form = useForm({
  telefone: "",
  nome: "",
  email: "",
  imagem: null
});

const handleFileUpload = (event) => {
  form.imagem = event.target.files[0];
};

const submit = () => {
  if (props.isUpdating) {
    updateContato();
  } else {
    addContato();
  }
};

const addContato = () => {
  form.post("/contatos");
};

const updatePost = () => {
  form.put(`/contatos/${props.contato.id}`);
};

onMounted(() => {
  if (props.contato) {
    form.telefone = props.contato.telefone;
    form.nome = props.contato.nome;
    form.email = props.contato.email;
    form.imagem = props.contato.imagem;
  }
});
</script>

<style lang="scss" scoped></style>