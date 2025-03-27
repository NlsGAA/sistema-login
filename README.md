# 🚀 Sistema de Gerenciamento de Permissões

Este é um sistema de gerenciamento de permissões onde o **primeiro usuário criado** se torna o **administrador** do sistema, e os usuários subsequentes têm permissões limitadas. O administrador tem acesso completo ao sistema, podendo gerenciar usuários e permissões, enquanto os usuários comuns têm acesso restrito a determinadas funcionalidades.

---

## ⭐ Funcionalidades

### **Administrador**
O primeiro usuário criado no sistema é automaticamente o **administrador**, com privilégios totais:
- ✅ Acessar a tela de **gerenciamento de permissões**.
- ✅ Realizar operações **CRUD** (Criar, Ler, Atualizar, Deletar) em usuários.

### **Usuário Comum**
Os usuários criados pelo administrador são considerados **usuários comuns**, com acesso limitado às seguintes funcionalidades:
- 🔐 Acessar as telas de **Product Management**, **Category Management**, e **Brand Management**.
- Essas telas estão protegidas por permissões específicas, com acesso controlado pelo middleware `can`.

---

## 💻 Como Rodar o Projeto

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
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=sua_senha
```


#### 2.3. Execute as migrations para criar as tabelas no banco de dados:
```bash
php artisan migrate
```

### **Passo 4: Iniciar o Servidor**

#### O primeiro usuário será automaticamente o administrador:


### **Passo 3: Criar o Primeiro Usuário (Administrador)**

#### Inicie o servidor do Laravel
```bash
php artisan serve
```

### **🌐 Rotas do Sistema**
As rotas do sistema podem ser acessadas via URL, utilizando o host http://127.0.0.1:8000/ seguido do nome da rota:

/product-management
Tela de gerenciamento de produtos

/category-management
Tela de gerenciamento de categorias

/brand-management
Tela de gerenciamento de marcas

/permissions
Tela de gerenciamento de usuários (CRUD)
Somente Administrador
