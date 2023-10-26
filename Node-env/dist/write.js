"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.emitWrite = emitWrite;
var _fs = require("fs");
// fs is file system module{using for read/write file/directory, create folder, and etc.}
var writeStream = (0, _fs.createWriteStream)('filewritten.txt');
function emitWrite() {
  // emitData() is not normal function anymore, become promise fn, so need to call as await in main.js
  return new Promise(function (resolve, reject) {
    for (var count = 0; count <= 10; count++) {
      writeStream.write("data-".concat(count, "\r\n"));
      console.log('write => ', "data-".concat(count));
    }
    writeStream.end();
    writeStream.on('finish', function () {
      console.log('Data has been written to filewritten.txt');
    });
  });
}