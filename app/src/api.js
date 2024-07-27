import axios from 'axios';

const apiBaseUrl = 'http://localhost:8080/api';

const api = axios.create({
  baseURL: apiBaseUrl,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Usuários
export const getUsuarios = async () => {
  const response = await api.get('/usuarios');
  return response.data;
};

export const getUsuario = async (id) => {
  const response = await api.get(`/usuarios/${id}`);
  return response.data;
};

export const createUsuario = async (usuario) => {
  const response = await api.post('/usuarios', usuario);
  return response.data;
};

export const updateUsuario = async (id, usuario) => {
  const response = await api.put(`/usuarios/${id}`, usuario);
  return response.data;
};

export const deleteUsuario = async (id) => {
  const response = await api.delete(`/usuarios/${id}`);
  return response.data;
};

// Produtos
export const getProdutos = async () => {
  const response = await api.get('/produtos');
  return response.data;
};

export const getProduto = async (id) => {
  const response = await api.get(`/produtos/${id}`);
  return response.data;
};

export const createProduto = async (produto) => {
  const response = await api.post('/produtos', produto);
  return response.data;
};

export const updateProduto = async (id, produto) => {
  const response = await api.put(`/produtos/${id}`, produto);
  return response.data;
};

export const deleteProduto = async (id) => {
  const response = await api.delete(`/produtos/${id}`);
  return response.data;
};

// Pedidos
export const getPedidos = async () => {
  const response = await api.get('/pedidos');
  return response.data;
};

export const getPedido = async (id) => {
  const response = await api.get(`/pedidos/${id}`);
  return response.data;
};

export const createPedido = async (pedido) => {
  const response = await api.post('/pedidos', pedido);
  return response.data;
};

export const updatePedido = async (id, pedido) => {
  const response = await api.put(`/pedidos/${id}`, pedido);
  return response.data;
};

export const deletePedido = async (id) => {
  const response = await api.delete(`/pedidos/${id}`);
  return response.data;
};

export const finalizarPedido = async (id) => {
  const response = await api.put(`/pedidos/finalizar/${id}`);
  return response.data;
};

export const cancelarPedido = async (id) => {
  const response = await api.put(`/cancelar/${id}`);
  return response.data;
};
