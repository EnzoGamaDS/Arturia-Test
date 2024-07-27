import { createRouter, createWebHistory } from 'vue-router';
import ListaUsuarios from '../components/ListaUsuarios.vue';
import ListaProdutos from '../components/ListaProdutos.vue';
import ListaPedidos from '../components/ListaPedidos.vue';
import DetalheUsuario from '../components/DetalheUsuario.vue';
import DetalheProduto from '../components/DetalheProduto.vue';
import DetalhePedido from '../components/DetalhePedido.vue';

const routes = [
  { path: '/usuarios', component: ListaUsuarios },
  { path: '/usuarios/:id', component: DetalheUsuario },
  { path: '/produtos', component: ListaProdutos },
  { path: '/produtos/:id', component: DetalheProduto },
  { path: '/pedidos', component: ListaPedidos },
  { path: '/pedidos/:id', component: DetalhePedido },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
