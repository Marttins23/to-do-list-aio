# To-Do List AIO Group - Lista de Tarefas

## Descrição
Esta aplicação é uma API RESTful construída em Laravel para gerenciar uma lista de tarefas (to-do list) e uma interface de usuário em React para consumir essa API. A aplicação permite criar, listar, atualizar e deletar tarefas, seguindo os princípios RESTful. A aplicação conta com testes de unidade e de integração. Outros detalhes técnicos foram fornecidos no detalhamento do desafio.

## Tecnologias Utilizadas

- **Backend**: Laravel 10, PHP 8.3, MySQL
- **Frontend**: React 18 e Material-UI
- **Testes**: PHPUnit, Mockery

## Requisitos
- PHP >= 8.3
- Composer
- Node.js >= 18
- MySQL
- NPM

## Instalação

### Clonar o Repositório
```bash
git clone https://github.com/Marttins23/to-do-list-aio.git
cd todo-list-aio
```
## Backend - Laravel

### Navegar até a pasta 'backend':
```bash
cd backend
```

### Instalar as dependências do Laravel:
```bash
composer install
```

### Configurar o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

### Configurar o banco de dados no arquivo .env:
Após instalar e configurar o MySQL:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=port
DB_DATABASE=databse_name
DB_USERNAME=databse_user
DB_PASSWORD=database_pppassword
```
### Rodar as migrations:
```bash
php artisan migrate
```

### Iniciar o servidor:
```bash
php artisan serve
```
## Frontend - React

### Navegar até a pasta 'frontend':
```bash
cd frontend
```

### Instalar as dependências:
```bash
npm install
```

### Iniciar o servidor:
```bash
npm start
```

## Uso da aplicação

### Endpoints da API:

 - **GET /api/tasks - Listar todas as tarefas**
 - **POST /api/tasks - Criar uma nova tarefa** 
    Exemplo de corpo da requisição:
    ```bash
    {
        "title": "Título da Tarefa"
    }
    ```
    *Obs: Todas as tarefas serão criadas com status 'não completada' (completed = false).*
 - **PUT /api/tasks/{id} - Atualizar uma tarefa**
    Exemplo de corpo da requisição:
    ```bash
    {
        "title": "Novo Título da Tarefa",
        "completed": true
    }
    ```
 - **DELETE /api/tasks/{id} - Deletar uma tarefa**

 ### Interface de Usuário (React):

 - **Acesse a interface em http://localhost:3000/ para gerenciar as tarefas.**

 ## Estrutura do Banco de dados

 - **tasks**
   - **id:** Chave primária
   - **title:** Título da tarefa (string)
   - **completed:** Status da tarefa (boolean)
   - **created_at:** Data de criação
   - **updated_at:** Data de atualização

## Testes

### Para executar os testes unitários e de integração:
```bash
php artisan test
```
