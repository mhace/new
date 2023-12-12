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
  res.redirect('http://localhost/finals/pages/Requester/requester.php');
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

});

app.get('/download', function(req, res){
  var filename = req.query.filename

  if (filename) {
    const file = `${__dirname}/uploads/`+ filename;
    res.download(file);
  }
  
});

app.post('/updateDocument', (req, res) => {
  var title = req.body.editDocumentTitle
  var status = req.body.editStatus
  var id = req.body.id
 

  if (title.trim()) {
    connection.connect()

    connection.query('UPDATE document set documentName="'+title+'" where documentID='+id, (err, rows, fields) => {
      if (err) throw err
      console.log('Updating Title.')
    })
  }

  connection.query('UPDATE document set documentStatus="'+status+'" where documentID='+id, (err, rows, fields) => {
    if (err) throw err
    console.log('Updating Status.')
  })
  res.redirect('http://localhost/finals/pages/Reviewer/reviewerDocument.php')
});


app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

