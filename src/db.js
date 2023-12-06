// Establish a database connection here
const mysql = require("mysql");
const fs = require("fs");
const path = require("path");
require("dotenv").config();

const dbConfig = JSON.parse(fs.readFileSync(path.join(__dirname, "teamtwoone.mysql"), "utf8")); // pls check

const connection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
});

connection.connect(function (err) {
    if (err) {
        console.error("Error connecting to database: " + err.stack);
        return;
    }
    console.log("Connected to database as id " + connection.threadId);
});

module.exports = connection;