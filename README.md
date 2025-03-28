# 🚀 Sistema de Gerenciamento de Permissões

Este é um sistema de gerenciamento de permissões onde o **primeiro usuário criado** se torna o **administrador** do sistema, e os usuários subsequentes têm permissões limitadas. O administrador tem acesso para gerencias usuários, enquanto os usuários comuns têm acesso restrito a determinadas funcionalidades.

---

## ⭐ Funcionalidades

### **Administrador**
O primeiro usuário criado no sistema é automaticamente o **administrador**, com os seguintes privilégios:
- ✅ Acessar a tela de **gerenciamento de permissões**.
- ✅ Realizar operações **CRUD** (Criar, Ler, Atualizar, Deletar) em usuários.

### **Usuário Comum**
Os usuários criados pelo administrador são considerados **usuários comuns**, com acesso limitado às seguintes funcionalidades:
- 🔐 Acessar as telas de **Product Management**, **Category Management**, e **Brand Management**.
- Essas telas estão protegidas por permissões específicas, com acesso controlado pelo middleware `can`.

---

## 💻 Como Rodar o Projeto

### **Clone o projeto na sua máquina**
```bash
git clone https://github.com/NlsGAA/sistema-login.git
```

### **Passo 1: Baixar as Dependências**

#### 1.1. Instale as dependências PHP com o Composer:
```bash
composer install
```

#### 1.2. Instale as dependências do frontend com o npm:
```bash
npm install
```

### **Passo 2: Configurar o Banco de Dados**

#### 2.1. Inicie o banco de dados utilizando o Docker:
```bash
docker-compose up -d
```

#### 2.2. Configure as variáveis de ambiente no arquivo .env
```bash
cp .env.example .env
```


#### 2.3. Execute as migrations para criar as tabelas no banco de dados:
```bash
php artisan migrate
```

### **Passo 3: Iniciar o Servidor**

```bash
php artisan serve
```

### **🌐 Rotas do Sistema**
As rotas do sistema podem ser acessadas via URL, utilizando o host http://127.0.0.1:8000/ seguido do nome da rota:

/
Tela de login do sistema

/register
Tela de cadastro para o primeiro usuário
(caso outros usuários, além do primeiro tente se registrar nessa rota, automaticamente será dado como usuário comum)

/permissions
Tela de gerenciamento de usuários (CRUD)
Somente Administrador

/product-management
Tela de gerenciamento de produtos

/category-management
Tela de gerenciamento de categorias

/brand-management
Tela de gerenciamento de marcas