<template>
  <div>
    <h1>Lista de Usuários</h1>
    <form @submit.prevent="addUsuario">
      <input v-model="novoUsuario.nome" placeholder="Nome" />
      <input v-model="novoUsuario.email" placeholder="Email" />
      <button type="submit">Adicionar Usuário</button>
    </form>
    <ul>
      <li v-for="usuario in usuarios" :key="usuario.id">
        <router-link :to="`/usuarios/${usuario.id}`">{{ usuario.nome }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import { getUsuarios, createUsuario } from '../api';

export default {
  data() {
    return {
      usuarios: [],
      novoUsuario: {
        nome: '',
        email: '',
      },
    };
  },
  async created() {
    try {
      this.usuarios = await getUsuarios();
    } catch (error) {
      console.error('Erro ao buscar usuários:', error);
    }
  },
  methods: {
    async addUsuario() {
      try {
        await createUsuario(this.novoUsuario);
        this.usuarios = await getUsuarios();
        this.novoUsuario.nome = '';
        this.novoUsuario.email = '';
      } catch (error) {
        console.error('Erro ao adicionar usuário:', error);
      }
    },
  },
};
</script>
