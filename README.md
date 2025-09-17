# Üzemanyag Nyilvántartó

Laravel alapú webalkalmazás üzemanyag-fogyasztás nyilvántartására és statisztikák készítésére.
Gyakorlási céllal és saját igényekre.

## Funkciók
- Adatok feltöltése, módosítása, törlése
- Statisztikák (átlagfogyasztás, havi/éves fogyasztás, költségek)

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
   ```

2. Telepítsd a PHP függőségeket:
   ```bash
   composer install
   ```

3. Másold az `.env.example` fájlt `.env`-re, és állítsd be az adatbázis kapcsolatot:
   ```bash
   cp .env.example .env
   ```

4. Generáld az alkalmazás kulcsát:
   ```bash
   php artisan key:generate
   ```

5. Futtasd az adatbázis migrációkat és seed-et:
   ```bash
   php artisan migrate
   ```

6. Telepítsd a JavaScript függőségeket:
   ```bash
   npm install
   ```

7. Indítsd el a frontend buildet:
   ```bash
   npm run dev
   ```

8. Indítsd a szervert:
   ```bash
   php artisan serve
   ```

## Használat
- Admin belépés (seed adat alapján):  
  **Email:** `admin@example.com`  
  **Jelszó:** `password`
