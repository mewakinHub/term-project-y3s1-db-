"use strict";

var _fs = require("fs");
var readStream = (0, _fs.createReadStream)('filewritten.txt');
readStream.on('data', function (data) {
  console.log('Data => ', data.toString());
});
readStream.on('end', function () {
  console.log('Data has been read from filewritten.txt');
});

// readStream.close(); // Uncomment this line to trigger the 'finish' event.