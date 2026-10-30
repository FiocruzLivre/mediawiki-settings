# Dicionário de Favelas Marielle Franco — configuração MediaWiki

This repository is the WikiFavelas **site-specific** configuration, dependency
constraints and visual assets. It is not the generic MediaWiki base.

## Historical origin
Main is a direct rename of `FiocruzLivre/mediawiki-settings:wikifavelas`
at commit `54c33e978d73c6886b1ab792bd2ca637d34d3bf3`.
The old repository is to be renamed only after the Mapa has a published
independent home and the current open PRs have been preserved or transferred.

## Operations
The WikiFavelas production environment is **not accessible** to this work.
Do not assume Docker, an SSH endpoint, exact file mounts, or permissions to
upgrade the public site. On 2026-10-30 its public MediaWiki API reported
MediaWiki 1.43.0, PHP 8.3.36 and MariaDB 11.8.6. This is not a full infra audit.

Collaborate with Lívia and the responsible infrastructure operator for
environment inventory, backups, isolated tests and deployment acceptance.

Site-specific `LocalSettings.php`, Composer requirements and themes belong
here; generic Docker/CI tooling stays in `mediawiki-development`.
The prospective `port/embedvideo-maintained` branch records original draft
PR #27 but is **not approved for production** without Composer and UI tests.
