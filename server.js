
var express = require('express')
var app = express()

const port = 3000;

app.get('/', (req, res) => {
  res.send('Welcome to my server!');
});
app.get('/test', (req, res) => {
    res.send('Welcome tthis is the testo my server!');
  });

  app.get('/armpit', (req, res) => {
    res.send('edi wow!');
  });
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});