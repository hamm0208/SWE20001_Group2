# Online Food and Beverage Catering Management System (FCMS)

## Description
This is a website project built with mainly HTML, CSS, JavaScript, and PHP. This guide will help you set up and run the project on your local machine.
GITHUB: https://github.com/hamm0208/SWE20001_Group2

Preset Accounts:
Email: thenbeckham@gmail.com           Password: 12345          User:Management
Email: everlynchin09@gmail.com         Password: 12345          User:Management
Email: anjanaalyann@gmail.com          Password: 12345          User:Management
Email: crystalgoh01@gmail.com          Password: 12345          User:Management
Email: isakibul623@gmail.com           Password: 12345          User:Management
Email: ThomasShelby@gmail.com          Password: 12345          User:Customer

To view the operational portall:
Sign in as any of the management acounts, go to the User Page, click the edit picture on the desired account, change the user type to operational, log out of the acount and sign it to the acount that you changed

## Prerequisites
Before you begin, ensure you have met the following requirements:
- You are using one of the following operating systems: Windows, macOS, or Linux.
- You have installed the following software:
  - **XAMPP**: If you have downloaded xampp you can skip the 3-4 because Apache and MySQL is already on XAMPP
  - **Apache**: A web server to serve your website.
  - **MySQL**: A relational database management system.
  - **PHP**: A server-side scripting language.
  - **Git**: A version control system to clone the repository.
  - **GitHub Desktop**: Can clone the files from the repository.
  - **Visual Studio Code (VSC)**: A code editor for writing and managing your code.

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/hamm0208/SWE20001_Group2
    ```

2. **Navigate to the project directory**:
    ```bash
    cd your-repository
    ```

3. **Set up Apache**:
    - Ensure Apache is installed and running. You can start Apache by:
        ```bash
        sudo service apache2 start  # On Ubuntu/Debian
        sudo service httpd start    # On CentOS/Fedora
        ```
    - On Windows, start Apache from the XAMPP control panel.

4. **Set up MySQL**:
    - Ensure MySQL is installed and running. You can start MySQL by:
        ```bash
        sudo service mysql start  # On Ubuntu/Debian
        sudo service mysqld start # On CentOS/Fedora
        ```
    - On Windows, start MySQL from the XAMPP control panel.

5. **Update configuration files**:
    - Update the database configuration in your project. For example, in `database.php`:
        ```php
        <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'your_username');
        define('DB_PASSWORD', 'your_password');
        define('DB_DATABASE', 'your_database_name');
        ?>
        ```

7. **Move project files to the web server directory**:
    - On Linux:
        ```bash
        sudo cp -r * /var/www/html/
        ```
    - On Windows, move the files to the `htdocs` directory of your XAMPP installation.

## Running the Project

1. **Open your web browser**:
    - Navigate to `http://localhost/` to see your website.
2. **To login to the webpage, you may use the following:**
    - As Admin:
      ```
      email: crystalgoh01@gmail.com | password: 12345
      ```
    - As Customer:
      ```
      email: ThomasShelby@gmail.com | password: 12345
      ```

