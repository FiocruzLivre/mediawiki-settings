#!/usr/bin/env bats

setup() {
  root="$BATS_TEST_DIRNAME/.."
  manifest="$root/dependencies/composer.json"
  settings="$root/mediawiki/LocalSettings.php"
}

@test "Shared manifest does not require the unused InteractiveTimeline extension" {
  run jq -e '
    (.require | has("thewatcher/interactive-timeline") | not) and
    ([.repositories[]? |
      select(.type == "package" and .package.name == "thewatcher/interactive-timeline")
    ] | length == 0)
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Shared application settings do not load the unused extension" {
  run grep -E 'wfLoadExtension.*InteractiveTimeline|wfLoadExtension.*TimelineTable' "$settings"
  [ "$status" -ne 0 ]
}
