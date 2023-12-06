const express = require("express");
const app = express();
const path = require("path");
const session = require("express-session");
const authRoutes = require("./routes/auth");
const User = require("./models/user.js");
const db = require("./db");
const cors = require("cors");
const activeSessions = require("./activeSessions.js");
require("dotenv").config();

function generateSessionId() {
    let sessionId = uuidv4(); // generates a unique session id
    console.log(`Generated session id ${sessionId}`);
    return sessionId;
}

app.use(cors());


module.exports = app;