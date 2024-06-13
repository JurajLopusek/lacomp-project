# Project Title
A short description of your project goes here.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

### Installation

1. Clone the repository:
```bash
 git clone https://github.com/yourusername/yourproject.git
```

```bash
download wsl 
```

```bash
sudo add-apt-repository ppa:ondrej/php -y (add php 8.2 for installing laravel 11 and sail)
```

```bash
sudo apt update
```

```bash
sudo apt upgrade -y
```

```bash
sudo apt-get install php8.2
```

```bash
sudo apt-get install php8.2-xml
```

```bash
sudo apt-get install php8.2-zip
```

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

To make sure this is always available, you may add this to your shell configuration file in your home directory, such as ~/.zshrc or ~/.bashrc, and then restart your shell.

```bash
sail up -d
```

```bash
sail shell
```

```bash
php artisan key:generate
```

```bash
php artisan optimize:clear
```

```bash
php artisan migrate:fresh
```


### shorcuts
```bash
sail up -d && sail shell
```

```bash
npm run build && npm run dev
```

### Usage
To run the project, use the following command:
```bash
npm start
```

### Localhost
[Localhost](http://localhost:8000)

[phpMyAdmin](http://localhost:8080)

### Contributors

Martin Klacik [@mental-sigsegv](https://github.com/mental-sigsegv)

Juraj Lopušek [@JurajLopusek](https://github.com/JurajLopusek)

### License
This project is licensed under the [MIT License](LICENSE).

![Build Status](https://travis-ci.org/yourusername/yourproject.svg?branch=main)

![Alt Text - description of the image](https://d1hdtc0tbqeghx.cloudfront.net/wp-content/uploads/2020/07/27141257/laravel-livewire.jpg)

