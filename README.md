## 🔖 Tên dự án: Hệ thống quản lý đặt sân bóng đá mini

---

## 📌 Thông tin chung
---

## 👥 Thành viên nhóm

| STT | Họ và tên       | MSSV       | Vai trò                     |
|-----|------------------|------------|-----------------------------|
| 1   | Nguyễn Văn Lượng      | 23010799    | Phát triển Back-end (Laravel, DB) |
| 2   | Đàm Gia Phú       | 23010760   | Thiết kế giao diện (HTML/CSS, Blade) |
| 3   | Đặng Tuán Mạnh         | 23010819    | Triển khai & Kiểm thử (Git, Test, Deploy) |

---

## 🎯 Mục tiêu của dự án

- Cho phép người dùng đặt sân bóng theo thời gian thực
- Hiển thị danh sách sân bóng và trạng thái đặt sân
- Cung cấp lịch sử đặt sân cho người dùng
- Cung cấp chức năng quản lý sân, đặt sân cho admin
- Đảm bảo an toàn dữ liệu và xác thực người dùng

---

## ⚙️ Công nghệ sử dụng

- **Ngôn ngữ:** PHP, HTML, CSS, JavaScript
- **Framework:** Laravel 10.x
- **Giao diện:** Blade Template + Bootstrap
- **CSDL:** MySQL
- **Quản lý phiên:** Laravel Auth
- **Quản lý dự án:** Git & GitHub

---

## 🧩 Cấu trúc chức năng chính

- Đăng ký/Đăng nhập người dùng
- Trang hiển thị danh sách sân
- Chức năng đặt sân (theo ngày/giờ)
- Chức năng thanh toán tiền sân
- Tính năng giữ chỗ trong vòng 15 phút
- Tính năng tự hủy sân nếu người dùng không thực hiện thanh toán
- Tính năng đọc và tìm kiếm tin tức
- Quản lý lịch sử đặt sân
- Trang quản trị cho admin (CRUD sân, người dùng)

---

## 📂 Cài đặt dự án (Local)

1. Clone dự án:

```bash
git clone https://github.com/nvluong-05/PTTKPM25-26_CSE703048-1-3-25-N05-_Nhom4.git
```

2. Cài đặt thư viện:

```bash
composer install
```

3. Tạo file `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

4. Cấu hình database trong `.env`, sau đó chạy migration:

```bash
php artisan migrate
```

5. Chạy server:

```bash
php artisan serve
```

---

## 📌 Ghi chú

- Dự án được phát triển trong khuôn khổ môn học, không sử dụng cho mục đích thương mại.
- Nhóm sẵn sàng trình bày, demo và báo cáo đầy đủ nếu có yêu cầu.

---

## 📧 Liên hệ
- Email nhóm: 23010799@st.phenikaa-uni.edu.vn

---

> 🧠 Cảm ơn quý thầy cô đã theo dõi và góp ý cho dự án của nhóm!
