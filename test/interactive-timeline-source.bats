#!/usr/bin/env bats

setup() {
  root="$BATS_TEST_DIRNAME/.."
  manifest="$root/dependencies/composer.json"
  expected_commit="ef5e003a8bfcfe31f68fa92a55f43ff1699cdb28"
  expected_url="https://github.com/FiocruzLivre/mediawiki-extension-interactive-timeline.git"
}

@test "InteractiveTimeline package is pinned to preserved version 1.9.0" {
  run jq -e --arg sha "$expected_commit" --arg url "$expected_url" '
    .require["thewatcher/interactive-timeline"] == "^1.9" and
    ([.repositories[]? |
      select(.type == "package" and .package.name == "thewatcher/interactive-timeline")
    ] | length) == 1 and
    ([.repositories[]? |
      select(.type == "package" and .package.name == "thewatcher/interactive-timeline")
    ][0].package |
      .version == "1.9.0" and
      .source.url == $url and
      .source.reference == $sha)
  ' "$manifest"
  [ "$status" -eq 0 ]
}

@test "Original InteractiveTimeline release tag is available at the pinned commit" {
  run git ls-remote "$expected_url" refs/tags/v1.9.0
  [ "$status" -eq 0 ]
  [ "$output" = "$expected_commit"$'\t'refs/tags/v1.9.0 ]
}

@test "Composer can actually install the preserved InteractiveTimeline source" {
  command -v docker >/dev/null || skip "Docker is required for the isolated installation test"

  scratch="$BATS_TEST_TMPDIR/composer-timeline"
  mkdir -p "$scratch"

  jq -n --slurpfile root "$manifest" '
    {
      name: "fiocruz-livre/interactive-timeline-source-test",
      type: "project",
      require: {
        "composer/installers": "^2.3",
        "thewatcher/interactive-timeline": "^1.9"
      },
      repositories: [$root[0].repositories[] |
        select(.type == "package" and .package.name == "thewatcher/interactive-timeline")],
      config: {
        "allow-plugins": {"composer/installers": true},
        "audit": {"block-insecure": true}
      }
    }
  ' > "$scratch/composer.json"

  run docker run --rm --user "$(id -u):$(id -g)" \
    -e COMPOSER_HOME=/tmp/composer -e COMPOSER_NO_INTERACTION=1 \
    -v "$scratch:/app" -w /app --entrypoint composer composer:2.10.3 \
    update --prefer-source --no-dev --no-scripts --no-progress --no-interaction
  if [ "$status" -ne 0 ]; then printf '%s\n' "$output" >&3; fi
  [ "$status" -eq 0 ]

  run jq -e --arg sha "$expected_commit" '
    [.packages[] |
      select(.name == "thewatcher/interactive-timeline" and
        .version == "1.9.0" and
        .source.reference == $sha)
    ] | length == 1
  ' "$scratch/composer.lock"
  [ "$status" -eq 0 ]

  sourcefile="$(find "$scratch" -mindepth 2 -maxdepth 6 -name extension.json -print -quit)"
  [ -n "$sourcefile" ] && [ -f "$sourcefile" ]
  run jq -e '.name == "InteractiveTimeline" and .version == "1.9.0"' "$sourcefile"
  [ "$status" -eq 0 ]
}
