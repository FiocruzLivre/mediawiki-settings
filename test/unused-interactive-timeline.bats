#!/usr/bin/env bats

setup() {
  root="$BATS_TEST_DIRNAME/.."
  manifest="$root/mediawiki/composer.local.json"
  settings="$root/mediawiki/LocalSettings.php"
}

@test "Health manifest has no unused InteractiveTimeline package or source" {
  run jq -e '
    (.require | has("thewatcher/interactive-timeline") | not) and
    ([.repositories[]? |
      select(.type == "package" and .package.name == "thewatcher/interactive-timeline")
    ] | length == 0)
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Health wiki settings no longer register InteractiveTimeline" {
  run grep -E 'wfLoadExtension.*InteractiveTimeline' "$settings"
  [ "$status" -ne 0 ]
}
