const { createConnection } = require('mysql');

const connection = createConnection({
    host: "localhost",
    user: "root",
    password: "root", // Use your actual password if it's different
    database: "gamestore",
    port: 8889,
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL:', err);
        return;
    }

    console.log('Connected to MySQL');

});
module.exports = connection;

