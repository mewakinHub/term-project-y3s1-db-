"use strict";

var _fs = require("fs");
var _zlib = require("zlib");
//build-in fn. to create file zip

var readMyProfileStream = (0, _fs.createReadStream)('profile.jpg');
var writeMyProfileStream = (0, _fs.createWriteStream)('profile-Compression.gz');
readMyProfileStream.pipe(
//data transformation btw stream and stream
(0, _zlib.createGzip)({
  flush: 0 //clear pipe
})).pipe(writeMyProfileStream).on('finish', function () {
  //check whether finish or not?
  console.log('compressed finished!');
  readMyProfileStream.close();
});