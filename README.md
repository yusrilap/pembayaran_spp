<p align="center">
    <h1>E-Pembayaran SPP</h1>
</p>

## Package Pendukung

-   Sweet Alert 2
    https://sweetalert2.github.io
-   Dompdf
    https://dompdf.github.io

## Cara Install Project E-Pembayaran SPP

$ git clone https://github.com/yusrilap/pembayaran-spp.git <br>
$ cd pembayaran-spp <br>
$ composer update <br>
$ php artisan migrate --seed <br>
$ php artisan serve <br>

Catatan :
lakukan terlebih dahulu pembuatan database dengan nama db_spp sebelum melakukan migrate.

## Akun Untuk Login

Level Admin

-   email : admin@spp.com
-   password : admin

Level Petugas

-   email : petugas@spp.com
-   password : petugas

Level Siswa

-   NISN : 123456789876
-   Nama : siswa
