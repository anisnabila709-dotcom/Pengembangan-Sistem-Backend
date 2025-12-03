# SISTEM CRUD PRODUK
Aplikasi web ini ditujukan untuk mengelola data produk, seperti nama, kategori, harga, stok, gambar, dan status. Berbasis php Native, aplikasi ini memiliki struktur file yang sederhana. Sistem ini berfungsi sebagai CRUD (Create, Read, Update, Delete) yang memungkinkan pengguna untuk menambahkan produk baru, mengedit data yang sudah ada, mengunggah gambar produk, hingga menghapus produk beserta file gambarnya dari server. Tujuan utama pengembangan aplikasi ini adalah untuk memberikan gambaran bagaimana backend sederhana bekerja dalam sebuah aplikasi web, misalnya dalam penanganan file upload ataupun dalam pemrosesan form. Selain itu, untuk mendukung proses-proses tersebut, aplikasi ini juga mempraktekkan pemanfaataan PDO sebagai metode koneksi database dalam proses pengembangannya.

# FITUR UTAMA SISTEM CRUD PRODUk 
1. Fitur tambah produk, yakni pengguna dapat menambahkan produk baru dengan mengisi form yang terdiri atas nama produk, kategori, harga, ,stok, status, serta upload gambar. Fungsi ini menggunakan validasi dasar untuk memastikan bahwa data yang dimasukkan sesuai dengan kebutuhan aplikasi.
<img width="243" height="77" alt="Screenshot 2025-12-03 170417" src="https://github.com/user-attachments/assets/f8e00b3d-33ba-4963-b3ed-679cfae595c0" />
<br><br>
<img width="424" height="618" alt="Screenshot 2025-12-03 185931" src="https://github.com/user-attachments/assets/501c3a56-99e3-4b3c-8549-ab070301e197" />

2. Upload gambar produk, di mana setiap produk dapat memiliki satu gambar dan file yang diunggah yang nantinya akan disimpan pada folder khusus (folder: uploads). Di sini, sistem akan otomatis memeriksa ekstensi file (JPG/PNG), ukuran file yang maksimal 2 MB dan menghasilkan nama file baru agar tidak terjadi bentrok atau duplikasi.
<img width="388" height="76" alt="Screenshot 2025-12-03 190919" src="https://github.com/user-attachments/assets/83b189aa-22e0-4cdf-a35d-32d2fa6da119" />

3. Edit Produk, yakni Pengguna dapat memperbarui data produk yang sudah terdaftar. Pada halaman edit, informasi produk ditampilkan kembali, termasuk priview data sebelumnya. Jika penggguna mengunggagah gambar baru, maka gambar lama akan dihapus otomatis untuk menjaga kerapian folder penyimpanan
<img width="250" height="503" alt="Screenshot 2025-12-03 191136" src="https://github.com/user-attachments/assets/9f47ec15-31ad-49f5-a3f7-7cc0a4807910" />
<br><br>
<img width="412" height="619" alt="Screenshot 2025-12-03 191210" src="https://github.com/user-attachments/assets/d4f04f09-d944-4142-afc3-509a0a79c871" />

4. Hapus Produk, fitur ini merupakan penghapusan data produk oleh pengguna secara permanen. Setelah pengguna menekan tombol delete, sistem menampilkan notifikasi konfirmasi sebelum proses dilanjutkan. Jika, pengguna menyetujui, data produk akan dihapus dari database dan file gambar terkait juga dihapus dari folder uploads agar tidak menyisakan file yang sudah tidak digunakan lagi.
<img width="250" height="503" alt="Screenshot 2025-12-03 191136" src="https://github.com/user-attachments/assets/dc58c2f7-a65d-4feb-9ce3-c42814dea1b0" />

<br><br>

<img width="937" height="304" alt="Screenshot 2025-12-03 191419" src="https://github.com/user-attachments/assets/b44d56a7-1831-4f37-b1fc-ae18810f894d" />

<br><br>
5. Daftar Produk
    Semua data diperoleh dari database menggunakan PDO dan ditampilkan secara urut berdasarkan ID terbaru. Produk yang ditampilkan ialah dalam bentuk tabel yang memuat informasi yang  meliputi:
      * ID produk
      * Nama
      * Kategori
      * Harga
      * Gambar Produk
      * Status
      * Tombol Edit dan Delete
<img width="1365" height="632" alt="Screenshot 2025-12-03 192704" src="https://github.com/user-attachments/assets/fa9c7ad9-562f-471a-8e79-33f3f6a268de" />
<br><br>

6. Validasi
   Setiap input seperti harga, stok, status, dan gambar diproses dengan validasi untuk menghindari kesalahan dan menjaga keamanan aplikasi dari input yang tidak sesuai. Jika terdapat ketidaksesuaian maka pengguna akan menerima notif untuk mengisi atau melengkapi bagian yang kosong atau tidak sesuai.
<img width="381" height="470" alt="Screenshot 2025-12-03 193647" src="https://github.com/user-attachments/assets/7f353765-fa96-4729-b0f3-78a45821dcec" />

7. Status Produk
   Setiap produk memiliki status active atau inactive, yang di mana pada tabel ditampilkan sebagai "Ada" untuk produk yang masih tersedia dan status "Tidak Ada" untuk produk yang sudah tidak tersedia atau tidak lagi dijual. Fitur ini membantu menandai ketersediiann produk secara lebih mudah.
<img width="207" height="608" alt="Screenshot 2025-12-03 194242" src="https://github.com/user-attachments/assets/6949f0f1-f78a-43ff-80d0-7f62f27cffb1" />
<br><br>

# SKENARIO UJI
*Tambah Produk
1. Klik 'Tambah Produk'
2. Isi form
3. upload gambar
4. Submit dan produk akan muncul di daftar

*Edit Produk
1. Klik tombol 'Edit'
2. Ubah data
3. Jika upload gambar baru maka gambar lama akan terhapus

*Hapus Produk
1. Klik 'Delete'
2. Pengguna akan mendapatkan notifikasi konfirmasi atas tindakan yang dipilih
3. Jika iya, produk terhapus dari database dan gambar juga akan hilang di folder

*Tampilkan Data
Data akan muncul otomatis di halaman utama aplikasi

# TEKNOLOGI YANG DIGUNAKAN
* PHP 8.x
* MySQL/MariaDB
* PDO
* HTML & CSS
* VSCode
* GitHub
* Localhost PHP Server (PHP -S)

# STRUKTUR FOLDER
Tugaspsb/
* class/
* css/
  * style.css
* uploads/
  * (file-file gambar)
* config.php
* create.php
* delete.php
* edit.php
* index.php
* update.php
* produk.sql

# PENJELASAN FILE
* config.php: menyimpan konfigurasi database, memuat koneksi PDO, mendefinisikan folder upload.
* index.php: menampilkan tabel daftar produk, menampilkan gambar produk, memiliki tombol Edit dan Delete
* create.php: form tambah produk baru dan upload gambar.
* edit.php: form untuk mengedit produk, menampilkan gambar lama, upload gambar baru.
* update.php: validasi input, menyimpan perubahan ke database, menghapus gambar lama jika diganti.
* delete.php: menghapus produk dan menghapus gambar dari folder uploads.
* produk.sql: struktur database produk.
* css/style.css: styling dasar tabel & halaman

# INSTALANSI & CARA MENJALANKAN
1. Import database
   Buat database baru dan struktur tabel. Kemudian, import file menjadi produk.sql
<img width="555" height="247" alt="Screenshot 2025-12-03 195424" src="https://github.com/user-attachments/assets/e8aa01c0-6444-489a-be86-10fbfa2a0bea" />

2. Mengatur koneksi database di config.php
<img width="322" height="76" alt="Screenshot 2025-12-03 200042" src="https://github.com/user-attachments/assets/8acad3fa-ac2c-451e-8558-53afd7c40a4d" />
<br><br>

untuk folder upload
<br><br>
<img width="359" height="47" alt="Screenshot 2025-12-03 200232" src="https://github.com/user-attachments/assets/871ceaad-1b58-4bae-8262-db899c54bebb" />

3. Jalankan server php lokal
<img width="861" height="165" alt="Screenshot 2025-12-03 200639" src="https://github.com/user-attachments/assets/5f76684b-8606-4253-8b68-a89b7dc44a0e" />

4. Akses aplikasi, buka di browser
http://localhost:8000/index.php



