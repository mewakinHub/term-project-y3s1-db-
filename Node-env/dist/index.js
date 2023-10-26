"use strict";

var _fs = require("fs");
// fs is file system module{using for read/write file/directory, create folder, and etc.}
var writeStream = (0, _fs.createWriteStream)('filewritten.txt');
var count = 1;
for (var _count = 0; _count <= 10; _count++) {
  writeStream.write("data-".concat(_count, "\r\n"));
  console.log('write => ', "data-".concat(_count));
}
writeStream.end();
writeStream.on('finish', function () {
  console.log('Data has been written to filewritten.txt');
});

// setInterval keep log count=1 until `ctrl c` but no write file(why?)
// setInterval(() => {
//     writeStream.write(`data-${count}\r\n`);
//     console.log('write => ', `data-${count}`);
// }, 1000);

// writeStream.write('data for write-1\r\n');
// writeStream.write('data for write-2\r\n');
// writeStream.write('data for write-3\r\n');
/* \r (Carriage Return) → moves the cursor to the beginning of the line without advancing to the next line
// \n (Line Feed) → moves the cursor down to the next line without returning to the beginning of the line — In a *nix environment \n moves to the beginning of the line.
 \r\n (End Of Line) → a combination of \r and \n */
// <br> is only html while \n is in js. <br> only works on content being appended to a webpage. Its the webpage that sees <br> as a new line. \n will be a new line if you console.log the string.
// `\r\n` is for Window system File