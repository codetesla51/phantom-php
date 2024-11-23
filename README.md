<p align="center">
  <img src="https://img.shields.io/badge/version-1.0-blue" alt="Version">
  <img src="https://img.shields.io/badge/license-MIT-green" alt="License">
</p>

<p align="center">
  <img src="https://raw.githubusercontent.com/codetesla51/phantom-php/refs/heads/main/icon.png" alt="PhantomPHP Server Screenshot" width="600">
</p>

---

## Table of Contents
- [Overview](#overview)
- [Key Features](#key-features)
- [Installing PhantomPHP](#installing-phantomphp)
  - [Installation Requirements](#installation-requirements)
  - [Installation Steps](#installation-steps)
- [Usage](#usage)
  - [Serving](#serving)
  - [Port Selection](#port-selection)
  - [Port Forwarding](#port-forwarding)
  - [Direct File Running in PHP](#direct-file-running-in-php)
  - [Further Help](#further-help)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

**PhantomPHP** is a PHP web server for Android, designed for use with the Acode app, enabling you to run and share PHP and MySQL applications from your device. It’s built to provide fast performance, high reliability, and easy integration with MySQL databases for powerful, dynamic web development.

## Key Features

- **PHP Serving**: Run PHP files directly from Acode.
- **Port Forwarding**: Share your local server with others securely.
- **Direct PHP File Execution**: Execute files without additional configuration.
- **Seamless Fast Auto Installation Integration**: Quick automatic setup, you don't have to do much.
- **MySQLi and phpMyAdmin Support**: Manage databases with ease.
- **Custom Port Selection**: Choose your preferred port.
- **User-Friendly Interface**: Optimized for ease of use.

---

## Installing PhantomPHP

To install PhantomPHP on your Android device, you’ll need the following prerequisites:

### Installation Requirements

1. **Termux**:  
   A powerful Linux terminal emulator for Android, available on [F-Droid](https://f-droid.org) and [GitHub](https://github.com/termux/termux-app/releases).  
   This will allow you to run a Linux environment on your Android device.

2. **Acode**:  
   A code editor for Android, available on the [Google Play Store](https://play.google.com/store).  
   Ideal for editing and writing your code directly on your Android device.

3. **PHP (version 7.4 or above)**:  
   Installable via Termux.  
   PHP is required for running server-side scripts and applications.

4. **Composer**:  
   A PHP package manager used for handling dependencies and libraries in PHP projects.  
   You can install Composer in Termux to manage PHP packages.

5. **MariaDB**:  
   A popular open-source database management system, forked from MySQL.  
   Required for managing databases in your projects.

6. **phpMyAdmin**:  
   A web-based tool for managing MySQL and MariaDB databases.  
   It provides an easy-to-use interface for database administration.

### Installation Steps

1. **Install Termux**:
   - Download and install Termux from [F-Droid](https://f-droid.org) or the [Termux GitHub releases page](https://github.com/termux/termux-app/releases).

2. **Install Acode**:
   - Download and install Acode from the [Google Play Store](https://play.google.com/store).

3. **Install Composer**:
   - Open Termux and run the following commands to install Composer:

    ```bash
    pkg update
    pkg upgrade
    pkg install php
    pkg install curl
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/data/data/com.termux/files/usr/bin --filename=composer
    ```

   This will install **Composer** globally in Termux.

4. **Run Auto Installation Command**:
   - Once **Composer** is installed, copy and paste the following commands to automatically install and configure the required dependencies:

    ```bash
    composer global require dconco/phantom-php
    echo export PATH="$PATH:~/.composer/vendor/bin" >> ~/.profile
    phantom --install
    phantom -v
    ```

5. **Access phpMyAdmin**:
   - Use the `phantom` command to start the PHP server for phpMyAdmin access. Replace `<port>` with the desired port number (e.g., 8080):

    ```bash
    phantom --db <port>
    ```

Now, you should be able to access phpMyAdmin through your browser by navigating to `http://localhost:<port>`.
 
### Testing

To test your setup, navigate to your project directory and run the following command:

```bash
phantom -v
```
---
### Usage
**Basic Usage Outline for PhantomPHP Server**

### Serving
This is the basic way to serve your PHP project. It will run a local server with the default port 8000.

**example:**
```bash
cd /path/to/your-project-directory
phantom --serve
```
---
### Port Selection
In case the default port 8000 is already in use, you can change the port by using the -p option followed by your desired port number (e.g., 8080).

**example**
```bash
phantom --serve 8080
```
#### This will run the local server on the selected port.
---
### phpMyAdmin Initialization
To start both MySQL and phpMyAdmin for database interaction, you can specify a custom port with the -D flag. In this example, we use port 8880. If a port is already in use, the server will not run.

**example**
```bash
phantom --db 8880
```
---
### Port Forwarding
Want to share your work with your team or friends? PhantomPHP allows you to forward your local server port and share it with others, including SSL certification for a secure connection. Use the -f flag to enable port forwarding.

**example**
```bash
phantom -serve 8080 -f 
#or use --forward
```
#### This will run the local server on port 8080 and forward the port for others to access.
---
### Direct File Running in PHP

To quickly run your PHP file and get immediate output, you can use the following command without needing to add the `.php` extension. Simply provide the filename.

**Usage Example:**
```bash
phantom -run filename
```
#### For instance:
```bash
phantom --run init
```
#### This will run the init.php file.
---
### Need Further Help?

If you're still having trouble, you can contact the repository owner or contributors for assistance. You can also email your issue to:

**Email:** uoladele99@gmail.com, info@dconco.dev

For additional command options, you can view the help menu with:
```bash
phantom --help
```
---
## Contributing

We welcome contributions! If you'd like to improve or fix something, please open an issue to start a discussion. Once your idea is approved, feel free to submit a pull request.

## License

<h4>This project is licensed under the **MIT License**, which allows you to
freely use, modify, and distribute the code. See the `LICENSE` file for full
details.</h4>

---
## Leave a Star ⭐

If you find **PhantomPHP Server** useful, please consider leaving a star on the repository! Your support helps others discover the project and motivates us to keep improving it.
