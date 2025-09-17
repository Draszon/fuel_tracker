# Üzemanyag Nyilvántartó

Laravel alapú webalkalmazás üzemanyag fogyasztás nyilvántartására és statisztikák készítésére.
Gyakorlának és saját igányeknek. Folyamatosan bővítem.

## Funkciók
- Adatok feltöltése, módosítása, törlése
- Statisztikák (átlagfogyasztás, költségek)
- Felhasználóbarát admin felület
- Reszponzív dizájn

## Technológiák
- PHP 8.4, Laravel 12
- MariaDB
- CSS
- JS

## Telepítés

1. Klónozd a repót:
   ```bash
   git clone https://github.com/felhasznalo/uzemanyag-nyilvantarto.git
   cd uzemanyag-nyilvantarto
   
# Telepítsd a PHP függőségeket
composer install

# Másold az .env.example fájlt .env-re, és állítsd be az adatbázis kapcsolatot
cp .env.example .env

# Generáld az alkalmazás kulcsát
php artisan key:generate

# Futtasd az adatbázis migrációkat és seed-et
php artisan migrate --seed

# Telepítsd a JavaScript függőségeket
npm install

# Indítsd el a frontend buildet
npm run dev

# Indítsd a szervert
php artisan serve
