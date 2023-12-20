const bodyParser = require('body-parser');
const express = require('express')
const uploadMiddleware = require('./upload');
const edituploadMiddleware = require('./editupload');
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
  res.redirect('http://localhost/drt/pages/Requester/requester.php');
});

app.get('/download', function(req, res){
  var filename = req.query.filename

  if (filename) {
    const file = `${__dirname}/uploads/`+ filename;
    res.download(file);
  }
  
});

app.post('/editupload', edituploadMiddleware, (req, res) => {
  res.redirect('http://localhost/drt/pages/Requester/requester.php');
});


app.post('/updateDocument', (req, res) => {
  var {comment, status, id} = req.body

  connection.query('UPDATE document set documentStatus=?, comment=? where documentID=?', [status, comment, id], (err, rows, fields) => {
    if (err) throw err
  });

  if (status == "approved") {
    connection.query('SELECT * FROM document where documentID=?', [id], (err, rows, fields) => {
      if (err) throw err

      officeid = parseInt(rows[0]['officeid'])

      if (officeid < 5) {
        status = "pending"
        connection.query('UPDATE document set documentStatus=?, officeid=? where documentID=?', [status, officeid+1, id], (err, rows, fields) => {
          if (err) throw err
        });
      } 
    })

  }
  action = "made changes to a document"
  data = {
    "status": status,
    "comment": comment,
    "documentid": id
  }

  connection.query('INSERT INTO logs (event,data,uid) values (?,?,?)',[action, JSON.stringify(data), req.body.uid], (err, rows, fields) => {

    if (err) throw err
    console.log("Added new log!")
    res.redirect('http://localhost/drt/pages/Reviewer/reviewerHome.php');

  });


});


app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

