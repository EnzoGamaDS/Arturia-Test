<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Lista de Pedidos</h1>
    <div v-for="pedido in pedidos" :key="pedido.id" class="mb-4 border rounded p-4">
      <h2 class="text-xl font-semibold">Pedido Número: {{ pedido.id }}</h2>
      <div v-for="produto in pedido.produtos" :key="produto.id" class="mb-2">
        <p><strong>Nome:</strong> {{ produto.produto.nome }}</p>
        <p><strong>Descrição:</strong> {{ produto.produto.descricao }}</p>
        <p><strong>Quantidade:</strong> {{ produto.quantidade }}</p>
        <p><strong>Preço:</strong> {{ produto.produto.preco }}</p>
        <p><strong>Peso:</strong> {{ produto.produto.peso }}</p>
      </div>
      <button @click="cancelarPedido(pedido.id)" class="bg-red-500 text-white px-4 py-2 rounded">Cancelar Pedido</button>
    </div>
  </div>
</template>

<script>
import { getPedidos, cancelarPedido } from '../api';

export default {
  data() {
    return {
      pedidos: [],
    };
  },
  async created() {
    this.pedidos = await getPedidos();
  },
  methods: {
    async cancelarPedido(id) {
      try {
        await cancelarPedido(id);
        this.pedidos = await getPedidos();
      } catch (error) {
        console.error('Erro ao cancelar pedido:', error);
      }
    },
  },
};
</script>

<style scoped>
.border {
  border-width: 1px;
  border-color: #ddd;
}

.rounded {
  border-radius: 0.25rem;
}

.p-4 {
  padding: 1rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

.text-2xl {
  font-size: 1.5rem;
}

.font-bold {
  font-weight: 700;
}

.text-xl {
  font-size: 1.25rem;
}

.font-semibold {
  font-weight: 600;
}

.bg-red-500 {
  background-color: #f56565;
}

.text-white {
  color: #fff;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.rounded {
  border-radius: 0.25rem;
}
</style>
