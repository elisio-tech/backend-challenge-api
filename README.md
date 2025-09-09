  <br />
    <a href="https://laravel.com" target="_blank">
      <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" width="120">
    </a>
  <br />

  <div>
    <img src="https://img.shields.io/badge/-Laravel-black?style=for-the-badge&logo=laravel&logoColor=white&color=FF2D20" alt="Laravel" />
    <img src="https://img.shields.io/badge/-PHP_8.3+-black?style=for-the-badge&logo=php&logoColor=white&color=777BB4" alt="PHP" />
    <img src="https://img.shields.io/badge/-PostgreSQL-black?style=for-the-badge&logo=postgresql&logoColor=white&color=4169E1" alt="PostgreSQL" />
    <img src="https://img.shields.io/badge/-MySQL-black?style=for-the-badge&logo=mysql&logoColor=white&color=4479A1" alt="MySQL" />
    <img src="https://img.shields.io/badge/-Sanctum-black?style=for-the-badge&logo=laravel&logoColor=white&color=FF2D20" alt="Sanctum" />
  </div>

  <h3 align="center">📌 Mini Plataforma de Inscrições & Seleção (API)</h3>
  <p align="center">
    API desenvolvida em Laravel para gerir Programas, Candidatos e Candidaturas, com autenticação via Sanctum.
  </p>
</div>

# Desafio Técnico - Plataforma de Inscrições & Seleção

Bem-vindo(a) ao repositório do projeto de API para uma plataforma de Inscrições & Seleção. Este projeto foi desenvolvido como parte de um desafio técnico para uma vaga de Backend Developer (Laravel).

A API permite a gestão de Programas, Candidatos e Candidaturas, seguindo as regras de negócio e os requisitos técnicos especificados.

---

### Requisitos do Projeto

* **Backend:** Laravel (versão 11/12)
* **Linguagem:** PHP 8.3+
* **Autenticação:** Laravel Sanctum
* **Banco de Dados:** PostgreSQL (configurável para MySQL)
* **Documentação:** Postman Collection

---

### Funcionalidades Implementadas

A API oferece os seguintes endpoints, com suas respectivas regras de negócio e validações:

* **Autenticação (`/api/login`, `/api/register`, `/api/logout`)**:
    * Registro de novos usuários (candidatos) com validação de e-mail único.
    * Login de usuários e emissão de tokens de acesso usando Laravel Sanctum.
    * Logout para revogar o token de acesso atual.

* **Gestão de Programas (`/api/programas`)**:
    * Endpoints para listar, visualizar, criar, atualizar e deletar programas.
    * CRUD completo para a gestão dos programas (restrito a usuários com privilégio de `admin`).

* **Gestão de Candidaturas (`/api/candidaturas`)**:
    * Listagem de todas as candidaturas.
    * Submissão de candidaturas com validação de regras de negócio:
        * O candidato precisa estar autenticado.
        * O programa deve estar ativo e dentro do período de datas de inscrição (`start_date` ≤ hoje ≤ `end_date`).
        * Um candidato não pode se candidatar ao mesmo programa mais de uma vez.

---

### Instalação e Configuração

Siga estes passos para configurar e executar o projeto em sua máquina local.

#### 1. Clonar o Repositório
```bash
git clone git@github.com:elisio-tech/backend-challenge-api.git
cd  backend-challenge-api
```

#### 2. Configurar variaveis de ambiente
	*Copie para .env:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inscricao_api
DB_USERNAME=root
DB_PASSWORD=password_api
```

#### Como Testar a API

A documentação da API está disponível no formato Postman Collection.

### 1. Importar a Coleção do Postman

Importe o arquivo collection.json para o Postman. Este arquivo contém todos os endpoints e exemplos de requisição.

### 2. Credenciais de Teste

Após rodar os seeds, você terá os seguintes usuários de demonstração no banco de dados:

    Usuário Administrador:

        Email: admin@gmail.com

        Senha: admin12@

    Usuário Candidato:

        Email: brunofernando@gmail.com

        Senha: bruno1234

### Use as credenciais de admin para testar os endpoints de Programas e as credenciais de user para testar a submissão de candidaturas.

### Contato

Desenvolvido por: Elisio Augusto || E-mail: elisiouiux@gmail.com || GitHub: https://github.com/elisio-tech/ ##Agradeço a oportunidade de participar deste desafio.


