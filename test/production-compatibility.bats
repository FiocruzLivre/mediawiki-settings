#!/usr/bin/env bats

setup() {
  project="$BATS_TEST_DIRNAME/.."
  manifest="$project/dependencies/composer.json"
  settings="$project/mediawiki/LocalSettings.php"
}

@test "Health wiki retains production identity and public caching" {
  run grep -F '$wgSitename = "Mapa Mov Saúde";' "$settings"
  [ "$status" -eq 0 ]
  run grep -F '$wgMainCacheType = CACHE_ACCEL;' "$settings"
  [ "$status" -eq 0 ]
  run grep -F '$wgUseCdn = true;' "$settings"
  [ "$status" -eq 0 ]
  run grep -F '$wgCdnMaxAge = 120;' "$settings"
  [ "$status" -eq 0 ]
}

@test "Maps preserve production OpenStreetMap endpoint without obsolete proxy" {
  run grep -F "\$wgKartographerMapServer = 'https://tile.openstreetmap.org';" "$settings"
  [ "$status" -eq 0 ]
  run grep -E 'tileserver[.]map[.]as|marker[.]mapamovsaude[.]net[.]br' "$settings"
  [ "$status" -ne 0 ]
}

@test "MatomoAnalytics 1.5 preserves site ID and disables test tracking" {
  run grep -F "wfLoadExtension( 'MatomoAnalytics' );" "$settings"
  [ "$status" -eq 0 ]
  run grep -F '$wgMatomoAnalyticsSiteID = 1;' "$settings"
  [ "$status" -eq 0 ]
  run grep -F 'WG_MATOMO_DISABLE_JS' "$settings"
  [ "$status" -eq 0 ]
  run grep -E "^wfLoadExtension\( 'Matomo' \);|^\$wgMatomoTrackUsernames" "$settings"
  [ "$status" -ne 0 ]
  run jq -e '.require["miraheze/matomo-analytics"] == "1.5.0" and (.require | has("mediawiki/matomo") | not)' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Chameleon 6 and Bootstrap 6 dependency families are coherent" {
  run jq -e '
    .require["mediawiki/chameleon-skin"] == "^6.0.1" and
    .require["mediawiki/bootstrap"] == "^6.0" and
    .require["mediawiki/bootstrap-components"] == "^6.1.1"
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Bundled core extensions are not overridden by outdated packages" {
  run jq -e '
    (.require | has("mediawiki/category-tree") | not) and
    (.require | has("mediawiki/cite") | not) and
    (.require | has("mediawiki/cite-this-page") | not) and
    (.require | has("mediawiki/code-editor") | not) and
    (.require | has("mediawiki/vector-skin") | not) and
    (.require | has("mediawiki/interwiki") | not)
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Extension sources are not pinned to the old MediaWiki 1.41 branch" {
  run jq -e '
    [.repositories[]? |
      select(.type == "package") |
      .package.source.reference // "" |
      select(test("REL1_41|1[.]41[.]0-wmf"; "i"))] |
    length == 0
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Bootswatch custom theme styles match Bootstrap 5" {
  run grep -F 'Journal 5.3.8' "$project/mediawiki/themes/journal/_variables.scss"
  [ "$status" -eq 0 ]
  run grep -F 'Pulse 5.3.8' "$project/mediawiki/themes/pulse/_variables.scss"
  [ "$status" -eq 0 ]
}
