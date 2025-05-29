# UniFlow - Backend Multi-Funcional com Laravel, DDD e SOLID

O **UniFlow** é um projeto de backend que implementa uma API RESTful multi-funcional, desenvolvido com o framework Laravel 12. Ele segue os princípios de **Domain-Driven Design (DDD)**, **SOLID** e **Clean Code**, com o objetivo de criar uma arquitetura robusta, modular e escalável. O projeto abrange várias funcionalidades, incluindo uma lista de tarefas, um dashboard de e-commerce, um calendário para agendamento de reuniões e um mini e-commerce para testes de vendas.

## Sobre o Projeto

O **UniFlow** é um backend projetado para suportar múltiplas funcionalidades em um único sistema, mantendo a separação de responsabilidades e a escalabilidade. As funcionalidades planejadas ou implementadas incluem:

- **Todo App**: Uma API para gerenciar listas de tarefas (já implementada).
- **E-commerce Dashboard**: Um painel para gerenciar dados de e-commerce, como produtos, pedidos e vendas (em desenvolvimento).
- **Calendário de Reuniões**: Um sistema para agendar e gerenciar reuniões (em desenvolvimento).
- **Mini E-commerce**: Um sistema simplificado para testar funcionalidades de vendas, como carrinho e checkout (em desenvolvimento).

O foco do projeto é aplicar boas práticas de arquitetura de software, garantindo que cada funcionalidade seja independente e possa ser expandida sem impactar as demais.

### Tecnologias Utilizadas

- **Laravel 12**: Framework PHP para desenvolvimento da API.
- **PHP 8.2**: Versão do PHP usada para rodar o projeto.
- **Composer**: Gerenciador de dependências do PHP.
- **Ramsey/UUID**: Biblioteca para geração de UUIDs como identificadores.
- **Git**: Controle de versão.
- **MySQL/SQLite**: Banco de dados (pode ser configurado no `.env`).
- **Faker**: Usado na seeder para gerar dados fictícios.

## Arquitetura

O projeto segue uma arquitetura baseada em **Domain-Driven Design (DDD)**, com camadas bem definidas para separar responsabilidades. Além disso, aplicamos os princípios **SOLID** e **Clean Code** para garantir um código limpo, modular e manutenível.

### Estrutura de Camadas

A arquitetura é dividida em camadas para suportar múltiplas funcionalidades de forma independente:

- **Domain**: Contém a lógica de negócios pura, independente de frameworks ou infraestrutura.
  - `Entities/`: Entidades como `Todo`, `Product`, `Meeting`, `Order` (planejadas), que encapsulam a lógica de negócios.
  - `ValueObjects/`: Value Objects como `TodoId`, `TodoStatus`, `ProductPrice`, `MeetingDate` (planejados), para garantir imutabilidade e validação.
  - `Repositories/`: Interfaces para abstrair a persistência (ex.: `TodoRepositoryInterface`).
- **Application**: Orquestra as ações do sistema.
  - `Services/`: Use cases como `TodoService`, `ProductService`, `MeetingService`, `OrderService` (planejados).
  - `DTOs/`: Data Transfer Objects para transferir dados entre camadas (ex.: `TodoDTO`).
- **Infrastructure**: Lida com detalhes técnicos.
  - `Repositories/`: Implementações de repositórios usando Eloquent (ex.: `EloquentTodoRepository`).
  - `Models/`: Modelos Eloquent para persistência no banco (ex.: `Todo`).
- **Presentation**: Interface com o mundo externo.
  - `Http/Controllers/`: Controladores RESTful para cada funcionalidade (ex.: `TodoController`).
  - `Http/Requests/`: Validação de requisições (ex.: `TodoRequest`).
  - `routes/api.php`: Definição das rotas da API.

### Princípios Aplicados

#### Domain-Driven Design (DDD)
- O domínio é isolado e contém a lógica de negócios, como a transição de estados (ex.: `pending` para `completed` no Todo App).
- Repositórios abstraem a persistência, permitindo que o domínio seja independente do banco de dados.
- Value Objects garantem consistência e imutabilidade (ex.: `TodoId`, `TodoStatus`).
- Cada funcionalidade (Todo App, E-commerce Dashboard, etc.) terá seu próprio subdomínio dentro da camada `Domain`, mantendo a separação de contextos.

#### SOLID
- **S (Single Responsibility)**: Cada classe tem uma única responsabilidade (ex.: `Todo` representa a tarefa, `TodoService` orquestra operações).
- **O (Open/Closed)**: Entidades podem ser estendidas (ex.: novos métodos como `markAsOverdue()` no `Todo`) sem alterar o código existente.
- **L (Liskov Substitution)**: Interfaces como `TodoRepositoryInterface` permitem substituição de implementações sem quebrar o código.
- **I (Interface Segregation)**: Interfaces específicas evitam métodos desnecessários.
- **D (Dependency Inversion)**: Dependemos de abstrações (interfaces), não de implementações concretas (ex.: `TodoService` depende de `TodoRepositoryInterface`).

#### Clean Code
- Nomes claros e descritivos (ex.: `markAsCompleted`, `TodoDTO`).
- Funções pequenas e focadas.
- Separação clara de responsabilidades entre camadas.

## Funcionalidades

### 1. Todo App (Implementado)
Uma API para gerenciar listas de tarefas, com as seguintes operações:
- **GET /api/todos**: Lista todas as tarefas.
- **POST /api/todos**: Cria uma nova tarefa.
  - Body: `{"title": "Fazer café", "description": "Usar a cafeteira nova"}`
- **GET /api/todos/{id}**: Mostra uma tarefa específica.
- **PUT /api/todos/{id}**: Atualiza uma tarefa.
  - Body: `{"title": "Fazer chá", "description": "Usar chá verde"}`
- **PATCH /api/todos/{id}/complete**: Marca uma tarefa como concluída.
- **DELETE /api/todos/{id}**: Deleta uma tarefa.

### 2. E-commerce Dashboard (Em Desenvolvimento)
Um painel para gerenciar dados de e-commerce, com as seguintes funcionalidades planejadas:
- Gerenciamento de produtos (criar, listar, atualizar, deletar).
- Visualização de pedidos e estatísticas de vendas.
- Relatórios de desempenho (ex.: produtos mais vendidos).

### 3. Calendário de Reuniões (Em Desenvolvimento)
Um sistema para agendar e gerenciar reuniões, com as seguintes funcionalidades planejadas:
- Criação de eventos/reuniões com data, hora e participantes.
- Listagem de reuniões agendadas.
- Atualização e cancelamento de reuniões.

### 4. Mini E-commerce (Em Desenvolvimento)
Um sistema simplificado para testar funcionalidades de vendas, com as seguintes funcionalidades planejadas:
- Catálogo de produtos.
- Carrinho de compras.
- Checkout básico com simulação de pagamento.

## Como Rodar o Projeto

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- MySQL ou SQLite (configurado no `.env`)
- Git

### Passos para Instalação
1. **Clone o repositório:**
   ```bash
   git clone https://github.com/seu-usuario/uniflow.git
   cd uniflow
   ```

2. **Instale as dependências:**
   ```bash
   composer install
   ```

3. **Configure o ambiente:**
   - Copie o arquivo de exemplo:
     ```bash
     cp .env.example .env
     ```
   - Edite o arquivo `.env` e configure as variáveis do banco de dados para MySQL:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=uniflow_backend
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

---

## Como rodar as migrations

Certifique-se de que o banco de dados `uniflow_backend` já existe no seu MySQL.  
Depois, execute:

```bash
php artisan migrate
```

---

## Como executar o servidor local

Inicie o servidor de desenvolvimento do Laravel:

```bash
php artisan serve
```

Acesse [http://localhost:8000](http://localhost:8000) no navegador.

---

## Como testar a API

Você pode testar os endpoints usando ferramentas como **Postman**, **Insomnia** ou via **curl** no terminal.

### Exemplo usando curl:

- **Criar uma tarefa:**
  ```bash
  curl -X POST http://localhost:8000/api/todos \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title": "Minha tarefa", "description": "Descrição"}'
  ```

- **Listar tarefas:**
  ```bash
  curl -X GET http://localhost:8000/api/todos \
    -H "Accept: application/json"
  ```

- **Filtrar tarefas por status:**
  ```bash
  curl -X GET "http://localhost:8000/api/todos?status=completed" \
    -H "Accept: application/json"
  ```

- **Atualizar status de uma tarefa:**
  ```bash
  curl -X PATCH http://localhost:8000/api/todos/{id}/complete \
    -H "Accept: application/json"
  ```

- **Deletar uma tarefa:**
  ```bash
  curl -X DELETE http://localhost:8000/api/todos/{id} \
    -H "Accept: application/json"
  ```

---
