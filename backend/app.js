const express = require('express');
const routes = require('./router/userRoutes'); // Adjust the path based on your project structure
const { jsonParser } = require('./utils/middleware');

const app = express();

// Use the routes defined in the separate file
app.use('/users', routes); // Set the base path for these routes

const PORT = 3304;

app.listen(PORT, () => {
    console.log(`CORS-enabled web server listening on port ${PORT}`);
});
