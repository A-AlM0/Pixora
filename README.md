<div align="center">

  <img src="Project_Pixora_2.01/Project_Pixora_2.01/images/pixora_logo.png" alt="Pixora Logo" width="160" />

  # Pixora
  ### 📸 Modern Progressive Web App for Photo Sharing & Social Interaction

  [![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
  [![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
  [![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
  [![PWA Ready](https://img.shields.io/badge/PWA-Ready-5A0FC8?style=for-the-badge&logo=pwa&logoColor=white)](https://web.dev/progressive-web-apps/)
  [![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
  [![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

  <p align="center">
    <strong>A responsive, feature-rich social media platform designed to capture, upload, and explore moments with native-like offline capabilities.</strong>
  </p>

  <p align="center">
    <a href="#-overview">Overview</a> •
    <a href="#-features">Features</a> •
    <a href="#-tech-stack">Tech Stack</a> •
    <a href="#-project-structure">Project Structure</a> •
    <a href="#-getting-started">Getting Started</a> •
    <a href="#-database-schema">Database Schema</a> •
    <a href="#-api-endpoints">API</a> •
    <a href="#-author">Author</a>
  </p>

</div>

---

## 📖 Overview

**Pixora** is a full-stack Progressive Web Application (PWA) developed as a photo-sharing and social networking platform. It combines a dynamic PHP/MySQL backend with a modern, mobile-first responsive frontend powered by Bootstrap 5 and vanilla JavaScript.

Pixora is engineered to deliver a smooth, native app-like experience across all devices, featuring service worker caching for offline access, secure session-based authentication, real-time social interactions (likes and comments), tag-based photo discovery, and dedicated RESTful API endpoints.

---

## ✨ Features

### 📱 Progressive Web App (PWA)
- **Installable Experience**: Can be installed directly to home screens on Android, iOS, Windows, and macOS via `manifest.json`.
- **Offline Reliability**: Powered by `service-worker.js` to cache core assets and provide an intuitive offline fallback page (`Offline.html`).
- **Fast Load Times**: Static asset caching and lightweight architecture ensure lightning-fast navigation.

### 🔐 User Management & Security
- **Authentication**: Secure registration and login flows with password hashing (`password_hash` using bcrypt).
- **Profile Customization**: Users can edit personal information, write a bio, specify hobbies, and upload custom profile avatars.
- **Session Protection**: Safe server-side PHP session management.
- **Upload Hardening & Optimization**: Strict MIME-type inspection via `finfo`, anti-web-shell `.htaccess` execution locks on `uploads/`, and automatic GD-based image compression.
- **Environment Isolation**: Dynamic configuration through `.env` files preventing hardcoded credentials in version control.

### 📸 Photo Feed & Content Creation
- **Media Uploads**: Clean upload modal and page supporting various image formats with server-side validation and unique file name generation.
- **Dynamic Feed**: Personalized home feed showcasing posts with user avatars, captions, and creation timestamps.
- **Explore & Tags**: Discover content by tags and trending community uploads (`explore.php`).
- **Post Management**: Creators have full control to view and delete their own posts.

### 💬 Social Interactions
- **Likes System**: Interactive like/unlike functionality with instant counter updates and a dedicated "Liked Posts" library (`likedPage.php`).
- **Comments**: Comment section on individual posts allowing users to engage and discuss.

### 🔌 RESTful API
- **Modular API Design**: Ready-to-use JSON API layer located in `pixora_API` for user queries and programmatic data access.

---

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| **Frontend** | HTML5, CSS3, JavaScript (ES6+), Bootstrap 5.3.3 |
| **PWA Capabilities** | Service Worker API, Web App Manifest, Cache API |
| **Backend** | PHP 8.x (OOP & Procedural, PDO Database Driver) |
| **Database** | MySQL / MariaDB (InnoDB Engine with Foreign Keys) |
| **Styling & Icons** | Custom Responsive CSS, Bootstrap Icons / SVG |
| **Server Environment** | Apache (XAMPP / WampServer / LAMP) |

---

## 📂 Project Structure

```bash
Project_Pixora_2.01/
├── .env.example                 # Environment configuration template
├── .gitignore                   # Git ignore patterns
├── pixora.sql                   # Complete database dump & sample dataset
├── users credentials.txt        # Sample demo accounts for testing
└── Project_Pixora_2.01/         # Application Source Code
    ├── Database.php             # PDO database connection with .env support
    ├── ImageHelper.php          # Upload validation & GD image compression
    ├── .env.example             # Local environment configuration template
    ├── manifest.json            # PWA manifest configuration
    ├── service-worker.js        # Service worker for offline caching
    ├── Offline.html             # Offline fallback template
    │
    ├── main.php                 # Home feed / timeline
    ├── explore.php              # Explore & search page
    ├── post.php                 # Individual post view & comments
    ├── profile.php              # User profile page
    ├── account.php              # Account settings & edit profile
    ├── likedPage.php            # User's saved / liked posts
    ├── aboutUs.php              # About page
    │
    ├── login.php                # Authentication: Login
    ├── signup.php               # Authentication: Registration
    ├── logout.php               # Session termination
    │
    ├── upload_post.php          # Post creation handler (uses ImageHelper)
    ├── delete_post.php          # Post deletion handler
    ├── like_post.php            # AJAX like/unlike toggle
    ├── add_comment.php          # Comment submission handler
    ├── update_avatar.php        # Profile picture uploader (uses ImageHelper)
    │
    ├── pixora_API/              # RESTful API endpoints
    │   └── pixora_API/pixoradb_api/apis/json/users/users_api.php
    │
    ├── uploads/                 # Stored user media (avatars & posts)
    │   └── .htaccess            # Security: forbids script execution in uploads
    ├── css/                     # Custom stylesheets
    ├── js/                      # Frontend JavaScript files
    └── images/                  # Static assets & logos
```

---

## 🚀 Getting Started

Follow these steps to run Pixora on your local machine using **XAMPP**, **WampServer**, or any standard PHP/MySQL stack.

### 1. Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP 8.x + MySQL environment)
- Git installed on your system

### 2. Clone the Repository
```bash
git clone https://github.com/A-AlM0/Pixora.git
```
Place the cloned repository folder inside your web server's document root (e.g. `C:/xampp/htdocs/Pixora`).

### 3. Database Setup
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Create a new database named:
   ```sql
   CREATE DATABASE pixora CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```
3. Click on the `pixora` database and navigate to the **Import** tab.
4. Select the `pixora.sql` file located in the project root and click **Go / Import**.

### 4. Configure Database Connection
Check `Project_Pixora_2.01/Project_Pixora_2.01/Database.php` and verify your credentials (default for XAMPP):
```php
private $host = 'localhost';
private $dbname = 'pixora';
private $username = 'root';
private $password = '';
```

### 5. Launch Application
Open your web browser and navigate to:
```url
http://localhost/Pixora/Project_Pixora_2.01/Project_Pixora_2.01/login.php
```

> [!TIP]
> You can test the application using the dummy accounts listed in `users credentials.txt` or create a brand new account directly from the signup page.

---

## 🗄 Database Schema

The relational database consists of 5 core tables:

- **`users`**: User profiles, credentials (`password_hash`), avatars, bio, contact info.
- **`posts`**: Uploaded photos (`image_path`), captions, author foreign key, timestamps.
- **`likes`**: Post likes mapping (`user_id` ↔ `post_id`).
- **`comments`**: Comment content, author, post relation, timestamps.
- **`explore`**: Tagging and categorized content discovery.

---

## 📡 API Endpoints

Pixora includes internal JSON APIs for retrieving application data:

| Endpoint | Method | Description |
|---|---|---|
| `/pixora_API/.../users_api.php` | `GET` | Fetches JSON-formatted user profiles and account metadata |

---

## 👤 Author

**Ali Almalki**
- GitHub: [@A-AlM0](https://github.com/A-AlM0)

---

## 📄 License

This project is created for educational and portfolio purposes. Feel free to explore and learn from the codebase!
