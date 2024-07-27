<template>
  <div class="home">
    <section class="hero bg-blue-600 text-white text-center py-20">
      <h1 class="text-5xl font-bold">Bem-vindo à Arturia E-commerce</h1>
      <p class="mt-4 text-xl">A melhor plataforma para gerenciar seus produtos e pedidos online.</p>
      <router-link to="/produtos" class="button mt-8">Explore Nossos Produtos</router-link>
    </section>
    <section class="about py-20 container mx-auto text-center">
      <h2 class="text-4xl font-bold">Sobre Nós</h2>
      <p class="mt-4 text-lg">
        Na Arturia E-commerce, oferecemos uma plataforma completa para você gerenciar seus produtos e pedidos de forma eficiente e prática. Nossa missão é proporcionar a melhor experiência de usuário, focada em design intuitivo e funcionalidades robustas.
      </p>
    </section>
    <section class="features py-20 bg-gray-100">
      <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold">Funcionalidades</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
          <div class="feature bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-2xl font-bold">Gestão de Usuários</h3>
            <p class="mt-2">Adicione, edite e remova usuários com facilidade, garantindo um controle completo da sua base de clientes.</p>
          </div>
          <div class="feature bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-2xl font-bold">Gestão de Produtos</h3>
            <p class="mt-2">Gerencie seu catálogo de produtos, com opções para adicionar descrições, preços e detalhes de forma intuitiva.</p>
          </div>
          <div class="feature bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-2xl font-bold">Gestão de Pedidos</h3>
            <p class="mt-2">Acompanhe e gerencie os pedidos dos seus clientes, garantindo um processo de venda eficiente e sem complicações.</p>
          </div>
        </div>
      </div>
    </section>
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
}

.button {
  display: inline-block;
  padding: 1rem 2rem;
  background-color: #fff;
  color: #1877f2;
  border: none;
  border-radius: 0.25rem;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
}

.button:hover {
  background-color: #e7e7e7;
}
</style>
