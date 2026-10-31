# WikiFavelas — configuração do MediaWiki

Configuração e dependências do [Dicionário de Favelas Marielle Franco](https://wikifavelas.com.br/).

## Estrutura

- `mediawiki/LocalSettings.php`: configuração da wiki e de suas extensões.
- `mediawiki/composer.local.json`: dependências Composer específicas da WikiFavelas.
- `patch-01.patch`: ajuste adicional que deve ser avaliado conforme a versão instalada.

A imagem e o Compose usados também em produção ficam em [mediawiki-development](https://github.com/FiocruzLivre/mediawiki-development). Para uma nova instalação, monte `mediawiki/` deste repositório em `/var/www/src/mediawiki` ou clone o repositório em `volumes/src` do ambiente compartilhado. Banco, proxy, segredos e serviços locais são configurados por `.env` e `docker-compose.override.yml` não versionados, sem modificar o Compose principal.

## Verificação

Antes de atualizar o servidor, confira a compatibilidade das extensões, obtenha um backup restaurável do banco e dos arquivos enviados e reproduza a atualização em homologação. A infraestrutura e os caminhos de implantação precisam ser confirmados com a pessoa responsável pelo servidor.

Para conferir os arquivos deste repositório:

```sh
php -l mediawiki/LocalSettings.php
php -r 'json_decode(file_get_contents("mediawiki/composer.local.json"), true, 512, JSON_THROW_ON_ERROR);'
```

Não execute `composer update` diretamente na produção sem um conjunto de dependências previamente testado.
