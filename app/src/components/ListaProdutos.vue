<template>
  <div>
    <h1>Lista de Produtos</h1>
    <form @submit.prevent="addProduto">
      <input v-model="novoProduto.nome" placeholder="Nome" />
      <input v-model="novoProduto.peso" placeholder="Peso" />
      <input v-model="novoProduto.tipo" placeholder="Tipo" />
      <button type="submit">Adicionar Produto</button>
    </form>
    <ul>
      <li v-for="produto in produtos" :key="produto.id">
        <router-link :to="`/produtos/${produto.id}`">{{ produto.nome }}</router-link>
      </li>
    </ul>
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
      await createProduto(this.novoProduto);
      this.produtos = await getProdutos();
      this.novoProduto.nome = '';
      this.novoProduto.peso = '';
      this.novoProduto.tipo = '';
    },
  },
};
</script>
