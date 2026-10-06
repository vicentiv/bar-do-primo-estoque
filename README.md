# Bar do Primo - Controle de Estoque

Sistema Laravel 12 para entradas, saídas, alertas de estoque mínimo e fornecedores.

## XAMPP / MySQL

1. No phpMyAdmin, importe `database/bar_do_primo.sql`.
2. Copie `.env.example` para `.env` (o projeto já inclui `.env`) e ajuste: `DB_DATABASE=bar_do_primo`, `DB_USERNAME=root`, `DB_PASSWORD=`.
3. No terminal, dentro desta pasta, execute `php artisan serve`.
4. Acesse `http://127.0.0.1:8000`.

Login inicial: `admin@bardoprimo.com` / `password`.

As migrations estão incluídas como alternativa ao SQL: use `php artisan migrate --seed`. Não importe o SQL e execute as migrations sobre o mesmo banco sem antes escolher apenas uma das opções.
