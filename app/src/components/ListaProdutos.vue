<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">Lista de Produtos</h2>
    <form @submit.prevent="addProduto" class="flex flex-col space-y-4 mb-6">
      <input v-model="novoProduto.nome" placeholder="Nome" class="p-2 border border-gray-300 rounded" />
      <input v-model="novoProduto.peso" placeholder="Peso" class="p-2 border border-gray-300 rounded" />
      <input v-model="novoProduto.tipo" placeholder="Tipo" class="p-2 border border-gray-300 rounded" />
      <button type="submit" class="bg-facebook text-white p-2 rounded">Adicionar Produto</button>
    </form>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border">
        <thead class="bg-gray-200">
          <tr>
            <th class="py-2 px-4">Nome</th>
            <th class="py-2 px-4">Peso</th>
            <th class="py-2 px-4">Tipo</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="produto in produtos" :key="produto.id" class="border-b">
            <td class="py-2 px-4">
              <router-link :to="`/produtos/${produto.id}`" class="text-facebook hover:underline">{{ produto.nome }}</router-link>
            </td>
            <td class="py-2 px-4">{{ produto.peso }}</td>
            <td class="py-2 px-4">{{ produto.tipo }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { getProdutos, createProduto } from '../api';

export default {
  data() {
    return {
      produtos: [],
      novoProduto: {
        nome: '',
        peso: '',
        tipo: '',
      },
    };
  },
  async created() {
    this.produtos = await getProdutos();
  },
  methods: {
    async addProduto() {
      try {
        await createProduto(this.novoProduto);
        this.produtos = await getProdutos();
        this.novoProduto.nome = '';
        this.novoProduto.peso = '';
        this.novoProduto.tipo = '';
      } catch (error) {
        console.error('Erro ao adicionar produto:', error);
      }
    },
  },
};
</script>
