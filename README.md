<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Homecare Scheduler Back‑end

Este projeto é o back‑end do sistema Homecare Scheduler, responsável por gerenciar os atendimentos emergenciais de Home Care. A aplicação foi construída com [Laravel](https://laravel.com) e implementa uma API REST. Além disso, integra RabbitMQ para o envio assíncrono de notificações via WhatsApp.

## Funcionalidades

-   **Registro de Atendimento**: Criação de novos atendimentos com geração automática de número de protocolo.
-   **Atualização**: Endpoints para atualizar atendimentos.
-   **Listagem e Consulta**: Endpoints para listar atendimentos e buscar dados estatísticos (métricas) como total, atendimentos de hoje, concluídos e pendentes.
-   **Notificações Assíncronas**: Integração com RabbitMQ para envio de notificações via WhatsApp sem impactar a performance do registro.
-   **Testes Automatizados**: Testes de integração e unitários com PHPUnit para garantir a qualidade do código.

## Tecnologias Utilizadas

-   **PHP 8.x / Laravel 9.x (ou superior)**
-   **PostgreSQL**
-   **RabbitMQ** para mensageria
-   **Docker** (opcional, para containerização)
-   **PHPUnit** para testes

## Pré-requisitos

Certifique-se de que você possui os seguintes softwares instalados em sua máquina:

-   [Docker](https://www.docker.com/)
-   [Docker Compose](https://docs.docker.com/compose/)

## Instalação

1.  **Clone o repositório:**

    ```bash
    git clone https://github.com/jv-farias/homecare-scheduler-backend.git
    ```

    ```bash
    cd homecare-scheduler-backend
    ```

2.  **Configurar variáveis de ambiente**

    ```bash
    cp .env.example .env
    ```

3.  **Inicie os contêineres com Docker**

    No diretório raiz do projeto, execute:

    ```bash
    docker compose up -d
    ```

    Este comando iniciará:

    -   Container do Laravel.
    -   Container do PostgreSQL.
    -   Container do Nginx.
    -   Container do Redis
    -   Container do RabbitMQ

4.  **Acesse o terminal do contêiner Laravel**

    Para executar comandos dentro do contêiner Laravel:

    ```bash
    docker compose exec -it app bash
    ```

5.  **Instale as dependências do Composer**

    Dentro do contêiner Laravel, instale as dependências do projeto e rode as migrations.

    ```bash
    composer install
    ```

    ```bash
    php artisan migrate
    ```

6.  **Acesse a aplicação**
    Abra o navegador e acesse:
    ```bash
    http://localhost:8000/api/attendances
    ```
