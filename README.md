# MediaWiki Settings

Este repositório se destina a manter as configurações e extensões dos projetos Mapa dos [Movimentos Sociais em Saúde](https://mapamovsaude.net.br) e [Wikifavelas](https://wikifavelas.com.br/).

## Instalação

1. Clone o projeto [mediawiki-development](https://github.com/FiocruzLivre/mediawiki-development.git): `git clone https://github.com/FiocruzLivre/mediawiki-development.git`
2. Acesse a pasta do projeto: `cd mediawiki-development`
3. Crie uma pasta chamada _volumes_: `mkdir volumes`
4. Clone o projeto _mediawiki-settings_ dentro da pasta _volumes_ em uma pasta chamada _src_: `git clone https://github.com/FiocruzLivre/mediawiki-settings.git volumes/src` e faça o `checkout` para a branch relativa ao seu projeto.
5. Crie o subdiretório _/mysql/dump_ dentro da pasta _volumes_: `mkdir -p volumes/mysql/dump`
6. Faça um backup do banco do seu projeto e coloque na pasta `volumes/mysql/dump`
7. É necessário que exista um arquivo `.env` na raíz do projeto mediawiki-development com as variáveis utilizadas no _LocalSettings.php_.
8. Clone o projeto do [MediaWiki](https://www.mediawiki.org/) no subdiretório _volumes/mediawiki_: `git clone  --progress --single-branch --depth 1 --branch 1.43.0 --recurse-submodules -j 4 https://gerrit.wikimedia.org/r/mediawiki/core.git volumes/mediawiki` (Obs.: Lembre-se de substituir a branch pela versão desejada).
9. Inicie o projeto: `docker compose up -d`
10. Acesse o conteiner do projeto: `docker compose exec mediawiki bash`
11. Execute a instalação das extensões: `composer update --no-dev -o`
12. Execute a atualização do banco: `php maintenance/run.php update`
13. Se tiver algum patch a aplicar, execute: `cd volumes/mediawiki;git apply ../src/patch-01.diff`
14. Copie a pasta `images` do seu projeto para `volumes/mediawiki/`.

## Editar topo

https://www.mediawiki.org/wiki/Manual:Interface/Sitenotice


## Menu

https://www.mediawiki.org/wiki/Manual:Interface/Sidebar


## CSS
https://www.mediawiki.org/wiki/Manual:CSS
