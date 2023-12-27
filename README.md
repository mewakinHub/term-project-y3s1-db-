# Database Lab Project - GGG App

Project: Good Games Garage - A video game digital storefront
> This is term-project of 3rd year 1st semester in CSS326 Database lab programming

## Description

Our project is an online platform or marketplace where users can digitally buy, download, and play our handpicked selection of high-quality video games. We exclusively offer polished and well-reviewed games, catering to the needs of avid gamers who seek to discover and purchase great games without sifting through mediocrity. In addition, our pricing is very competitive, as we only take a small cut on each sale.

### Group members:

1. Mr. Piraboon Piyawarapong - 6422781466
DB design/UI design/So Cool Frontend on the main app
3. Mr. Kavinrath Jundang - 6422781516
DB design/Backend on the main app
4. Mr. Teetawat Bussabarati - 6422782423
DB design/Admin(CRUD)/Security on main app

DB design: Procedure/Trigger/Relationship/etc.
Our DB security: Encrypt/Prevent Injection/Session handling

## Getting Started
## Setup Instructions

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/your-repo.git
    ```

2. Set up your MySQL database:

    - Create a new database named `ggg`.
    - Import the `database.sql` file to create the necessary tables.

3. Configure Database Connection:

    - Update the database connection details in `script/connect.php`.

4. Run the Application:

    - Start a local PHP development server or use XAMPP, WAMP, or any other suitable server.

## Help

- userID using as SESSION because we're going to use it on every page!

we're not deployed to a domain, so you cannot access it through a url(example.com) {LocalHost}

```
"In our project, we have employed Structured Query Language (SQL) as our primary database management system, coupled with the utilization of the Macintosh, Apache, MySQL, and PHP (MAMP) stack as our server environment."
```

<!-- ## Version History

* 0.2
    * PHP
* 0.1
    * React and Node -->

**PHP Architecture vs. Node/React:**
   - PHP traditionally allows for more server-side rendering and mixing of front-end and back-end code in the same file. This approach can be convenient but may not be as modular or scalable as separating front-end (e.g., HTML, CSS, JavaScript) and back-end logic (PHP) into different files or even different technologies.
   - Node.js and React, on the other hand, encourage a more modular and separated approach, making it easier to maintain and scale applications. Node handles server-side logic, while React focuses on the front end. This separation can lead to cleaner and more maintainable code in larger applications.

