# 📁 Laravel File Sharing Application

A simple and secure file sharing platform built with Laravel. Easily upload files and generate shareable download links that you can send to anyone.

## 🚀 Features

- Upload any type of file
- Instant URL generation for downloading
- Lightweight and clean user interface
- Built on Laravel for scalability and security

## 🛠️ Built With

- [Laravel](https://laravel.com/) - PHP web framework
- MySQL - For database management

## 📂 How It Works

1. Upload a file from the upload page.
2. Get a unique download link.
3. Share the link with anyone to allow them to download the file.

## 🧑‍💻 Installation

Follow these steps to install and run the project locally:

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Node.js and NPM (for compiling frontend assets, if needed)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   cd your-repo-name
2.Install PHP dependencies
   composer install
   
3.Install Node dependencies and compile assets
    npm install
    npm run dev
    
4.Set up your environment file
    cp .env.example .env

5.Generate application key
    php artisan key:generate
    
6.Configure database
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    
7.Run database migrations
    php artisan migrate
    
8.Serve the application
    php artisan serve OR composer run dev
