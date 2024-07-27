<template>
  <div class="min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white py-4 shadow-lg">
      <div class="container mx-auto flex justify-between items-center px-4">
        <router-link to="/" class="text-3xl font-semibold hover:text-gray-300">Arturia E-commerce</router-link>
        <nav class="flex items-center space-x-4">
          <router-link to="/usuarios" class="flex items-center space-x-2 text-white hover:text-gray-300">
            <font-awesome-icon icon="user" />
            <span>Usuários</span>
          </router-link>
          <router-link to="/produtos" class="flex items-center space-x-2 text-white hover:text-gray-300">
            <font-awesome-icon icon="box-open" />
            <span>Produtos</span>
          </router-link>
          <router-link to="/pedidos" class="flex items-center space-x-2 text-white hover:text-gray-300">
            <font-awesome-icon icon="clipboard-list" />
            <span>Pedidos</span>
          </router-link>
          <button @click="toggleCart" class="flex items-center space-x-2 text-white hover:text-gray-300">
            <font-awesome-icon icon="shopping-cart" />
            <span>Carrinho</span>
          </button>
        </nav>
      </div>
    </header>
    <main class="container mx-auto flex-grow py-8 px-4">
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
            <div class="flex items-center">
              <button @click="decreaseQuantity(index)" class="quantity-button">-</button>
              <span class="mx-2">{{ item.quantidade }}</span>
              <button @click="increaseQuantity(index)" class="quantity-button">+</button>
            </div>
          </div>
          <button @click="removeFromCart(index)" class="remove-button">Remover</button>
        </li>
      </ul>
      <div class="text-right font-semibold mt-4">
        <p>Total: R$ {{ total.toFixed(2) }}</p>
      </div>
      <button @click="clearCart" class="clear-cart-button">
        Limpar Carrinho
      </button>
      <button @click="finalizeOrder" class="finalize-order-button">
        Finalizar Pedido
      </button>
    </div>
  </div>
</template>

<script>
import { createPedido } from './api';

export default {
  name: 'App',
  data() {
    return {
      showCart: false,
      cart: JSON.parse(localStorage.getItem('cart')) || []
    };
  },
  computed: {
    total() {
      return this.cart.reduce((acc, item) => {
        return acc + (item.preco * item.quantidade);
      }, 0);
    }
  },
  watch: {
    cart: {
      handler(newCart) {
        localStorage.setItem('cart', JSON.stringify(newCart));
      },
      deep: true
    }
  },
  methods: {
    toggleCart() {
      this.showCart = !this.showCart;
    },
    addToCart(product) {
      const existingProduct = this.cart.find(item => item.id === product.id);
      if (existingProduct) {
        existingProduct.quantidade++;
      } else {
        this.cart.push({ ...product, quantidade: 1 });
      }
      this.showCart = true;
    },
    removeFromCart(index) {
      this.cart.splice(index, 1);
    },
    clearCart() {
      this.cart = [];
    },
    increaseQuantity(index) {
      this.cart[index].quantidade++;
    },
    decreaseQuantity(index) {
      if (this.cart[index].quantidade > 1) {
        this.cart[index].quantidade--;
      } else {
        this.removeFromCart(index);
      }
    },
    async finalizeOrder() {
      if (this.cart.length === 0) {
        alert("O carrinho está vazio.");
        return;
      }

      try {
        await createPedido({ produtos: this.cart });
        this.cart = [];
        this.showCart = false;
        this.$router.push('/pedidos');
      } catch (error) {
        console.error("Erro ao finalizar o pedido:", error);
      }
    }
  },
  beforeRouteLeave(to, from, next) {
    this.showCart = false;
    next();
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

nav a {
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  color: #fff;
  border-radius: 0.25rem;
  font-size: 1rem;
  text-decoration: none;
  transition: background-color 0.3s;
}

nav a:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.hero {
  background-color: #1877f2;
  color: white;
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

.quantity-button {
  background-color: #f0f2f5;
  border: none;
  padding: 0.5rem;
  border-radius: 0.25rem;
  cursor: pointer;
}

.quantity-button:hover {
  background-color: #e1e4e8;
}

.remove-button {
  background-color: #ff4d4f;
  border: none;
  padding: 0.5rem;
  border-radius: 0.25rem;
  cursor: pointer;
  color: white;
}

.remove-button:hover {
  background-color: #d9363e;
}

.clear-cart-button {
  background-color: #ff4d4f;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  cursor: pointer;
  color: white;
  margin-top: 1rem;
}

.clear-cart-button:hover {
  background-color: #d9363e;
}

.finalize-order-button {
  background-color: #1877f2;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  cursor: pointer;
  color: white;
  margin-top: 1rem;
}

.finalize-order-button:hover {
  background-color: #165db1;
}

.add-to-cart-button {
  background-color: #1877f2;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  cursor: pointer;
  color: white;
  transition: background-color 0.3s;
}

.add-to-cart-button:hover {
  background-color: #165db1;
}

.add-to-cart {
  background-color: #1877f2;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.add-to-cart:hover {
  background-color: #165db1;
}

.cart-button {
  background-color: transparent;
  color: white;
  border: none;
  cursor: pointer;
  transition: color 0.3s;
}

.cart-button:hover {
  color: rgba(255, 255, 255, 0.7);
}

@media (max-width: 768px) {
  .flex.items-center.space-x-4 {
    flex-direction: column;
    align-items: flex-start;
    space-y-4: 1rem;
    space-x-0: 0;
  }
  .flex.justify-between.items-center {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
