"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.emitData = emitData;
var _event = require("./event");
function emitData() {
  // emitData() is not normal function anymore, become promise fn, so need to call as await in main.js
  return new Promise(function (resolve, reject) {
    // setTimeout(() => {
    //     eventEmitter.emit('Mr.A', "Send data to Mr.A across module", Math.random());
    //     resolve(); //The Promise resolves after the event is emitted, indicating that the data has been sent.
    // }, 1000)
    // 1000ms = 1s before emit data      

    setInterval(function () {
      _event.eventEmitter.emit('Mr.A', "Send data to Mr.A across module", Math.random());
      resolve(); //The Promise resolves after the event is emitted, indicating that the data has been sent.
    }, 1000);
    // // keep sending to Mr.A channel every 1 sec
  });
}