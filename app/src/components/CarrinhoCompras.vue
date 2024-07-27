<template>
  <div>
    <h1 class="text-4xl font-bold mb-6">Carrinho de Compras</h1>
    <div v-for="produto in carrinho" :key="produto.id" class="mb-4 border p-4">
      <h2 class="text-2xl font-bold">{{ produto.nome }}</h2>
      <p>Peso: {{ produto.peso }}</p>
      <p>Tipo: {{ produto.tipo }}</p>
      <p>Preço: {{ produto.preco }}</p>
      <p>Quantidade: {{ produto.quantidade }}</p>
      <button @click="removeFromCart(produto.id)" class="button">Remover</button>
    </div>
    <button @click="finalizarPedido" class="button">Finalizar Pedido</button>
  </div>
</template>

<script>
import { getCarrinho, removeFromCarrinho, finalizarPedido } from '../api';

export default {
  data() {
    return {
      carrinho: [],
    };
  },
  async created() {
    try {
      this.carrinho = await getCarrinho();
    } catch (error) {
      console.error('Erro ao buscar carrinho:', error);
    }
  },
  methods: {
    async removeFromCart(produtoId) {
      try {
        await removeFromCarrinho(produtoId);
        this.carrinho = await getCarrinho();
      } catch (error) {
        console.error('Erro ao remover produto do carrinho:', error);
      }
    },
    async finalizarPedido() {
      try {
        await finalizarPedido();
        this.carrinho = [];
      } catch (error) {
        console.error('Erro ao finalizar pedido:', error);
      }
    }
  }
};
</script>

<style scoped>
.button {
  display: inline-block;
  padding: 0.5rem 1rem;
  background-color: #1877f2;
  color: #fff;
  border: none;
  border-radius: 0.25rem;
  font-size: 1rem;
  cursor: pointer;
}

.button:hover {
  background-color: #165db1;
}
</style>
