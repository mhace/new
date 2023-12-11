const bodyParser = require('body-parser');
const express = require('express')
const uploadMiddleware = require('./upload');
const mysql = require('mysql')
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'teamtwoone-final'
})


var app = express()
const port = 3000;


app.use(bodyParser.urlencoded({ extended: true }));

const upload = require('./upload');

app.get('/', (req, res) => {
  console.log(__dirname)
  res.sendFile(__dirname+"/pages/test_upload.html")
});

app.post('/upload', uploadMiddleware, (req, res) => {
  // res.json({ message: req.body });
  connection.connect()
    connection.query('insert into document (documentName, documentFile,documentStatus) values (?,?,?)',[req.body.documentType, req.body.title, 'pending'], (err, rows, fields) => {

    if (err) throw err
  })
  // connection.end()
});

app.get('/test', (req, res) => {
    connection.connect()

    connection.query('SELECT * from document ', (err, rows, fields) => {

    if (err) throw err

    console.log('The solution is: ', rows[0].documentID)
    res.json({
     documentName:  rows[0].documentName,
     documentID: rows[0].documentID,
     documentFile: rows[0].documentFile});
  })

  connection.end()
});


app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

