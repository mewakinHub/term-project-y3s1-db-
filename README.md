# Database Lab Project - GGG App

Project: Good Games Garage - A video game digital storefront
> This is term-project of 3rd year 1st semester in CSS326 Database lab programming

## Description

Our project is an online platform or marketplace where users can digitally buy, download, and play our handpicked selection of high-quality video games. We exclusively offer polished and well-reviewed games, catering to the needs of avid gamers who seek to discover and purchase great games without sifting through mediocrity. In addition, our pricing is very competitive, as we only take a small cut on each sale.

### Group members:

1. Mr. Piraboon Piyawarapong - 6422781466
DB design/UI design/Cool Frontend
2. Mr. Kavinrath Jundang - 6422781516
DB design/Backend
3. Mr. Teetawat Bussabarati - 6422782423
DB design/Admin(CRUD)/Security(Encrypt/Prevent Injection/Session handling)
DB design: Procedure/Trigger/Relationship/etc.

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

we're not deployed to a domain, so you cannot access it through a url(example.com) {LocalHost}

```
"In our project, we have employed Structured Query Language (SQL) as our primary database management system, coupled with the utilization of the Macintosh, Apache, MySQL, and PHP (MAMP) stack as our server environment."
```

<!-- ## Version History

* 0.2
    * PHP
* 0.1
    * React and Node -->

## Tool

Inspiration, code snippets, etc.
* [awesome-readme](https://github.com/matiassingers/awesome-readme)
* [PurpleBooth](https://gist.github.com/PurpleBooth/109311bb0361f32d87a2)
* [dbader](https://github.com/dbader/readme-template)
* [zenorocha](https://gist.github.com/zenorocha/4526327)
* [fvcproductions](https://gist.github.com/fvcproductions/1bfc2d4aecb01a834b46)

- **Express:** It is primarily used for connecting the frontend (client-side) with the backend (server-side). It handles routing, HTTP requests, middleware, and the overall structure of your application. Express can also be used to manage interactions between the frontend and backend components.

- **Prisma:** Prisma is primarily used for connecting to the database and handling database queries. It provides an elegant, type-safe API for working with databases, including creating, reading, updating, and deleting data. Prisma abstracts the underlying SQL database and simplifies database operations.
https://www.prisma.io/

In a full-stack application, Express typically sits in the backend layer, while Prisma is responsible for the database interaction within the backend. The frontend communicates with the Express server, and the server, in turn, communicates with the database using Prisma to retrieve or update data. This separation of concerns allows for a more organized and efficient development process.

## Fact

1. **REST API as a Bridge:** (Express.js)
   - Yes, a REST API typically acts as a bridge between the front end and the back end in modern web applications. It provides a standardized way for the front end (in your case, React) to communicate with the back end (Node.js with Express) by defining a set of endpoints (routes) for performing various operations (GET, POST, PUT, DELETE).

2. **Differences between Express and MAMP (PHP/MySQL):**
   - Express is a Node.js web framework, while MAMP is a solution stack commonly used for PHP/MySQL development. The key differences include:
     - **Technology Stack:** Express uses Node.js as its runtime, while MAMP typically uses Apache as a web server for serving PHP files.
     - **Programming Language:** Express is JavaScript, while MAMP involves PHP for server-side scripting.
     - **Database Handling:** In MAMP, PHP scripts can connect directly to MySQL databases. In the Express example you provided, it returns JSON data but doesn't interact with a database directly. You'd need to add database connectivity to handle data in Express.

3. **Creating REST API with Express before Prisma:**
   - Yes, typically, you would create the REST API using Node.js and Express first. This API defines the endpoints and routes that your front-end (React) can call to interact with your back-end. Prisma, on the other hand, is used within the back end to interact with the database. The API built with Express connects to Prisma to perform database operations.

4. **Using a Specific Structure for Database Access:**
   - In Node.js and Express, using a structured approach like Prisma is recommended for a few reasons. It provides a type-safe, organized way to interact with databases, and it generates efficient SQL queries automatically. While you could open a raw database connection without a library, this can lead to issues like SQL injection and less maintainable code. Prisma simplifies database access and enhances security.

5. **GET and POST in PHP vs. REST API:**
   - In both PHP (with HTML forms) and REST APIs, GET and POST are HTTP methods used to send data between a client and a server. However, the way they are used can differ:
     - In PHP, GET and POST are often used with HTML forms for client-server communication.
     - In a REST API, GET and POST are used to retrieve and create resources (data) on the server, respectively. They are part of a structured API design for accessing and modifying data.

6. **PHP Architecture vs. Node/React:**
   - PHP traditionally allows for more server-side rendering and mixing of front-end and back-end code in the same file. This approach can be convenient but may not be as modular or scalable as separating front-end (e.g., HTML, CSS, JavaScript) and back-end logic (PHP) into different files or even different technologies.
   - Node.js and React, on the other hand, encourage a more modular and separated approach, making it easier to maintain and scale applications. Node handles server-side logic, while React focuses on the front end. This separation can lead to cleaner and more maintainable code in larger applications.

Each technology and approach has its strengths and use cases, and the choice depends on the specific requirements of your project and your development style.


## how it's work

**1. Connecting Front-End (React) with Back-End (Node.js and Express):**

   - **Study Axios or Fetch:** To connect your React front-end to your Node.js/Express back-end, you need to learn how to make HTTP requests from your React components to your server. Axios and the built-in `fetch` API are commonly used for this purpose.
     - **Study Material:**
       - Axios Documentation: https://axios-http.com/docs/intro
       - React Axios Tutorial: https://www.youtube.com/watch?v=V6d-8T3eQOg

   - **Create API Endpoints:** In your Express back-end, you should define API endpoints to handle HTTP requests from your React front-end. These endpoints should correspond to the RESTful routes (e.g., GET, POST, PUT, DELETE) for your To-Do list.
     - **Study Material:**
       - Express.js Routing: https://expressjs.com/en/guide/routing.html

   - **Handling JSON Data:** Ensure that your Express server can handle JSON data sent from your React front-end. You'll need to use body parsers and middleware for this purpose.

   - **Cross-Origin Resource Sharing (CORS):** You may need to handle CORS to allow your React application (running on a different domain) to make requests to your Express server.
     - **Study Material:**
       - Understanding CORS: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS

**2. Connecting React to a SQL Database using Prisma:**

   - **Prisma Setup:** Set up Prisma in your Node.js/Express back-end to interact with your SQL database. Prisma simplifies database access by generating type-safe client code.
     - **Study Material:**
       - Prisma Documentation: https://www.prisma.io/docs/
       - Prisma Setup Tutorial: https://www.youtube.com/watch?v=6RiWr0f9lQY

   - **Create Prisma Models:** Define data models in Prisma that represent your database tables (e.g., To-Do items). These models will be used to generate database queries.

   - **Prisma Client:** Use the Prisma client (auto-generated by Prisma) to perform database operations from your Node.js/Express back-end. This includes inserting, updating, and retrieving data from the SQL database.

   - **Expose Prisma Queries as API Endpoints:** Create API endpoints in your Express server that use Prisma queries to interact with the database and return data to your React front-end.

**3. Project Overview:**

- **Front-End (React):**
   - User interface components for the To-Do list.
   - Axios or Fetch to send HTTP requests to the Express API.

- **Back-End (Node.js with Express):**
   - Define API endpoints for CRUD operations.
   - Use Prisma for database access.
   - Set up CORS handling.

- **Database (SQL):**
   - Create tables for To-Do items.

- **Prisma:**
   - Define Prisma models based on your database schema.
   - Use Prisma Client to interact with the database.