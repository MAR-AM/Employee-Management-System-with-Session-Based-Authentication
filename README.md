# Employee-Management-System-with-Session-Based-Authentication
This project is a PHP-based Employee Management System that facilitates user registration, login, and employee data management. It includes scripts for database connectivity, user authentication, and displaying a list of employees. 

File Overview
connEmp.php

This file likely contains the database connection details and functions specific to managing employee-related data.
conxDB.php

This file contains the general database connection script, which is used throughout the application to connect to the database.
listIns.php

This script lists the registered employees, displaying their information in a structured format.
S'inscrire.php

This file handles the user registration process, allowing new users to sign up and create an account for accessing the system.
Usage
User Registration

Users can register by filling out the form in the S'inscrire.php file, which captures their details and stores them in the database.
User Login

The connEmp.php script manages the login process, authenticating users and starting a session.
Employee Data Management

Authenticated users can view and manage employee data through the listIns.php script, which displays a list of employees from the database.
Database Connection

Both conxDB.php and connEmp.php ensure seamless and secure connectivity to the database, enabling data operations across the application.
Features
User Authentication: Secure login and registration system using sessions.
Employee Data Management: View and manage a list of employees.
Database Connectivity: Reliable and reusable database connection scripts.
Session Management: Ensures that only authenticated users can access certain pages and functionalities.
This project provides a robust foundation for an Employee Management System, focusing on secure user authentication and efficient data management.
