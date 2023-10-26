import {createWriteStream, write} from 'fs'
// fs is file system module{using for read/write file/directory, create folder, and etc.}
const writeStream = createWriteStream('filewritten.txt');

export function emitWrite() {
  // emitData() is not normal function anymore, become promise fn, so need to call as await in main.js
  return new Promise((resolve, reject)=> {
    for(let count = 0; count <= 10; count++){
      writeStream.write(`data-${count}\r\n`);
      console.log('write => ', `data-${count}`);
    }
    writeStream.end();
    writeStream.on('finish', () => {
      console.log('Data has been written to filewritten.txt');
    });
  })
}