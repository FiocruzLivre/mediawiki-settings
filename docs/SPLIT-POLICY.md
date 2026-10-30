# Repository and release boundaries

- This repository owns **one wiki**, never the identity or dependencies of another.
- Generic MediaWiki build tooling is versioned independently.
- Only stable tested artifacts are deployed; no `composer update` or ad hoc
  `git pull` against running production containers.
- Every dependency change gets site-specific Composer, REST, VisualEditor,
  Page Forms, skin, upload, security, backup and rollback review as applicable.
- Extension code stays in its own repository. Site-owned templates and forms
  are content sources tracked here and installed through official MediaWiki APIs.
- Each release pins source Git SHAs and dependency graph and records its
  corresponding backup and deployment procedure.
- Repo renames and branch deletions happen only after GitHub PR refs,
  deployment remotes and homologation consumers have been reconciled.
- No credentials, tokens, database dumps or uploaded private files in Git.
