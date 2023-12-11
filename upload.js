const multer = require('multer');
const fs = require('fs');
const path = require('path');

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
    next();
  });
};

module.exports = uploadMiddleware;