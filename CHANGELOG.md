# Changelog

## [v0.1]
### Added
- Dark theme (juoda + rožinis akcentas)
- Admin receptų CRUD (kurti / redaguoti / trinti)
- Video palaikymas receptams (upload + URL)
- Registracija su vardu ir pavarde (LT tekstai)
- Pakeistas recepto informacijos UI

### Changed
- Login/Register tekstai išversti į lietuvių kalbą
- Recepto puslapyje rodomas video (jei yra)

### Fixed
- Sutvarkyti auth/namespace/parse error’ai po failų kopijavimo
- Sutvarkytas `Auth::user()` null atvejis navigacijoje