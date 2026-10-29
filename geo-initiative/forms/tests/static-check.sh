#!/bin/sh
set -eu
root=$(CDPATH= cd -- "$(dirname "$0")/.." && pwd)
for name in Module-Geolocalizacao_do_artigo Template-Geolocalizacao_do_artigo Form-Artigo_com_geolocalizacao Template-Geolocalizacao_do_artigo-doc; do
 test -s "$root/pages/$name.wiki"
done
grep -Fq '{{#coordinates:' "$root/pages/Module-Geolocalizacao_do_artigo.wiki"
grep -Fq '|primary}}' "$root/pages/Module-Geolocalizacao_do_artigo.wiki"
grep -Fq 'standard input|free text' "$root/pages/Form-Artigo_com_geolocalizacao.wiki"
grep -Fq 'maximum instances=1' "$root/pages/Form-Artigo_com_geolocalizacao.wiki"
for field in latitude longitude precisao tipo_local exibir_no_mapa; do
 grep -Fq "field|$field|" "$root/pages/Form-Artigo_com_geolocalizacao.wiki"
 grep -Fq "|$field=" "$root/pages/Template-Geolocalizacao_do_artigo.wiki"
done
echo "Static checks passed"
