<template>
  <div>
    <h1 class="text-3xl font-semibold mb-6">Lista de Produtos</h1>
    <div v-for="produto in produtos" :key="produto.id" class="border p-4 mb-4 shadow-lg">
      <h2 class="text-2xl font-semibold">{{ produto.nome }}</h2>
      <p>Peso: {{ produto.peso }}</p>
      <p>Tipo: {{ produto.tipo }}</p>
      <p>Preço: R$ {{ produto.preco }}</p>
      <button @click="addProduto(produto)" class="bg-blue-600 text-white py-2 px-4 rounded mt-2">Adicionar ao Carrinho</button>
    </div>
  </div>
</template>

<script>
import { getProdutos } from '../api';

export default {
  data() {
    return {
      produtos: []
    };
  },
  async created() {
    this.produtos = await getProdutos();
  },
  methods: {
    addProduto(produto) {
      this.$root.addToCart(produto);
    }
  }
};
</script>

<style scoped>
.border {
  border-width: 1px;
  border-color: #ddd;
}

.rounded {
  border-radius: 0.25rem;
}

.p-4 {
  padding: 1rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

.text-3xl {
  font-size: 1.875rem;
}

.font-semibold {
  font-weight: 600;
}

.bg-blue-600 {
  background-color: #1877f2;
}

.text-white {
  color: #fff;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.rounded {
  border-radius: 0.25rem;
}

.mt-2 {
  margin-top: 0.5rem;
}

@media (max-width: 768px) {
  .p-4 {
    padding: 0.5rem;
  }
  .px-4 {
    padding-left: 0.5rem;
    padding-right: 0.5rem;
  }
  .py-2 {
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
  }
  .mb-4 {
    margin-bottom: 0.5rem;
  }
  .text-3xl {
    font-size: 1.5rem;
  }
  .text-2xl {
    font-size: 1.25rem;
  }
}
</style>
