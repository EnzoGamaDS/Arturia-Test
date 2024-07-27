<template>
  <div>
    <h1 class="text-3xl font-semibold mb-6">Lista de Produtos</h1>
    <div v-for="produto in produtos" :key="produto.id" class="border p-4 mb-4 shadow-lg">
      <h2 class="text-2xl font-semibold">{{ produto.nome }}</h2>
      <p>Peso: {{ produto.peso }}</p>
      <p>Tipo: {{ produto.tipo }}</p>
      <p>Preço: R$ {{ produto.preco }}</p>
      <button @click="addProduto(produto)" class="bg-blue-600 text-white py-2 px-4 rounded mt-2">Adicionar ao Carrinho</button>
    </div>
  </div>
</template>

<script>
import { getProdutos } from '../api';

export default {
  data() {
    return {
      produtos: []
    };
  },
  async created() {
    this.produtos = await getProdutos();
  },
  methods: {
    addProduto(produto) {
      this.$root.addToCart(produto);
    }
  }
};
</script>
