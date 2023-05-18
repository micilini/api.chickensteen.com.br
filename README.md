# API da Chicken Steen (Laravel | PHP)

API que contém toda a lógica do sistema que é usado pelo [Front-End da Chicken Steen](https://github.com/micilini/Chicken-Steen), quanto também pelo [Painel da Chicken Steen](https://github.com/micilini/painel.chickensteen.com.br).

## Requisitos

Para executar este projeto, certifique-se de que você já tem alguma familiaridade com a linguagem PHP e com o Framework Laravel.

Se você for testar este projeto em sua própria máquina local, recomendamos a utilização do [XAMPP](https://www.apachefriends.org/pt_br/index.html) para ter acesso ao banco de dados PhpMyAdmin.

Em caso de dúvidas sobre como o Laravel funciona, não deixe de consultar um de nossos materiais no [Portal da Micilini](https://micilini.com/conteudos/php/laravel-parte-1).

## Como utilizar este sistema?

Faça Download deste repositório para a sua máquina local, ou use o comando ```git clone```:

```
git clone https://github.com/micilini/api.chickensteen.com.br.git
```

> Em que local esses arquivos devem ser armazenados (clonados)?

Se você estiver começando agora, recomendamos que os arquivos deste projeto estejam salvos na sua ```área de trabalho```, mesmo local aonde devem estar presentes os outros dois projetos [Front-End da Chicken Steen](https://github.com/micilini/Chicken-Steen) e [Painel da Chicken Steen](https://github.com/micilini/painel.chickensteen.com.br).

![Tela 04](http://chickensteen.com.br/assets/images/telas/tela-04.png)

## Configurações Inicias (Raiz do Projeto)

Com a raíz do projeto aberta no ```CMD``` (```Prompt de Comando``` ou ```Terminal```), execute o comando:

```
composer dump-autoload
composer update
php artisan key:generate
```

Em seguida renomeie o arquivo ```.env.example``` para ```.env```.

## Configurações Iniciais (Banco de Dados)

Antes de rodar o projeto, você vai precisar configurar a conexão com o seu banco de dados local, para isso certifique-se de que as configurações relacionadas ao banco de dados existentes no arquivo ```.env``` estão corretas:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api.chickensteen.com
DB_USERNAME=root
DB_PASSWORD=
```

> Se você estiver usando o [XAMPP](https://www.apachefriends.org/pt_br/index.html), a configuração padrão deste projeto conseguirá se conectar com o seu banco de dados normalmente. Basta apenas que você execute o ```apache``` e também o ```mysql```.

## Configurações Iniciais (Migrations)

Para executar a Migrations, certifique-se de que o Laravel está instalado na sua máquina local, em seguida com o ```CMD``` (```Prompt de Comando``` ou ```Terminal```) aberto na raízo projeto atual (```api.chickensteen.com.br```), execute:

```
php artisan migrate
php artisan migrate:fresh --seed
```

## Executando o Projeto

Para executar o projeto certifique-se de que o  o ```CMD``` (```Prompt de Comando``` ou ```Terminal```) esteja aberto na pasta do projeto atual (```api.chickensteen.com.br```), e execute:

```
php artisan serve
```

Automaticamente a API da Chicken Steen estará sendo executada na URL  ```http://127.0.0.1:8000```

# Licensa

Licensed under the [MIT](https://github.com/git/git-scm.com/blob/main/MIT-LICENSE.txt).*
