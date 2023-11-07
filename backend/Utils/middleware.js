const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');

const jsonParser = bodyParser.json();

const app = express();

app.use(cors());

module.exports = {
    jsonParser,
};