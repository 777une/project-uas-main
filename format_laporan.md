# UAS Pengembangan Web – Debug REST API CI4

## Data Diri:
- Nama  : Gavrilla June Hariyanto
- Kelas : 4B1 / Informatika
- NIM   : 231080200086

## Tugas:
- Perbaiki minimal 5 bug dari aplikasi
- Catat bug dan solusinya dalam tabel laporan

### Laporan Bug
| No | File                          |Baris| Bug                                  | Solusi                                                      |
|----|-------------------------------|-----|--------------------------------------|-------------------------------------------------------------|
| 1  | app/Controllers/Auth.php      | 22  | Salah nama helper                    | Tambah `helper('jwt')`                                      |
| 2  | .env                          | 7   | `JWT_SECRET` kosong                  | Tambahkan `JWT_SECRET=abc123`                               |
| 3  | env                           | -   | Nama file masih salah                | Mengubah nama menjadi .env                                  |
| 4  | .env                          | 17  | # CI_ENVIRONMENT = production        | production diubah menjadi development dan menghapus tanda # |
|    |                               |     |                                      | dan mengisi nama database sesuai dengan yang sudah dibuat   |
| 5  | app/Filters/JWTAuthFilter.php | 14  | getHeader() mengembalikan objek      | Mengembalikan string langsung                               |
|    |                               |     | Header, bukan string.                |                                                             |
| 6  | app/Filters/JWTAuthFilter.php | 28  | Tidak Menyimpan Data User di Request | `$request->user = $decoded;` simpan user info               |
| 7  | app/Controllers/Auth.php      | 25  | Tidak ada validasi input             | Menambahkan validasi input (baris 26)                       |
| 8  | app/Controllers/Auth.php      | 35  | Password tidak di hash               | Password di hash                                            |
| 9  | app/Controllers/Auth.php      | 46  | Mengembalikan password di response   | `unset($userData['password']);`                             |
| 10 | app/Controllers/Auth.php      | 58  | tidak ada validasi input             | Menambahkan validasi sederhana (baris 59)                   |
| 11 | app/Controllers/Auth.php      | 66  | Plain text password comparison       | Periksa password hash (baris 67-68)                         |
| 12 | app/Controllers/Auth.php      | 88  | Salah implemetasi                    | Pembetulan code pada baris (89 dst)                         |
| 13 | app/Config/Database.php       | 32  | Username masih kosong                | Diisi dengan `root`                                         |
| 14 | app/Config/Routes.php         | 13  | Tidak ada filter                     | Menambahkan filter jwt                                      |
| 15 | app/Config/Routes.php         | 18  | Prefix inkonsisten                   | Perbaikan prefix konsisten: pakai `api/users`               |
| 16 | app/Config/Routes.php         | 35  | Nama filter salah                    | Perbaikan filter: auth → jwt                                |

## Uji dengan Postman:
- POST /login
- POST /register
- GET /users (token diperlukan)