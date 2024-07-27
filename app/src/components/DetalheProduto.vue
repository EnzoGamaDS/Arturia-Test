<template>
  <div>
    <h1>Detalhe do Produto</h1>
    <div v-if="produto">
      <p>Nome: {{ produto.nome }}</p>
      <p>Peso: {{ produto.peso }}</p>
      <p>Tipo: {{ produto.tipo }}</p>
      <router-link to="/produtos">Voltar para a lista de produtos</router-link>
    </div>
  </div>
</template>

<script>
import { getProduto } from '../api';

export default {
  data() {
    return {
      produto: null,
    };
  },
  async created() {
    const id = this.$route.params.id;
    this.produto = await getProduto(id);
  },
};
</script>

<style scoped>
@media (max-width: 768px) {
  p {
    font-size: 0.875rem;
  }
}
</style>
