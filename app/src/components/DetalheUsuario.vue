<template>
  <div class="my-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Detalhes do Usuário</h2>
    <p class="mb-2"><strong>Nome:</strong> {{ usuario.nome }}</p>
    <p class="mb-4"><strong>Email:</strong> {{ usuario.email }}</p>
    <router-link to="/usuarios" class="text-blue-600 hover:underline">Voltar para a Lista de Usuários</router-link>
  </div>
</template>

<script>
import { getUsuario } from '../api';

export default {
  data() {
    return {
      usuario: {},
    };
  },
  async created() {
    const { id } = this.$route.params;
    this.usuario = await getUsuario(id);
  },
};
</script>

<style scoped>
p {
  margin-bottom: 1rem;
}

@media (max-width: 768px) {
  .text-2xl {
    font-size: 1.5rem;
  }
  p {
    font-size: 0.875rem;
  }
}
</style>
