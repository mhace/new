const bodyParser = require('body-parser');
const express = require('express')
const uploadMiddleware = require('./upload');
const mysql = require('mysql')
const connection = mysql.createPool({
  connectionLimit : 10,
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

    connection.query('UPDATE document set documentName="'+title+'" where documentID='+id, (err, rows, fields) => {
      if (err) throw err
      console.log('Updating Title.')
    })
  }

  connection.query('UPDATE document set documentStatus="'+status+'" where documentID='+id, (err, rows, fields) => {
    if (err) throw err
    console.log('Updating Status.')
  });

  res.redirect('http://localhost/finals/pages/Reviewer/reviewerDocument.php');

});


app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

