#!/usr/bin/env bats

setup() {
  root="$BATS_TEST_DIRNAME/.."
  manifest="$root/dependencies/composer.json"
  patches="$root/dependencies/patches.json"
}

@test "Composer patches uses pinned plugin without disabling security auditing" {
  run jq -e '.require["cweagans/composer-patches"] == "2.0.0" and .config["allow-plugins"]["cweagans/composer-patches"] == true and ((.config.audit["block-insecure"] // true) == true) and ((.config.audit.ignore // []) | length == 0)' "$manifest"
  [ "$status" -eq 0 ]
}

@test "BootstrapComponents Parsoid compatibility patch is locked by SHA-256" {
  patch="$root/dependencies/patches/bootstrap-components-parsoid-output.patch"
  checksum="$(sha256sum "$patch" | cut -d ' ' -f 1)"
  run jq -e --arg sha "$checksum" '.patches["mediawiki/bootstrap-components"][0] | .sha256 == $sha and .url == "../src/dependencies/patches/bootstrap-components-parsoid-output.patch"' "$patches"
  [ "$status" -eq 0 ]
  run grep -F 'getOutputIfInitialized' "$patch"
  [ "$status" -eq 0 ]
}

@test "HitCounters PSR-4 patch is locked by SHA-256" {
  patch="$root/dependencies/patches/hitcounters-psr4.patch"
  checksum="$(sha256sum "$patch" | cut -d ' ' -f 1)"
  run jq -e --arg sha "$checksum" '.patches["mediawiki/hit-counters"][0] | .sha256 == $sha and .url == "../src/dependencies/patches/hitcounters-psr4.patch"' "$patches"
  [ "$status" -eq 0 ]
  run grep -F 'HitCounters' "$patch"
  [ "$status" -eq 0 ]
}

@test "Site-scoped prepare script explicitly authorizes plugin and patches file" {
  run grep -F 'allow-plugins.cweagans/composer-patches true' "$root/dependencies/prepare-composer.sh"
  [ "$status" -eq 0 ]
  run grep -F 'extra.composer-patches.patches-file ../src/dependencies/patches.json' "$root/dependencies/prepare-composer.sh"
  [ "$status" -eq 0 ]
}

@test "Parsoid REST HTML integration smoke test (requires running staging)" {
  [ -n "${MAPA_HOMOLOG_URL:-}" ] || skip "MAPA_HOMOLOG_URL not set"
  run curl --fail --silent --show-error --max-time 30 --get "$MAPA_HOMOLOG_URL/rest.php/v1/page/P%C3%A1gina_principal/html"
  [ "$status" -eq 0 ]
  [[ "$output" == *"<html"* ]]
  [[ "$output" == *"Mapa"* ]]
}
