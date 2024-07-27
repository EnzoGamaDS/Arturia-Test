<template>
  <div>
    <h1>Detalhe do Usuário</h1>
    <div v-if="usuario">
      <p>Nome: {{ usuario.nome }}</p>
      <p>Email: {{ usuario.email }}</p>
      <router-link to="/usuarios">Voltar para a lista de usuários</router-link>
    </div>
  </div>
</template>

<script>
import { getUsuario } from '../api';

export default {
  data() {
    return {
      usuario: null,
    };
  },
  async created() {
    const id = this.$route.params.id;
    this.usuario = await getUsuario(id);
  },
};
</script>
