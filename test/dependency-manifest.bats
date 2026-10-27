#!/usr/bin/env bats

setup() {
  manifest="$BATS_TEST_DIRNAME/../mediawiki/composer.local.json"
}

@test "Composer local manifest is valid JSON with requirements" {
  run jq -e '.require | type == "object" and length > 0' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Composer requirements do not use floating dev-master or wildcard versions" {
  run jq -e '
    [.require[] | select(. == "*" or startswith("dev-") or contains("@dev"))]
    | length == 0
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "EmbedVideo uses a release constraint without a shadow package repository" {
  run jq -e '
    (.require["starcitizenwiki/embedvideo"] | test("^[~^]?[0-9]+[.][0-9]+")) and
    ([.repositories[]? | select(.type == "package" and .package.name == "starcitizenwiki/embedvideo")] | length == 0)
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Composer plugins are explicitly allowed" {
  run jq -e '
    .config["allow-plugins"]["wikimedia/composer-merge-plugin"] == true and
    .config["allow-plugins"]["composer/installers"] == true
  ' "$manifest"
  [ "$status" -eq 0 ]
}
