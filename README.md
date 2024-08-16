# **Belanjago Seller Centre**
This is a simple CRUD application with an E-commerce theme.

# **Created by**
Alfarobby27

## Getting Started
1. Make sure your computer has [Git](https://git-scm.com/) and [XAMPP](https://www.apachefriends.org/download.html/) installed.

2. Clone this repository to your computer and enter the Belanjago-Seller folder from the terminal or cmd.
	```bash
	git clone https://github.com/Alfarobby27/Belanjago-Seller && cd Belanjago-Seller
	```

3. Move the Belanjago-Seller folder to the xampp directory below.
	```bash
	C:\xampp\htdocs
	```

4. Open the XAMPP application that you have downloaded. Click start on Apache and MySQL

5.  Create MySQL Database
    - Open Command prompt
      
    - Type below then enter. repeat once enter, until you are on the path C
      	```bash
          cd ..
	```
 
    - If you have typed below
 
        ```bash
          cd \xampp\mysql\bin
	```
 
    - Make sure you are already on this cmd path.
      C:\\xampp\mysql\bin\
      
    - Then type
       ```bash
         mysql -u root
       ```
       
    - Then type below to create a database
       ```bash
         CREATE DATABASE phpdasar;
         use phpdasar;
       ```
       
    - Then create a marketplace table
       ```bash
         CREATE TABLE marketplace(
         id int primary key auto_increment,
         gambar varchar(225),
         nama varchar(225),
         harga double, 
         stock int
         );
       ```
       
    - Then create a user table
       ```bash
         CREATE TABLE user(
         id int primary key auto_increment,
         username varchar(225),
         password varchar(225)
         );
       ```
       
   - Make sure the database that is created is written according to the above


6. If so, open your browser and paste the below into your browser.
	```bash
	localhost/Belanjago-Seller
	```
7. Make sure you register first, before logging in
   
## Features 
- [X] Login, Logout and Register Account
- [x] Display Product List
- [x] Add Product Data
- [x] Change Product Data
- [x] Delete Product Data
- [x] Search for Product Data


