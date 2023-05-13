# Seu Projeto

Descrição do projeto em uma ou duas frases.

## Requisitos

- PHP 8.1 ou superior

- Laravel 10.8 ou superior

- Composer

## Instalação

1. Clone o repositório

git clone https://github.com/seu_usuario/farmarcas_teste.git

2. Entre no diretório do projeto

cd farmarcas_teste

3. Instale as dependências do projeto

composer install

4. Copie o arquivo .env.example para .env

cp .env.example .env

5. Gere a chave do aplicativo

php artisan key:generate

6. Execute as migrações (certifique-se de configurar corretamente o banco de dados no arquivo .env)

php artisan migrate

7. Inicie o servidor de desenvolvimento

Agora você pode acessar o servidor local em http://localhost:8000.

## Documentação API
A documentação da API está disponível em http://localhost:8000/api/documentation.

## Testes
Execute os testes com:

php artisan test

## Tecnologias Usadas
Laravel

L5-Swagger

Laravel Sanctum
