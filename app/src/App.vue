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
          <button @click="toggleCart" class="flex items-center space-x-2 text-white">
            <font-awesome-icon icon="shopping-cart" />
            <span>Carrinho</span>
          </button>
        </nav>
      </div>
    </header>
    <main class="container mx-auto flex-grow py-8">
      <router-view />
    </main>
    <footer class="bg-blue-600 text-white py-4 text-center shadow-lg">
      © 2024 Arturia E-commerce
    </footer>

    <!-- Carrinho Lateral -->
    <div v-if="showCart" class="fixed inset-y-0 right-0 bg-white w-64 shadow-lg p-4 overflow-y-auto">
      <h2 class="text-2xl font-semibold mb-4">Carrinho</h2>
      <ul>
        <li v-for="(item, index) in cart" :key="index" class="mb-2 flex justify-between items-center">
          <div>
            <p class="font-semibold">{{ item.nome }}</p>
            <p>{{ item.peso }} kg</p>
            <p>{{ item.tipo }}</p>
            <p>R$ {{ item.preco }}</p>
          </div>
          <button @click="removeFromCart(index)" class="text-red-500 hover:text-red-700">Remover</button>
        </li>
      </ul>
      <button @click="finalizeOrder" class="bg-blue-600 text-white py-2 px-4 rounded mt-4">
        Finalizar Pedido
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      showCart: false,
      cart: []
    };
  },
  methods: {
    toggleCart() {
      this.showCart = !this.showCart;
    },
    addToCart(product) {
      this.cart.push(product);
    },
    removeFromCart(index) {
      this.cart.splice(index, 1);
    },
    async finalizeOrder() {
      if (this.cart.length === 0) {
        alert("O carrinho está vazio.");
        return;
      }

      try {
        await this.$http.post('/api/pedidos', { produtos: this.cart });
        this.cart = [];
        this.showCart = false;
        this.$router.push('/pedidos');
      } catch (error) {
        console.error("Erro ao finalizar o pedido:", error);
      }
    }
  }
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

.fixed {
  position: fixed;
}

.inset-y-0 {
  top: 0;
  bottom: 0;
}

.right-0 {
  right: 0;
}

.w-64 {
  width: 16rem;
}

.p-4 {
  padding: 1rem;
}

.shadow-lg {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
}

.overflow-y-auto {
  overflow-y: auto;
}
</style>
