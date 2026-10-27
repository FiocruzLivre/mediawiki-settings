# Site-specific Composer dependency patches

This directory is the canonical site-specific Composer manifest used via the
MediaWiki core's `composer.local.json` symlink. Keep it separate from the
generic Docker infrastructure.

Two pinned patches are required while the upstream releases remain unchanged:

- BootstrapComponents 6.1.1: prevent `Parser::getOutput()` access when the
  nested Parsoid parser has no initialized `ParserOutput`. This repairs
  VisualEditor/REST HTML conversion on pages using BootstrapComponents.
  Upstream: https://github.com/oetterer/BootstrapComponents/issues/51
- HitCounters 0.4: align its Composer PSR-4 prefix with the actual
  `HitCounters\\` namespace. The MediaWiki extension registration already
  supplies the correct namespace.

The patches are local and each is SHA-256-verified in `patches.json`. Composer
Patches v2 requires the **root** Composer configuration to point to that file;
the merged `composer.local.json` cannot alone configure plugin permissions.

## Preparing a new, isolated installation

With the matching MediaWiki source, extensions, site dependencies and uploads
assembled in a staging image/volume:

```sh
sh /var/www/src/dependencies/prepare-composer.sh /var/www/mediawiki
cd /var/www/mediawiki
composer update cweagans/composer-patches --minimal-changes --with-all-dependencies --no-dev --no-interaction
composer patches-relock --no-interaction
composer patches-repatch --no-interaction
composer dump-autoload --optimize --no-interaction
composer audit --locked --no-dev --no-interaction
```

Run dependency resolution and patching on a build/staging machine, not on the
low-memory production server. Preserve and verify the generated
`composer.lock`, `patches.lock.json` and complete tested application files
as one release artifact; never independently resolve newer package versions
while deploying it. No security advisories should be ignored.

Validate `GET /rest.php/v1/page/Página_principal/html` and the
`action=visualeditor&paction=parse` API for pages that use Bootstrap
components. Run `test/dependency-patches.bats` with
`MAPA_HOMOLOG_URL` set to the staging origin for the REST smoke test.
Revisit both patches after a tested upstream release is available.
