# People Manager – Sistema de Gestão de Pessoas (CRUD)

Um projeto desenvolvido como solução para o desafio técnico de Desenvolvedor Full Stack (PHP/MySQL).  
O objetivo foi implementar um CRUD completo de pessoas utilizando HTML, CSS, JavaScript (Fetch API), PHP e MySQL — tudo seguindo fielmente as orientações do enunciado.

---

## 📁 Estrutura do Projeto

```
api/
 ├── config/
 │    └── db.php
 ├── cors.php
 └── pessoas.php
database/
 └── schema.sql
public/
 ├── favicon.ico
 ├── index.html
 ├── script.js
 └── style.css

info.php  
README.md
```

---

## 🛠 Tecnologias Utilizadas

- **Frontend:** HTML5, CSS3 (com responsividade), JavaScript (Fetch API)  
- **Backend:** PHP (API RESTful utilizando GET, POST, PUT e DELETE)  
- **Banco de Dados:** MySQL  
- **Organização:** Estrutura simples separando API, frontend e scripts SQL  

---

## 🚀 Funcionalidades Implementadas

✔ Criar usuário (POST)  
✔ Listar todos os usuários (GET)  
✔ Buscar usuário por ID (GET)  
✔ Atualizar usuário (PUT)  
✔ Excluir usuário (DELETE)  
✔ Formulário dinâmico com JavaScript  
✔ Listagem atualizada sem recarregar a página  
✔ Design responsivo com media queries  
✔ Tratamento de erros e mensagens na interface  

---

## ⚙️ Como Rodar o Projeto

### 1️⃣ Clonar o repositório
```
git clone https://github.com/jvcbrandao/people-manager.git
cd people-manager
```

### 2️⃣ Configurar o Banco de Dados MySQL

1. Abra o MySQL (CLI ou ferramenta gráfica).  
2. Execute o script em `database/schema.sql`.  
3. Você pode usar MySQL Workbench se preferir.  

```
source database/schema.sql;
```

Isso criará o banco `people_manager_db` e a tabela `pessoas`.

---

## 3️⃣ Configurar o Backend (API PHP)

Arquivo principal de configuração:

```
api/config/db.php
```

Ajuste as credenciais:

```
$host = "localhost";
$dbname = "people_manager_db";
$username = "SEU_USUARIO";
$password = "SUA_SENHA";
```

### Iniciar o servidor PHP:
```
php -S localhost:8000
```

A API responderá em:

```
http://localhost:8000/api/pessoas.php
```

---

## 5️⃣ Executando o Frontend

Abra:

```
public/index.html
```

---

## 📡 Endpoints da API

### ➤ Listar pessoas  
`GET /api/pessoas.php`

### ➤ Buscar por ID  
`GET /api/pessoas.php?id=1`

### ➤ Criar pessoa  
`POST /api/pessoas.php`

Body JSON:
```
{
  "nome": "João",
  "cpf": "12345678900",
  "idade": 25
}
```

### ➤ Atualizar pessoa  
`PUT /api/pessoas.php?id=1`

### ➤ Excluir pessoa  
`DELETE /api/pessoas.php?id=1`

---

## 📱 Responsividade

O layout contempla as seguintes faixas:

- até **480px** – mobile pequeno  
- **481–768px** – mobile grande/tablet  
- **769–1199px** – laptops médios  
- **≥1200px** – desktops grandes  

---

## 📝 Observações Finais

Este projeto atende todos os requisitos do desafio técnico:

- CRUD completo  
- API REST simples  
- Integração backend ↔ frontend  
- Formulário validado  
- Tabela dinâmica  
- Design responsivo  
- Script SQL incluído para inicialização  

Foi um projeto muito agradável de desenvolver — espero que a experiência ao utilizar seja igualmente positiva!  

👨‍💻 **Desenvolvedor:**  
**João Vitor Carlos Brandão – 2025**
