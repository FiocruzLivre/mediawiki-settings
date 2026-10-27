#!/usr/bin/env bats

setup() {
  root="$BATS_TEST_DIRNAME/.."
  manifest="$root/dependencies/composer.json"
}

@test "The settings manifest can be loaded without replacing the MediaWiki core manifest" {
  stage="$BATS_TEST_TMPDIR/deployment"
  mkdir -p "$stage/core" "$stage/src/mediawiki" "$stage/src/dependencies"
  cp "$manifest" "$stage/src/dependencies/composer.json"
  cp -P "$root/mediawiki/composer.local.json" "$stage/src/mediawiki/composer.local.json"
  printf '%s\n' '{"name":"mediawiki/core"}' > "$stage/core/composer.json"
  ln -s ../src/mediawiki/composer.local.json "$stage/core/composer.local.json"

  run cmp "$stage/core/composer.local.json" "$stage/src/dependencies/composer.json"
  [ "$status" -eq 0 ]

  run jq -er '.name' "$stage/core/composer.json"
  [ "$status" -eq 0 ]
  [ "$output" = "mediawiki/core" ]
}

@test "Synthetic Composer package definitions do not duplicate package names" {
  run jq -e '
    ([.repositories[]? | select(.type == "package") | .package.name] | length) as $total
    | ([.repositories[]? | select(.type == "package") | .package.name] | unique | length) == $total
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Do not disable Composer security advisory blocking" {
  run jq -e '
    (.config.audit // {}) as $audit |
    ($audit["block-insecure"] // true) == true and
    (($audit.ignore // []) | length) == 0
  ' "$manifest"
  [ "$status" -eq 0 ]
}
