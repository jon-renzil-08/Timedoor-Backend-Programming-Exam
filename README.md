

## Langkah Instalasi

1️⃣ Clone repository
git clone https://github.com/jon-renzil-08/Timedoor-Backend-Programming-Exam.git
cd BookRatingSystem

2️⃣ Install dependencies
composer install
npm install && npm run dev


3️⃣ Buat file environment
cp .env.example .env

4️⃣ Atur koneksi database
DB_DATABASE=book_rating_db
DB_USERNAME=root
DB_PASSWORD=

5️⃣ Generate application key
php artisan key:generate

6️⃣ Migrasi dan seeding database
php artisan migrate --seed

7️⃣ Jalankan server
php artisan serve

Lalu buka di browser:
http://127.0.0.1:8000



The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
