# Testes de aceitação pendentes em ambiente de banco isolado

Para cada caso coletar revisões antes/depois, diffs completos, action=query&prop=coordinates, registros de geo_tags por gt_page_id depois de jobs.

| Caso | Ação | Critério |
| --- | --- | --- |
| 1 | Artigo novo sem coordenadas, com texto e categorias | zero pontos; texto preservado |
| 2 | Inserir -3.68274/-40.3512, municipio/atuacao/sim | uma posição primária exata |
| 3 | Reabrir e editar o texto | preservar referências, categorias, predefinições e coordenadas |
| 4 | Trocar coordenadas | apenas posição nova após jobs |
| 5 | Apagar coordenadas e marcar nao | zero pontos; nunca posição 0,0 |
| 6 | Coordenada incompleta, vírgula ou fora do intervalo | zero pontos; texto ainda salvável |
| 7 | Coordenadas válidas com nao | zero pontos |
| 8 | Editar via VisualEditor e fonte | sem perda ou duplicação |
| 9 | Artigo legado com múltiplas predefinições | comparar integralmente wikitext antes/depois |
| 10 | Injetar #coordinates manual e duplicar predefinição | não inferir aprovação editorial; registrar conflitos |
| 11 | LinksUpdate pendente | medir consistência eventual |
