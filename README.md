# Projeto Arturia E-commerce

O projeto Arturia E-commerce é uma plataforma de e-commerce que permite a gestão de produtos, usuários e pedidos. Ele inclui tanto o front-end quanto o back-end, oferecendo uma solução completa para a administração de um e-commerce.

## Estrutura do Projeto

- **app**: Diretório do front-end construído com Vue.js.
- **api**: Diretório do back-end construído com CodeIgniter.

## Configuração e Instalação

### Pré-requisitos

- Node.js instalado na versão 14 ou superior.
- PHP 7.4 ou superior.
- Composer instalado.
- MySQL ou outro banco de dados compatível.

### Configuração do Front-end (app)

1. **Clone o repositório do projeto:**

```bash
git clone https://github.com/usuario/arturia-ecommerce.git
cd arturia-ecommerce/app
```

2. **Instale as dependências do projeto:**

```bash
npm install
```

3. **Execute o servidor de desenvolvimento:**

```bash
npm run serve
```

O servidor estará disponível em `http://localhost:8081`.

### Configuração do Back-end (api)

1. **Clone o repositório do projeto (se ainda não tiver clonado):**

```bash
git clone https://github.com/usuario/arturia-ecommerce.git
cd arturia-ecommerce/api
```

2. **Instale as dependências do PHP usando o Composer:**

```bash
composer install
```

3. **Configure o arquivo `.env` com as informações do seu banco de dados:**

Crie uma cópia do arquivo `.env.example` e renomeie para `.env`. Atualize as informações de conexão do banco de dados conforme necessário.

4. **Execute as migrações para criar as tabelas no banco de dados:**

```bash
php spark migrate
```

5. **Popule o banco de dados com dados iniciais (se necessário):**

```bash
php spark db:seed
```

6. **Inicie o servidor do CodeIgniter:**

```bash
php spark serve
```

O servidor estará disponível em `http://localhost:8080`.

### Utilização

Após configurar e iniciar ambos os servidores (front-end e back-end), você pode acessar a aplicação em `http://localhost:8081`. A partir daí, você poderá:

- Visualizar a lista de produtos.
- Adicionar produtos ao carrinho.
- Finalizar pedidos.
- Visualizar e gerenciar pedidos.
- Adicionar, editar e remover usuários.

### Estrutura do Banco de Dados

O banco de dados possui as seguintes tabelas principais:

- **usuarios**: Tabela que armazena os dados dos usuários.
- **produtos**: Tabela que armazena os dados dos produtos.
- **pedidos**: Tabela que armazena os dados dos pedidos.
- **pedido_produto**: Tabela intermediária que armazena os produtos relacionados a cada pedido.

### Endpoints Principais

- **/api/usuarios**: Endpoints para CRUD de usuários.
- **/api/produtos**: Endpoints para CRUD de produtos.
- **/api/pedidos**: Endpoints para CRUD de pedidos.
- **/api/carrinho**: Endpoints para gerenciamento do carrinho de compras.

### Considerações Finais

Este projeto foi desenvolvido com o intuito de fornecer uma base sólida para a construção de uma plataforma de e-commerce. Sinta-se à vontade para personalizar e expandir conforme necessário para atender às suas necessidades específicas.

### Contato

Para mais informações, entre em contato pelo email [enzo.gamads@gmail.com](mailto:enzo.gamads@gmail.com).
