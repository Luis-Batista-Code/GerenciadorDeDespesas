# 💵 Gerenciador de Despesas

Um Gerenciador de Despesas full-stack desenvolvido com a stack **Laravel (PHP)**.

Este projeto permite que múltiplos usuários cadastrem, visualizem e gerenciem suas despesas pessoais através de uma interface web moderna, com persistência de dados em banco de dados e autenticação de usuários.

## 🚀 Funcionalidades

-   ✅ **Autenticação Completa:** Sistema de login e registro de usuários (via Laravel Breeze).
-   💳 **Gestão de Despesas:** Cadastro de despesas com descrição, valor, data e categoria.
-   📊 **Dashboard em Tempo Real:** Visualização do total gasto e listagem de todas as despesas do usuário logado.
-   💾 **Persistência de Dados:** Uso do **SQLite** para salvar despesas de forma individual por usuário.
-   🎨 **Frontend Moderno:** Interface web responsiva com estética "macOS" (cantos arredondados, efeito *frosted glass*), construída com **Tailwind CSS**.
-   🗂️ **Categorias Dinâmicas:** Gerenciamento de categorias de despesas (populadas via Seeder).

## 🛠️ Tecnologias Utilizadas

-   **Backend:**
    -   PHP 8.2+
    -   Laravel 11
    -   Eloquent (ORM para o banco de dados)
-   **Frontend:**
    -   Blade (Template Engine do Laravel)
    -   Tailwind CSS (Para a estilização "macOS")
    -   Vite (Build tool do frontend)
-   **Banco de Dados:**
    -   SQLite
-   **Autenticação:**
    -   Laravel Breeze
-   **Arquitetura:**
    -   MVC (Model-View-Controller)

## 📁 Estrutura do Projeto
```sh
/gerenciador-despesas
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Auth/                 # Controladores de autenticação (do Breeze)
│   │       ├── ProfileController.php # Controlador do perfil do usuário
│   │       └── DespesaController.php # NOSSA LÓGICA PRINCIPAL
│   ├── Models/
│   │   ├── Categoria.php             # Nosso Model de Categoria
│   │   ├── Despesa.php               # Nosso Model de Despesa
│   │   └── User.php                  # Model de Usuário (do Breeze)
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   │   ├── ..._create_users_table.php
│   │   ├── ..._create_password_resets_table.php
│   │   ├── ..._create_categorias_table.php  # NOSSA MIGRATION
│   │   └── ..._create_despesas_table.php    # NOSSA MIGRATION
│   ├── seeders/
│   │   ├── CategoriaSeeder.php       # NOSSO SEEDER
│   │   └── DatabaseSeeder.php      # Chama o CategoriaSeeder
│   └── database.sqlite             # NOSSO BANCO DE DADOS
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── auth/                     # Telas de login/registro (do Breeze)
│       ├── layouts/                  # Layouts base (ex: app.blade.php)
│       ├── profile/                  # Tela de perfil (do Breeze)
│       ├── dashboard.blade.php       # NOSSA VIEW PRINCIPAL
│       └── welcome.blade.php       # Tela inicial do Laravel
├── routes/
│   ├── auth.php                    # Rotas de autenticação
│   └── web.php                     # NOSSAS ROTAS (Dashboard e Salvar Despesa)
├── storage/
├── tests/
├── vendor/
├── .env                            # ARQUIVO DE CONFIGURAÇÃO (IMPORTANTE)
├── .gitignore                      # Ignora arquivos (ex: vendor/, .env)
├── composer.json                   # Dependências do PHP (Backend)
├── package.json                    # Dependências do Node (Frontend)
├── tailwind.config.js              # Configuração do Tailwind CSS
└── vite.config.js                  # Configuração do Vite
```

## 💻 Como executar

**Pré-requisitos:** PHP, Composer, Node.js e NPM.

1.  Clone o repositório:
    `git clone https://github.com/Luis-Batista-Code/GerenciadorDeDespesas.git`

2.  Acesse o diretório do projeto:
    `cd GerenciadorDeDespesas`

3.  Instale as dependências do PHP (Backend):
    `composer install`

4.  Instale as dependências do Node.js (Frontend):
    `npm install`

5.  Crie seu arquivo de configuração `.env` (ele guardará a chave do app e a conexão do BD):
    `cp .env.example .env`

6.  Gere a chave de aplicação do Laravel:
    `php artisan key:generate`

7.  **Importante:** Configure o `.env` para usar o SQLite.
    * Abra o `.env` e **delete** as linhas `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.
    * Deixe **apenas** esta linha para o banco de dados:
        `DB_CONNECTION=sqlite`

8.  Crie o arquivo do banco de dados:
    `touch database/database.sqlite`

9.  Execute as migrações (para criar as tabelas) e os seeders (para popular as categorias):
    `php artisan migrate:fresh --seed`

10. **(Terminal 1)** Compile o frontend (Tailwind):
    `npm run dev`

11. **(Terminal 2)** Inicie o servidor:
    `php artisan serve`

12. Acesse `http://127.0.0.1:8000` no seu navegador, clique em **"Register"** e crie sua conta!

## 📄 Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 💻 Autor

-   **Luis Batista**
-   **GitHub:** `@Luis-Batista-Code`
