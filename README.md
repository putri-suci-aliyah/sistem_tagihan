# 🏘️ Sistem Tagihan Warga

### Web-Based Community Billing Management System

> **Sistem Tagihan Warga** adalah aplikasi berbasis web yang dirancang untuk membantu pengelolaan data penduduk, tagihan warga, transaksi pembayaran, serta penyampaian informasi tagihan melalui **WhatsApp** secara lebih terstruktur dan efisien.

---

## 📌 Tentang Proyek

**Sistem Tagihan Warga** merupakan aplikasi manajemen tagihan berbasis web yang dapat digunakan untuk mengelola proses administrasi tagihan warga dalam satu sistem terintegrasi.

Aplikasi ini menyediakan fitur untuk mengelola **data penduduk, data tagihan, user, transaksi pembayaran, status pelunasan, serta notifikasi tagihan melalui WhatsApp**.

Sistem ini dikembangkan untuk membantu mengurangi proses administrasi manual dan mempermudah pengelolaan serta monitoring transaksi tagihan warga.

---

## 🎯 Tujuan

Aplikasi ini dikembangkan untuk:

* 👥 Mengelola data penduduk secara terstruktur.
* 🧾 Mengelola data jenis dan informasi tagihan.
* 💰 Mencatat transaksi tagihan warga.
* ✅ Memantau status pelunasan tagihan.
* 📱 Mengirimkan informasi tagihan melalui WhatsApp.
* 📊 Mempermudah monitoring data transaksi.
* 📥 Mengekspor data transaksi ke Excel.
* 🔐 Mengelola pengguna yang memiliki akses ke sistem.

---

## ✨ Fitur Utama

| Fitur                       | Deskripsi                                                 |
| --------------------------- | --------------------------------------------------------- |
| 🔐 **Login**                | Autentikasi pengguna untuk mengakses sistem               |
| 👥 **Master Data Penduduk** | Mengelola data warga yang terdaftar                       |
| 🧾 **Master Data Tagihan**  | Mengelola data dan jenis tagihan                          |
| 👤 **Master Data User**     | Mengelola pengguna sistem                                 |
| 💳 **Transaksi Tagihan**    | Mencatat dan mengelola transaksi tagihan                  |
| ➕ **Tambah Transaksi**      | Menambahkan transaksi tagihan baru                        |
| ✏️ **Edit Transaksi**       | Memperbarui informasi transaksi                           |
| 🗑️ **Hapus Transaksi**     | Menghapus transaksi dengan konfirmasi                     |
| 📱 **Notifikasi WhatsApp**  | Mengirimkan informasi tagihan kepada warga                |
| 💰 **Pelunasan Tagihan**    | Mengubah status tagihan menjadi lunas                     |
| 📥 **Export Excel**         | Mengunduh data transaksi dalam format Excel               |
| 🔔 **Konfirmasi Aksi**      | Memberikan konfirmasi sebelum melakukan tindakan tertentu |

---

## 🔄 Alur Sistem

```text
              ┌───────────────┐
              │     Login     │
              └───────┬───────┘
                      ↓
              ┌───────────────┐
              │   Dashboard   │
              └───────┬───────┘
                      ↓
        ┌─────────────┼─────────────┐
        ↓             ↓             ↓
   ┌─────────┐   ┌──────────┐   ┌─────────┐
   │Penduduk │   │ Tagihan  │   │  User   │
   └────┬────┘   └────┬─────┘   └─────────┘
        │             │
        └──────┬──────┘
               ↓
      ┌─────────────────┐
      │    Transaksi    │
      │     Tagihan     │
      └────────┬────────┘
               ↓
       ┌───────┴────────┐
       ↓                ↓
 ┌───────────┐    ┌─────────────┐
 │ WhatsApp  │    │  Pelunasan  │
 │ Notification│  │   Tagihan   │
 └───────────┘    └─────────────┘
                         ↓
                  ┌─────────────┐
                  │ Export Excel│
                  └─────────────┘
```

---

# 🛠️ Tech Stack

### Backend

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8+-777BB4?style=for-the-badge\&logo=php\&logoColor=white)

### Database

![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)

### Frontend & UI

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge\&logo=html5\&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge\&logo=css3\&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-Framework-7952B3?style=for-the-badge\&logo=bootstrap\&logoColor=white)
![AdminLTE](https://img.shields.io/badge/AdminLTE-Template-3C8DBC?style=for-the-badge)

### Integration

![Twilio](https://img.shields.io/badge/Twilio-WhatsApp-F22F46?style=for-the-badge\&logo=twilio\&logoColor=white)

### Development Tools

![Git](https://img.shields.io/badge/Git-Version%20Control-F05032?style=for-the-badge\&logo=git\&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-Repository-181717?style=for-the-badge\&logo=github\&logoColor=white)

---

# 🖥️ System Preview

## 🔐 Login

Halaman login digunakan untuk melakukan autentikasi sebelum pengguna dapat mengakses sistem.

![Login](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/LOGIN.png?raw=true)

---

## 👥 Master Data Penduduk

Halaman ini digunakan untuk melihat dan mengelola data penduduk yang terdaftar dalam sistem.

![Master Data Penduduk](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/MASTER%20DATA%20PENDUDUK.png?raw=true)

---

## ➕ Tambah Data Penduduk

Form digunakan untuk menambahkan data penduduk baru ke dalam sistem.

![Tambah Data Penduduk](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/TAMBAH%20TRANSAKSI%20TAGIHAN.png?raw=true)

---

## 🧾 Master Data Tagihan

Halaman untuk mengelola data tagihan yang digunakan dalam proses transaksi.

![Master Data Tagihan](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/MASTER%20DATA%20TAGIHAN.png?raw=true)

---

## 👤 Master Data User

Halaman untuk mengelola akun dan pengguna yang memiliki akses ke sistem.

![Master Data User](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/MASTER%20DATA%20USER.png?raw=true)

---

## 💳 Transaksi Tagihan

Halaman utama untuk melihat dan mengelola transaksi tagihan warga.

![Transaksi Tagihan](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/TRANSAKSI%20TAGIHAN.png?raw=true)

---

## ➕ Tambah Transaksi Tagihan

Form untuk membuat transaksi tagihan baru berdasarkan data warga dan jenis tagihan.

![Tambah Transaksi Tagihan](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/TAMBAH%20TRANSAKSI%20TAGIHAN.png?raw=true)

---

## ✏️ Edit Transaksi Tagihan

Digunakan untuk memperbarui informasi transaksi tagihan yang sudah tersimpan.

![Edit Transaksi Tagihan](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/EDIT%20TRANSAKSI%20TAGIHAN.png?raw=true)

---

## 🗑️ Konfirmasi Hapus Tagihan

Sistem memberikan konfirmasi sebelum transaksi dihapus untuk mencegah kesalahan penghapusan data.

![Alert Hapus Transaksi](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/ALERT%20HAPUS%20TRANSAKSI%20TAGIHAN.png?raw=true)

---

## 📱 Konfirmasi Kirim WhatsApp

Konfirmasi sebelum sistem mengirimkan informasi tagihan kepada warga melalui WhatsApp.

![Konfirmasi WhatsApp](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/ALERT%20KONFORMASI%20WHATSAPP%20TRANSAKSI%20TAGIHAN.png?raw=true)

---

## 💰 Konfirmasi Pelunasan Tagihan

Konfirmasi digunakan sebelum mengubah status transaksi menjadi lunas.

![Konfirmasi Pelunasan](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/ALERT%20PELUNASAN%20TRANSAKSI%20TAGIHAN.png?raw=true)

---

## 📥 Export Data ke Excel

Data transaksi dapat diekspor ke dalam format Excel untuk kebutuhan dokumentasi dan pengolahan data lebih lanjut.

![Unduh Excel](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/UNDUH%20EXCEL.png?raw=true)

---

## ✅ Hasil Export Excel

Berikut merupakan hasil data yang berhasil diekspor ke dalam format Excel.

![Hasil Unduh Excel](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/UNDUH%20EXCEL%20BERHASIL.png?raw=true)

---

## 📲 WhatsApp Notification

Sistem dapat mengirimkan informasi tagihan kepada warga melalui integrasi WhatsApp menggunakan **Twilio**.

![Notifikasi WhatsApp](https://github.com/putri-suci-aliyah/sistem_tagihan/blob/main/img/NOTIFIKASI%20WHATSAPP.png?raw=true)

---

# 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/putri-suci-aliyah/sistem_tagihan.git
```

### 2. Masuk ke Folder Project

```bash
cd sistem_tagihan
```

### 3. Install Dependency

```bash
composer install
```

### 4. Copy Environment File

```bash
cp .env.example .env
```

Untuk Windows:

```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buat database MySQL kemudian sesuaikan konfigurasi pada file `.env`.

```env
DB_DATABASE=sistem_tagihan
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika tersedia seeder:

```bash
php artisan db:seed
```

### 8. Konfigurasi Twilio

Tambahkan credential Twilio pada file `.env` sesuai dengan konfigurasi akun Twilio yang digunakan.

```env
TWILIO_SID=your_twilio_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_WHATSAPP_FROM=your_whatsapp_sender
```

> ⚠️ **Security:** Jangan memasukkan `TWILIO_AUTH_TOKEN`, password database, atau credential lainnya secara langsung ke repository GitHub. Gunakan file `.env` dan pastikan `.env` sudah masuk ke `.gitignore`.

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Kemudian akses aplikasi melalui:

```text
http://127.0.0.1:8000
```

---

# 📂 Project Structure

Project menggunakan pola arsitektur **MVC (Model-View-Controller)** yang disediakan oleh Laravel.

```text
sistem_tagihan/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── img/
│
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
├── .env.example
├── composer.json
└── README.md
```

---

# 👩‍💻 Role & Contribution

**Role:** Full-Stack Web Developer

### Responsibilities

* Menganalisis kebutuhan sistem pengelolaan tagihan warga.
* Merancang dan mengimplementasikan database MySQL.
* Mengembangkan backend menggunakan Laravel 10.
* Mengembangkan antarmuka menggunakan AdminLTE.
* Mengimplementasikan CRUD data penduduk.
* Mengimplementasikan CRUD data tagihan.
* Mengimplementasikan CRUD data user.
* Mengembangkan modul transaksi tagihan.
* Mengimplementasikan proses pelunasan tagihan.
* Mengintegrasikan sistem dengan **Twilio WhatsApp**.
* Mengembangkan fitur export data ke Excel.
* Melakukan testing dan debugging aplikasi.

---

# 💡 Key Highlights

### 📊 Centralized Data Management

Seluruh data penduduk, tagihan, user, dan transaksi dikelola dalam satu sistem.

### 📱 WhatsApp Integration

Sistem terintegrasi dengan **Twilio** untuk membantu menyampaikan informasi tagihan melalui WhatsApp.

### 💰 Payment Status Tracking

Status transaksi dapat dikelola untuk membedakan tagihan yang masih harus dibayar dan yang telah lunas.

### 📥 Data Export

Data transaksi dapat diekspor ke Excel sehingga dapat digunakan untuk kebutuhan administrasi dan dokumentasi.

### 🔐 Controlled Access

Sistem menggunakan autentikasi untuk mengontrol akses pengguna terhadap aplikasi.

---

# 🔮 Future Development

Beberapa pengembangan yang dapat dilakukan:

* 📱 Responsive interface untuk perangkat mobile.
* 🔔 Notifikasi otomatis ketika tagihan mendekati jatuh tempo.
* 📊 Dashboard statistik pembayaran.
* 📈 Grafik pemasukan dan status pembayaran.
* 👥 Role-based access control.
* 🧾 Generate invoice atau bukti pembayaran.
* 🔎 Advanced search dan filtering.
* 📅 Riwayat pembayaran setiap warga.
* 📲 Otomatisasi reminder pembayaran melalui WhatsApp.

---

# 📄 Project Information

| Informasi                | Detail                   |
| ------------------------ | ------------------------ |
| **Project**              | Sistem Tagihan Warga     |
| **Type**                 | Web Application          |
| **Framework**            | Laravel 10               |
| **Language**             | PHP                      |
| **Database**             | MySQL                    |
| **UI Template**          | AdminLTE                 |
| **WhatsApp Integration** | Twilio                   |
| **Architecture**         | MVC                      |
| **Platform**             | Web                      |
| **Development Role**     | Full-Stack Web Developer |

---

## ⭐ Project Summary

> **Sistem Tagihan Warga** mendigitalisasi proses pengelolaan tagihan, mulai dari manajemen data penduduk, pencatatan transaksi, pelunasan, hingga penyampaian informasi tagihan melalui WhatsApp.

**Key Skills Demonstrated**

`Laravel` · `PHP` · `MySQL` · `AdminLTE` · `CRUD` · `MVC` · `Twilio API` · `WhatsApp Integration` · `Excel Export` · `Git/GitHub`

---

## 📬 Contact

**Developed by Suci Aliyah Putri**

*Informatics Student | Full-Stack Web Developer*
