People Manager - Sistema de Gestão de Pessoas (CRUD)
===========================================================

Este projeto foi desenvolvido como solução para o desafio técnico de Desenvolvedor Full Stack (PHP/MySQL), seguindo todas as orientações fornecidas no enunciado do teste. O sistema implementa um CRUD completo de pessoas utilizando HTML, CSS, JavaScript (Fetch API), PHP e MySQL.

-----------------------------------------------------------
📌 Estrutura do Projeto
-----------------------------------------------------------
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
-----------------------------------------------------------
📌 Tecnologias Utilizadas
-----------------------------------------------------------

- **Frontend:** HTML5, CSS3 (com responsividade), JavaScript (Fetch API)
- **Backend:** PHP (API RESTful com métodos GET, POST, PUT e DELETE)
- **Banco de Dados:** MySQL
- **Padrão:** Arquitetura simples separando API, frontend e scripts SQL

-----------------------------------------------------------
📌 Funcionalidades Implementadas
-----------------------------------------------------------

✔ Criar usuário (POST)  
✔ Ler todos os usuários (GET)  
✔ Ler usuário por ID (GET)  
✔ Atualizar usuário (PUT)  
✔ Excluir usuário (DELETE)  
✔ Formulário dinâmico com JavaScript  
✔ Listagem atualizada sem recarregar a página  
✔ Design responsivo com media queries  
✔ Tratamento de erros e mensagens na interface  

As funcionalidades estão alinhadas aos requisitos descritos no PDF do teste.

-----------------------------------------------------------
📌 Como Rodar o Projeto
-----------------------------------------------------------

### 1️⃣ Clonar o repositório
```
git clone <url-do-repo>
cd people-manager
```

### 2️⃣ Configurar o Banco de Dados MySQL

1. Abra o MySQL (linha de comando ou ferramenta visual).
2. Execute o script localizado em `database/schema.sql`.

Exemplo:
```
SOURCE database/schema.sql;
```

Isso criará o banco `people_manager_db` e a tabela `pessoas`.

-----------------------------------------------------------
📌 3️⃣ Configurar o Backend (API PHP)

A API está localizada na pasta `/api`.

### **Arquivo importante:**  
`api/config/db.php` — contém as credenciais de conexão com o MySQL.

Certifique‑se de ajustar:
```
$host = "localhost";
$dbname = "people_manager_db";
$username = "SEU_USUARIO";
$password = "SUA_SENHA";
```

### Iniciando o servidor PHP:
```
php -S localhost:8000 -t public
```

Ou, para expor também a API:
```
php -S localhost:8000
```

A API responderá em:
```
http://localhost:8000/api/pessoas.php
```

-----------------------------------------------------------
📌 4️⃣ Endpoints da API
-----------------------------------------------------------

### ➤ Listar pessoas
`GET /api/pessoas.php`

Retorna JSON com todos os registros.

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

-----------------------------------------------------------
📌 5️⃣ Executando o Frontend
-----------------------------------------------------------

Abra no navegador o arquivo:

```
public/index.html
```

Ou acesse via servidor PHP:

```
http://localhost:8000/
```

-----------------------------------------------------------
📌 Responsividade
-----------------------------------------------------------

O layout inclui media queries para 4 faixas de largura:

- **até 480px:** mobile pequeno  
- **481–768px:** mobile grande/tablet  
- **769–1199px:** laptops médios  
- **≥1200px:** desktops grandes  

Isso garante adaptação da tabela, do formulário e dos botões em qualquer dispositivo.

-----------------------------------------------------------
📌 Observações Finais
-----------------------------------------------------------

Este projeto cumpre todos os requisitos do teste, incluindo:

- CRUD completo (Create, Read, Update, Delete)
- API RESTful simples
- Integração frontend ↔ backend via Fetch API
- Formulário validado
- Tabela dinâmica
- Design responsivo
- Script SQL para inicialização do banco
- Atualmente está sendo implementada uma esteira de CI/CD utilizando GitHub Actions.

👨‍💻 Desenvolvedor Júnior
João Vitor Carlos Brandão – 2025

