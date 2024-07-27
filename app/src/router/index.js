import { createRouter, createWebHistory } from 'vue-router';
import ListaUsuarios from '../components/ListaUsuarios.vue';
import DetalheUsuario from '../components/DetalheUsuario.vue';
import ListaProdutos from '../components/ListaProdutos.vue';
import DetalheProduto from '../components/DetalheProduto.vue';
import ListaPedidos from '../components/ListaPedidos.vue';
import DetalhePedido from '../components/DetalhePedido.vue';
import HomePage from '../components/HomePage.vue';

const routes = [
  { path: '/', name: 'HomePage', component: HomePage },
  { path: '/usuarios', name: 'ListaUsuarios', component: ListaUsuarios },
  { path: '/usuarios/:id', name: 'DetalheUsuario', component: DetalheUsuario },
  { path: '/produtos', name: 'ListaProdutos', component: ListaProdutos },
  { path: '/produtos/:id', name: 'DetalheProduto', component: DetalheProduto },
  { path: '/pedidos', name: 'ListaPedidos', component: ListaPedidos },
  { path: '/pedidos/:id', name: 'DetalhePedido', component: DetalhePedido },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
