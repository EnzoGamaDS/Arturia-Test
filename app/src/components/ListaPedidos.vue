<template>
  <div class="container">
    <h2>Lista de Pedidos</h2>
    <div v-if="pedidos && pedidos.length">
      <div v-for="pedido in pedidos" :key="pedido.id" class="pedido">
        <h3>Pedido Número: {{ pedido.id }}</h3>
        <ul class="produtos">
          <li v-for="produto in pedido.produtos" :key="produto.produto.id" class="produto">
            <strong>Nome:</strong> {{ produto.produto.nome }}<br />
            <strong>Descrição:</strong> {{ produto.produto.descricao }}<br />
            <strong>Quantidade:</strong> {{ produto.quantidade }}<br />
            <strong>Preço:</strong> {{ produto.produto.preco }}<br />
            <strong>Peso:</strong> {{ produto.produto.peso }} kg<br />
          </li>
        </ul>
        <button @click="cancelarPedido(pedido.id)">Cancelar Pedido</button>
      </div>
    </div>
    <div v-else>
      Nenhum pedido encontrado.
    </div>
  </div>
</template>

<script>
import { getPedidos, cancelarPedido } from '../api';

export default {
  data() {
    return {
      pedidos: [],
      error: null,
    };
  },
  async created() {
    await this.fetchPedidos();
  },
  methods: {
    async fetchPedidos() {
      try {
        const data = await getPedidos();
        if (data && data.length) {
          this.pedidos = data;
        } else {
          this.error = 'Nenhum pedido encontrado.';
        }
      } catch (error) {
        this.error = 'Erro ao buscar pedidos: ' + error.message;
        console.error('Erro ao buscar pedidos:', error);
      }
    },
    async cancelarPedido(id) {
      try {
        await cancelarPedido(id);
        this.fetchPedidos();
      } catch (error) {
        console.error('Erro ao cancelar pedido:', error);
      }
    }
  }
};
</script>

<style>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.pedido {
  border: 1px solid #ccc;
  margin-bottom: 20px;
  padding: 10px;
  border-radius: 5px;
}

.produtos {
  list-style-type: none;
  padding: 0;
}

.produto {
  border-top: 1px solid #eee;
  padding: 10px 0;
}

.produto:first-child {
  border-top: none;
}

button {
  margin-top: 10px;
  padding: 5px 10px;
  background-color: red;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: darkred;
}
</style>
