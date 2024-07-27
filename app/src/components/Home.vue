<template>
  <div class="hero text-center py-20">
    <h1 class="text-5xl font-bold mb-4">Bem-vindo ao Arturia E-commerce</h1>
    <p class="text-xl mb-8">Seu destino para as melhores compras online.</p>
    <router-link to="/produtos" class="button">Explorar Produtos</router-link>
  </div>
</template>

<script>
export default {
  name: 'HomePage',
};
</script>

<style scoped>
.hero {
  background-color: #1877f2;
  color: white;
}

.button {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  background-color: white;
  color: #1877f2;
  border: none;
  border-radius: 0.25rem;
  font-size: 1.25rem;
  cursor: pointer;
}

.button:hover {
  background-color: #165db1;
  color: white;
}
</style>
