# Admin CMS with Laravel 11

## 🚀 Introduction
This is an advanced **Admin CMS** built with **Laravel 11**, featuring **DataTables** for dynamic data management and recommended security implementations. Designed for efficiency, security, and ease of use.

## 🛠️ Features
- 🔥 **Built with Laravel 11** – Modern, secure, and scalable
- 📊 **DataTables Integration** – Fast and interactive data handling
- 🔐 **Recommended Security Best Practices** – Protects against common vulnerabilities
- 📂 **Role & Permission Management** – Secure access control
- 📸 **Media Management** – Upload, edit, and manage images easily
- 📈 **Dashboard with Analytics** – Track key metrics in real-time
- 🛡️ **CSRF & XSS Protection** – Ensures a secure user experience

## 📌 Requirements
- **PHP 8.2+**
- **Composer**
- **Laravel 11**
- **MySQL / PostgreSQL**
- **Node.js & npm (for asset compilation)**

## 🔧 Installation
1. **Clone the repository:**
   ```bash
   git clone https://github.com/maspriyambodo/bodo_cms.git
   cd admin-cms-laravel11
   ```
2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```
3. **Set up environment file:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Configure database & migrate:**
   ```bash
   php artisan migrate --seed
   ```
5. **Run the application:**
   ```bash
   php artisan serve
   ```

## 🔐 Security Best Practices
- Use **strong passwords** and enable **2FA**
- Regularly **update dependencies** to patch security vulnerabilities
- Implement **proper access control** for admin roles
- Enable **HTTPS & secure cookies** for secure sessions

## 📱 Social Media
Stay updated with the latest developments:
- **Instagram:** [maspriyamm](https://instagram.com/maspriyamm)
- **Facebook:** [no.hacker.on](https://facebook.com/no.hacker.on)
- **YouTube:** [maspriyambodo](https://youtube.com/@maspriyambodo)

## 📝 License
This project is licensed under the **MIT License** – feel free to modify and distribute!
