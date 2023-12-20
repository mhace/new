const multer = require('multer');
const fs = require('fs');
const path = require('path');
const mysql = require('mysql')
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'teamtwoone-final'
})

const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, 'uploads/');
  },
  filename: (req, file, cb) => {
    cb(null, Date.now() + '-' + file.originalname);
  }
});

const upload = multer({ storage: storage });

const uploadMiddleware = (req, res, next) => {
  upload.array('files', 5)(req, res, (err) => {
    const files = req.files;
    req.files = files;
    connection.connect()

    files.forEach((file) => {
      connection.query('UPDATE document set documentFile=?, documentStatus=? where documentID=?',[file.filename, 'pending', req.body.id], (err, rows, fields) => {

        if (err) throw err
        
        console.log("Inserted file "+file.filename)

        action = "reuploaded a document"
        data = {
          "filename": file.filename,
          "title": req.body.title
        }

        connection.query('INSERT INTO logs (event,data,uid) values (?,?,?)',[action, JSON.stringify(data), req.body.uid], (err, rows, fields) => {

          if (err) throw err
          
        });

      })
    });

    next();
});
};

module.exports = uploadMiddleware;