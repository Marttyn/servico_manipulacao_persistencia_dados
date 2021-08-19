<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://image.flaticon.com/icons/png/512/1878/1878375.png" width="100"></a></p>

## Sobre o Projeto

Sistema feito com o framework Laravel, com o objetivo de tratar e importar dados de um arquivo de texto, com cabeçalho e separador váriável (espaços em branco), para o banco de dados PostgresSQL.

## Como instalar

- Clone o repositório
- Acesse a pasta raiz do projeto
- Copie o arquivo ```.env.example``` e altere o nome para ```.env```
- Execute o comando ```composer install``` para instalar todas as dependências
- Execute o comando ```./vendor/bin/sail up``` para inicializar o docker
  - Se desejar adicione o parâmetro ```-d``` para executar em plano de fundo
- Para acessar a linha de comando do docker execute o comando 
  - ```docker exec -it servico_manipulacao_persistencia_dados_laravel.test_1 bash```
- Execute o comando ```php artisan migrate``` para criar a tabela dos dados

## Como importar os dados

- Coloque o(s) arquivo(s) ```.txt``` com os dados na pasta ```storage/app```
- Execute o comando ```php artisan import:file```
- Ao finalizar os dados terão sido tratados e importados para a tabela ```data```
- Será criado um arquivo de logs ```storage/logs/laravel.log``` com informações e mensagens de erro caso algum dado não passe na validação

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
