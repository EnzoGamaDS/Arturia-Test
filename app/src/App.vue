<template>
  <div class="min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white py-4 shadow-lg">
      <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Arturia E-commerce</h1>
        <nav class="flex items-center space-x-4">
          <router-link to="/usuarios" class="flex items-center space-x-2 hover:underline">
            <font-awesome-icon icon="user" />
            <span>Usuários</span>
          </router-link>
          <router-link to="/produtos" class="flex items-center space-x-2 hover:underline">
            <font-awesome-icon icon="box-open" />
            <span>Produtos</span>
          </router-link>
          <router-link to="/pedidos" class="flex items-center space-x-2 hover:underline">
            <font-awesome-icon icon="clipboard-list" />
            <span>Pedidos</span>
          </router-link>
          <router-link to="/pedidos" class="flex items-center space-x-2 text-white">
            <font-awesome-icon icon="shopping-cart" />
            <span>Carrinho</span>
          </router-link>
        </nav>
      </div>
    </header>
    <main class="container mx-auto flex-grow py-8">
      <router-view />
    </main>
    <footer class="bg-blue-600 text-white py-4 text-center shadow-lg">
      © 2024 Arturia E-commerce
    </footer>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style scoped>
.container {
  max-width: 1200px;
}

.input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 0.25rem;
  font-size: 1rem;
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

@media (min-width: 768px) {
  .input {
    max-width: 400px;
  }

  .button {
    width: auto;
  }
}

nav a {
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  background-color: #fff;
  color: #000;
  border-radius: 0.25rem;
  font-size: 1rem;
  text-decoration: none;
  transition: background-color 0.3s;
}

nav a:hover {
  background-color: #ddd;
}

.hero {
  background-color: #1877f2;
  color: white;
}

@media (min-width: 768px) {
  .container {
    max-width: 1200px;
  }
}
</style>
