# Back-end Challenge 🏅- Space Flight News

Introdução

    This is a challenge by Coodesh

Foi desenvolvida uma Rest API que utiliza os dados do projeto Space Flight News, uma API pública com informações relacionadas a voos espaciais. O projeto desenvolvido tem como objetivo criar a API permitindo assim a conexão de outras aplicações.

Tecnologias utilizadas:
Linguagem PHP - framework Laravel
Banco de Dados Postgres no Render Dashboard (https://dashboard.render.com/)
Docker
Postman

Observação: O Heroku não possui mais planos gratuitos, e por essa razão foi escolhido o Render Dashboard, que possui planos gratuitos para configuração do banco de dados postgres, e também por essa razão o postgres foi escolhido, e não o MySql.

Orientações de Instalação:

A configuração do ambiente para desenvolvimento em PHP pode ser efetuada de acordo com as orientações contidas na página https://github.com/ArianeValasques/docker.

Depois de instaladas as ferramentas, basta clonar o repositório com o comando:

```bash
git clone https://github.com/ArianeValasques/api_project.git
```

Geralmente os projetos não contém o arquivo .env, porém a configuração de um banco de dados externo faz parte das exigências para a construção da API, então o arquivo foi adicionado temporariamente para demonstração.

Para a instalação e configuração do projeto devem ser executados os seguintes comandos:
Instalação do projeto:

```bash
  composer install
```

Geração da chave e criação de tabelas e alimentação do Banco de Dados com os dados de todos os artigos na Space Flight News API foram adicionados aos scripts pós-instalação. Porém, seguem os comandos para, caso necessário, serem utilizados.

Geração da chave

```bash
  app key-generate
```

Criação das tabelas no banco de Dados

```bash
  php artisan migrate
```

Para alimentar o

```bash
  php artisan load:database
```

Processo de Desenvolvimento:

Obrigatório 1 - Desenvolver as seguintes rotas:

[GET]/: Retornar um Status: 200 e uma Mensagem "Back-end Challenge 2021 🏅 - Space Flight News".

[GET]/articles/: Listar todos os artigos da base de dados, utilizar o sistema de paginação para não sobrecarregar a REQUEST.

[GET]/articles/{id}: Obter a informação somente de um artigo.

[POST]/articles/: Adicionar um novo artigo.

[PUT]/articles/{id}: Atualizar um artigo baseado no id.

[DELETE]/articles/{id}: Remover um artigo baseado no id.

CONCLUÍDO - Criadas as rotas no arquivo routes/api.php, todas foram testadas no postman, respondendo como esperado.

Obrigatório 2 - Para alimentar o seu banco de dados você deve criar um script para armazenar os dados de todos os artigos na Space Flight News API.

CONCLUÍDO - Foi criado um comando artisan (App/Console/Commands) e adicionado o script

Obrigatório 3 - Além disso você precisa desenvolver um CRON para ser executado diariamente às 9h e armazenar em seu os novos artigos ao seu banco de dados. (Para essa tarefa você poderá alterar o seu modelo de dados)

CONCLUÍDO - Foi criado um comando artisan (App/Console/Commands) para atualização diária do banco de dados, sendo que a tarefa foi inserida no schedule para execução diária às 9h.
Vale lembrar que a configuração deve ser feita também no servidor, através da alteração no arquivo contab (/etc/crontab), com a configuração da CRON, adicionando na última linha do arquivo

0 9 \* \* \* cd local/nomeProjeto && php artisan schedule:run >> /etc/cron/daily
Ressalte-se que o serviço deve estar ativo (comando 'service cron start' para incializar)

Dos requisitos diferenciais foi feito o Diferencial 1 - Configurar Docker no Projeto para facilitar o Deploy da equipe de DevOps;
O passo a passo da configuração segue no tópico 'Orientações de Instalação'
