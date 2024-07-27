import { createRouter, createWebHistory } from 'vue-router';
import ListaUsuarios from '../components/ListaUsuarios.vue';
import ListaProdutos from '../components/ListaProdutos.vue';
import CarrinhoCompras from '../components/CarrinhoCompras.vue';
import ListaPedidos from '../components/ListaPedidos.vue';
import Home from '../components/Home.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/usuarios', component: ListaUsuarios },
  { path: '/produtos', component: ListaProdutos },
  { path: '/carrinho', component: CarrinhoCompras },
  { path: '/pedidos', component: ListaPedidos },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
