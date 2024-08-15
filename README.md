# Mapa Colaborativo dos Movimentos Sociais em Saúde

## Instalação

1. Clone o projeto [mediawiki-development](https://github.com/LibreCodeCoop/mediawiki-development): `git clone https://github.com/LibreCodeCoop/mediawiki-development`
2. Acesse a pasta do projeto: `cd wediawiki-development`
3. Crie uma pasta chamada _volumes_: `mkdir volumes`
4. Clone o projeto _mapa-colaborativo_ dentro da pasta _volumes_ em uma pasta chamada _src_: `git clone https://github.com/LibreCodeCoop/mapa-colaborativo.git volumes/src`
5. Crie o subdiretório _/mysql/dump_ dentro da pasta _volumes_: `mkdir -p volumes/mysql/dump`
6. Coloque o dump do seu projeto na pasta `volumes/mysql/dump`
7. Caso necessário, crie o arquivo `.env` ou utilize um existente.
8. Clone o projeto do [MediaWiki](https://www.mediawiki.org/) no subdiretório _volumes/mediawiki_: `git clone  --progress --single-branch --depth 1 --branch 1.41.0 --recurse-submodules -j 4 https://gerrit.wikimedia.org/r/mediawiki/core.git volumes/mediawiki`
9. Inicie o projeto: `docker compose up -d`
10. Acesse o conteiner do projeto: `docker compose exec -u www-data mediawiki bash`
11. Execute a instalação das extensões: `composer update --no-dev -o`
12. Execute a atualização do banco: `php maintenance/update.php --quick`
13. Se tiver algum patch a aplicar, execute: `cd volumes/mediawiki;git apply ../src/patch-01.diff`

## Editar topo

https://www.mediawiki.org/wiki/Manual:Interface/Sitenotice


## Menu

https://www.mediawiki.org/wiki/Manual:Interface/Sidebar


## CSS
https://www.mediawiki.org/wiki/Manual:CSS
