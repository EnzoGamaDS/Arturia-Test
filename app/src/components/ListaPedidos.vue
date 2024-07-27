<template>
  <div>
    <h1>Lista de Pedidos</h1>
    <form @submit.prevent="addPedido">
      <input v-model="novoPedido.usuario_id" placeholder="ID do Usuário" />
      <input v-model="novoPedido.produto_id" placeholder="ID do Produto" />
      <input v-model="novoPedido.quantidade" placeholder="Quantidade" />
      <input v-model="novoPedido.status" placeholder="Status" />
      <button type="submit">Adicionar Pedido</button>
    </form>
    <ul>
      <li v-for="pedido in pedidos" :key="pedido.id">
        <router-link :to="`/pedidos/${pedido.id}`">{{ pedido.id }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import { getPedidos, createPedido } from '../api';

export default {
  data() {
    return {
      pedidos: [],
      novoPedido: {
        usuario_id: '',
        produto_id: '',
        quantidade: '',
        status: '',
      },
    };
  },
  async created() {
    this.pedidos = await getPedidos();
  },
  methods: {
    async addPedido() {
      await createPedido(this.novoPedido);
      this.pedidos = await getPedidos();
      this.novoPedido.usuario_id = '';
      this.novoPedido.produto_id = '';
      this.novoPedido.quantidade = '';
      this.novoPedido.status = '';
    },
  },
};
</script>
