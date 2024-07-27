import { createStore } from 'vuex';
import { getUsuarios, getProdutos, getPedidos } from '../api';

const store = createStore({
  state() {
    return {
      usuarios: [],
      produtos: [],
      pedidos: [],
    };
  },
  mutations: {
    setUsuarios(state, usuarios) {
      state.usuarios = usuarios;
    },
    setProdutos(state, produtos) {
      state.produtos = produtos;
    },
    setPedidos(state, pedidos) {
      state.pedidos = pedidos;
    },
  },
  actions: {
    async fetchUsuarios({ commit }) {
      const usuarios = await getUsuarios();
      commit('setUsuarios', usuarios);
    },
    async fetchProdutos({ commit }) {
      const produtos = await getProdutos();
      commit('setProdutos', produtos);
    },
    async fetchPedidos({ commit }) {
      const pedidos = await getPedidos();
      commit('setPedidos', pedidos);
    },
  },
});

export default store;
