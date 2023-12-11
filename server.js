const express = require('express')
const uploadMiddleware = require('./upload');
var app = express()
const port = 3000;

const upload = require('./upload');

app.get('/', (req, res) => {
  console.log(__dirname)
  res.sendFile(__dirname+"/pages/test_upload.html")
});

app.post('/upload', uploadMiddleware, (req, res) => {
  res.json({ message: 'File uploaded successfully!' });
});


app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});