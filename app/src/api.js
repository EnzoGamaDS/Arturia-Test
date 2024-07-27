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

// Carrinho
export const getCarrinho = async () => {
  const response = await api.get('/carrinho');
  return response.data;
};

export const addCarrinho = async (produto) => {
  const response = await api.post('/carrinho', produto);
  return response.data;
};

export const removeFromCarrinho = async (id) => {
  const response = await api.delete(`/carrinho/${id}`);
  return response.data;
};

export const clearCarrinho = async () => {
  const response = await api.post('/carrinho/clear');
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

export const finalizarPedido = async () => {
  const response = await api.post('/carrinho/finalizar');
  return response.data;
};
