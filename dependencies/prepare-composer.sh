#!/bin/sh
# Prepare the MediaWiki root Composer configuration for the site-specific,
# SHA-256-pinned patches. Run during staging/build, not during web requests.
set -eu
mw_root="${1:-/var/www/mediawiki}"
[ -d "$mw_root" ] && [ -f "$mw_root/composer.json" ] || { echo "MediaWiki root not found" >&2; exit 1; }
deps_dir="$(dirname "$mw_root")/src/dependencies"
[ -f "$deps_dir/composer.json" ] && [ -f "$deps_dir/patches.json" ] || { echo "Dependencies/patches missing" >&2; exit 1; }
[ "$(readlink -f "$mw_root/composer.local.json")" = "$(readlink -f "$deps_dir/composer.json")" ] || { echo "Unexpected composer.local.json; refusing to proceed" >&2; exit 1; }
cd "$mw_root"
# MediaWiki's root composer.json is the authority for plugin permissions.
# Limit approval to this specific maintained Composer plugin.
composer config --no-plugins allow-plugins.cweagans/composer-patches true
composer config --no-plugins extra.composer-patches.patches-file ../src/dependencies/patches.json
echo "Composer configured for pinned site dependency patches."
