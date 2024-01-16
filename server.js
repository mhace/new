const bodyParser = require('body-parser');
const express = require('express');
var session = require('express-session')
const path = require('path');
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

app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true,
  // cookie: { secure: false }
}));
app.use(bodyParser.urlencoded({ extended: true }));

app.use(express.static('css'));
app.use(express.static('img'));

app.set('views', path.join(__dirname, 'views'))
app.set('view engine', 'ejs')

app.get('/authenticate', (req, res) => {
  if ( typeof req.session.uid === 'undefined' && req.query.uid ){
    
    req.session.regenerate(function (err) {
      if (err) next(err)
      req.session.uid = req.query.uid;

      req.session.save(function (err) {
        if (err) return next(err)
        res.redirect('/requester')
      })
    })
    
  } else {
    res.redirect('http://localhost:3000/logout');
  }
});

app.get('/requester', (req, res) => {

  if ( typeof req.session.uid === 'undefined'){
    res.redirect('http://localhost:3000/logout');
  } else {
    const session_id = req.session.uid;
    const query = "SELECT document.*, officeName , comment FROM document \
                  INNER JOIN offices on document.officeid = offices.officeID \
                  WHERE document.userid = ?";

    connection.query(query, [session_id], (err, result) => {
      if (err) throw err

      res.render('requester', {data: result, session_id: session_id});
    });
  }
});

app.get('/uploadDocu', (req, res) => {
  if ( typeof req.session.uid === 'undefined'){
    res.redirect('http://localhost:3000/logout');
  } else {
    const session_id = req.session.uid;
    res.render('uploadDocu', {session_id: session_id});
  }

  
});

app.post('/upload', uploadMiddleware, (req, res) => {
  res.redirect('/requester');
});

app.get('/download', function(req, res){
  var filename = req.query.filename

  if (filename) {
    const file = `${__dirname}/uploads/`+ filename;
    res.download(file);
  }
  
});

app.post('/editupload', edituploadMiddleware, (req, res) => {
  res.redirect('/requester');
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

app.get('/logout',  (req, res) => {
  req.session.destroy();
  res.redirect('http://localhost/drt/php/logout.php');  
});


app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

