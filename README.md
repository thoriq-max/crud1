# Aplikasi CRUD Mahasiswa

Aplikasi CRUD Mahasiswa adalah aplikasi web sederhana berbasis **PHP**, **MySQL**, dan **Bootstrap** yang memungkinkan pengguna untuk melakukan **Create**, **Read**, **Update**, dan **Delete** data mahasiswa. Aplikasi ini juga dilengkapi dengan fitur **login**, **pencarian**, **pagination**, dan **import data dari file Excel (.xlsx)** menggunakan PhpSpreadsheet.

## Installation

1. **Clone atau Download Repository**
   Ekstrak folder ke dalam direktori `htdocs` (jika menggunakan XAMPP) atau ke direktori server lokal kamu.

2. **Import Database**
   Gunakan file `crud_excel_db.sql` untuk membuat database dan tabel:
   - Buka `phpMyAdmin`
   - Buat database `crud_excel`
   - Import file SQL tersebut

3. **Install PhpSpreadsheet**
   Jalankan perintah berikut di terminal dari direktori project:

   ```bash
   composer require phpoffice/phpspreadsheet
