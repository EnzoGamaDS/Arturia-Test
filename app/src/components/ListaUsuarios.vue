<template>
  <div>
    <h1 class="text-4xl font-bold mb-6">Lista de Usuários</h1>
    <form @submit.prevent="addUsuario" class="mb-6">
      <input v-model="novoUsuario.nome" placeholder="Nome" class="input mb-2"/>
      <input v-model="novoUsuario.email" placeholder="Email" class="input mb-2"/>
      <button type="submit" class="button">Adicionar Usuário</button>
    </form>
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="py-2">Nome</th>
          <th class="py-2">Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in usuarios" :key="usuario.id">
          <td class="border px-4 py-2">
            <p>{{ usuario.nome }}</p>
          </td>
          <td class="border px-4 py-2">{{ usuario.email }}</td>
        </tr>
      </tbody>
    </table>
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
    this.usuarios = await getUsuarios();
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
        console.error('Detalhes do erro:', error.response.data); // Detalhes do erro
      }
    },
  },
};
</script>

<style scoped>
.input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 0.25rem;
  font-size: 1rem;
  margin-bottom: 0.5rem;
}

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

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 0.5rem;
}

th {
  background-color: #f2f2f2;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

@media (max-width: 768px) {
  .input {
    font-size: 0.875rem;
  }
  .button {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
  }
  table {
    font-size: 0.875rem;
  }
  th, td {
    padding: 0.25rem;
  }
}
</style>
