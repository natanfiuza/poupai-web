# Poupaí - Gestor de Finanças Pessoais

![Logo Poupaí](public/assets/img/logo_vertical_branco.png)

Poupaí é uma aplicação web de gestão de finanças pessoais, projetada para ajudar os usuários a controlar suas receitas e despesas de forma simples e intuitiva.

---

## 📜 Sobre o Projeto

Este projeto consiste na API (back-end) e no App Web (front-end) do Poupaí. O objetivo é fornecer uma plataforma robusta e amigável para o gerenciamento financeiro, com funcionalidades como dashboard, registro de transações, categorização e visualização de dados.

O back-end é construído com Laravel e serve uma API que se comunica com o front-end, construído com Vue.js e Inertia.js.

E também um API para disponibilizar os dados para o aplicativo mobile do projeto.

---

## 🛠️ Stack de Tecnologias

Este projeto foi construído com as seguintes tecnologias:

* **Back-end**: PHP (Laravel Framework)
* **Front-end**: Vue.js (com Inertia.js)
* **Banco de Dados**: MySQL
* **Estilização**: Tailwind CSS
* **Autenticação de API**: Laravel Sanctum
* **Autenticação Web**: Laravel Breeze

---

## ⚙️ Pré-requisitos

Antes de começar, certifique-se de que você tem os seguintes softwares instalados na sua máquina:

* PHP `^8.2`
* Composer `^2.5`
* Node.js `^20.x`
* NPM `^10.x`
* Um servidor de banco de dados MySQL

---

## 🚀 Instruções de Instalação

Siga o passo a passo abaixo para configurar o ambiente de desenvolvimento local.

1.  **Clone o repositório:**
    ```bash
    git clone git@github.com:natanfiuza/poupai-web.git
    cd poupai-api
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Instale as dependências do Node.js:**
    ```bash
    npm install
    ```

4.  **Configure o arquivo de ambiente:**
    Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

6.  **Configure o banco de dados:**
    Abra o arquivo `.env` e atualize as variáveis de banco de dados (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) com as suas credenciais locais.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=poupai_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *Não se esqueça de criar o banco de dados `poupai_db` no seu MySQL.*

7.  **Execute as migrations e os seeders:**
    Este comando irá criar todas as tabelas e popular o banco de dados com os dados iniciais (categorias, tipos de pagamento, etc.).
    ```bash
    php artisan migrate:fresh --seed
    ```

---

## ▶️ Como Rodar o Projeto

Para iniciar a aplicação, você precisará rodar dois comandos em **terminais separados**:

1.  **Inicie o servidor de front-end (Vite):**
    ```bash
    npm run dev
    ```

2.  **Inicie o servidor de back-end (Laravel):**
    ```bash
    php artisan serve
    ```

Após executar os dois comandos, a aplicação estará disponível em `http://127.0.0.1:8000`.

---

## ✨ Funcionalidades Principais

* Autenticação de usuários (Registro e Login).
* Dashboard com resumo financeiro (Saldo, Receitas, Despesas).
* Criação e gerenciamento de categorias personalizadas.
* Registro de transações (receitas e despesas).
* Páginas de Termos de Uso e Política de Privacidade.
* Design totalmente responsivo.

---

## 📄 Licença

Este projeto é de código fechado. Todos os direitos reservados.

---

## 👤 Contato

**[Seu Nome]**
* **E-mail**: `[contato@natanfiuza.dev.br]`
* **LinkedIn**: `https://linkedin.com/in/natanfiuza`
