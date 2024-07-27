<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">Lista de Pedidos</h2>
    <form @submit.prevent="addPedido" class="flex flex-col space-y-4 mb-6">
      <input v-model="novoPedido.nome" placeholder="Nome do Pedido" class="p-2 border border-gray-300 rounded" />
      <button type="submit" class="bg-facebook text-white p-2 rounded">Adicionar Pedido</button>
    </form>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border">
        <thead class="bg-gray-200">
          <tr>
            <th class="py-2 px-4">Nome</th>
            <th class="py-2 px-4">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pedido in pedidos" :key="pedido.id" class="border-b">
            <td class="py-2 px-4">
              <router-link :to="`/pedidos/${pedido.id}`" class="text-facebook hover:underline">{{ pedido.nome }}</router-link>
            </td>
            <td class="py-2 px-4">{{ pedido.status }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { getPedidos, createPedido } from '../api';

export default {
  data() {
    return {
      pedidos: [],
      novoPedido: {
        nome: '',
      },
    };
  },
  async created() {
    this.pedidos = await getPedidos();
  },
  methods: {
    async addPedido() {
      try {
        await createPedido(this.novoPedido);
        this.pedidos = await getPedidos();
        this.novoPedido.nome = '';
      } catch (error) {
        console.error('Erro ao adicionar pedido:', error);
      }
    },
  },
};
</script>
