<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Laravel

Aplicação em Laravel v5.7 para iniciar um projeto com o laravel.

## Requisitos

-   [Git](https://git-scm.com/)
-   [Composer](http://getcomposer.org/doc/00-intro.md)
-   [Node](https://nodejs.org/en/)
-   [MySQL](https://www.mysql.com/)

## Instalação

1. Efetuar a instalação clonando ou baixando do repositorio.

    ```bash
    git clone https://github.com/CodeSiteBr/laravel-acl.git
    ```
    ```bash
    git clone git@github.com:CodeSiteBr/laravel-acl.git
    ```

    Download [laravel-acl](https://github.com/CodeSiteBr/laravel-acl/archive/master.zip)

2. Entrar na pasta do projeto, execute:
    ```bash
    cd laravel-acl
    ```
3. Se composer está instalado, execute:
    ```bash
    composer install
    ```
4. Se node está instalado, execute:
    ```bash
    npm install
    ```
5. Criar o arquivo .env, execute:
    ```bash
    cp .env.example .env
    ```
6. Gerar uma nova chave para o arquivo .env, execute:
    ```bash
    php artisan key:generate
    ```
7. Criar o banco de dados com phpmyadmin ou workbench e configurar o arquivo .env nas linhas com os (`seus dados de conexão ao banco de dados`).

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    ```

8. Criar as tabelas com o migrate

    Criar e popular as tabelas

    ```bash
    php artisan migrate --seed
    ```

    Se precisar fazer alguma alteração nas migrates

    ```bash
    php artisan migrate:refresh --seed
    ```

9. Configurar o envio de e-mail no arquivo .env

    Se for em desenvolvimento crie uma conta no [mailtrap](https://mailtrap.io/) e configure as linhas.

    ```bash
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    ```

    Ou configuração completa de seu servidor de e-mail

    ```bash
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    ```

10. Para exibir a imagem do usuario é necessário criar um link simbolico da pasta storage/app/public para /public

    ```bash
    php artisan storage:link
    ```

11. Se alterar os arquivos js ou sass da pasta resources/assets, é necessário, executar:

    ```bash
    npm run dev
    ```

    Ou

    ```bash
    npm run watch
    ```

12. Para iniciar o servidor do laravel

    ```bash
    php artisan serve
    ```

    Ou em uma porta específica

    ```bash
    php artisan serve --port=300
    ```

13. Agora você deve ser capaz de visitar o caminho para onde você instalou o aplicativo e ver a página inicial padrão.

    [localhost](http://localhost)  
    [localhost:8000](http://localhost:8000)  
    [localhost:300](http://localhost:300/)

    > usuario: admin@admin.com  
    > senha: 123456

    > usuario: user@user.com  
    > senha: 123456

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
