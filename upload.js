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
      connection.query('INSERT INTO document (documentName, documentFile,documentStatus,userid,officeid) values (?,?,?,?,?)',[req.body.title, file.filename, 'pending', req.body.uid, req.body.office], (err, rows, fields) => {

        if (err) throw err
        
        console.log("Inserted file "+file.filename)

      })
    });

    next();
});
};

module.exports = uploadMiddleware;