const express= require("express");
const app= express();
var fs=require("fs");
const server=  require('https').createServer( {
    key:fs.readFileSync("/etc/nginx/ssl/digimonk.co.key"),
    cert:fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.crt"),
    ca:[fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.pem"),
        fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.pem")]
});
const io = require("socket.io").listen(server)
const port= 5555;
        io.on("connection", socket => {
            console.log("a user connected");
            socket.on("chat_message", msg => {
                console.log(msg)
                io.emit("chat message", msg);
            })
        });

    server.listen(port, ()=> console.log("server running on " +port));

// const express= require("express");
// const app= express();
// const fs=require("fs");
// //const server= require("http").createServer(app);
// const server  = require('https').createServer( {
//         key:fs.readFileSync("/etc/nginx/ssl/digimonk.co.key"),
//         cert:fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.crt"),
//         ca:[fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.pem"),
//             fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.pem")]
//     });
// const io = require("socket.io").listen(server)
// const port= 9999;
//         io.on("connection", socket => {
//             console.log("a user connected");
//             // socket.on("chat_message", message => {
//             //     console.log(message)
//             //     io.emit("chat_message", msg);
//             // })
            
//               socket.on( 'chat_message', function( data ) {
//                 console.log(data)
//                 io.sockets.emit( 'chat_message', {
//                   chat_from:data.chat_from,
//                   chat_to:data.chat_to,
//                   chat_text:data.chat_text,
//                   chat_time:data.chat_time
//                 });
//               });

//                     });

//     server.listen(port, ()=> console.log("server running on " +port))



// var socket  = require( 'socket.io' );
// var express = require('express');
// var app     = express();
// var fs=require("fs");
// // var server  = require('https').createServer(app);
// var server  = require('https').createServer( {
//         key:fs.readFileSync("/etc/nginx/ssl/digimonk.co.key"),
//         cert:fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.crt"),
//         ca:[fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.pem"),
//             fs.readFileSync("/etc/nginx/ssl/digimonk.co.chained.pem")]
//     });
// var io      = socket.listen( server );
// var port    = process.env.PORT || 2200;

// server.listen(port, function () {
//   console.log('Server listening at port %d', port);
// });

// var clients = 0;

// io.on('connection', function (socket) {
// console.log("a user connected");
// clients++;
//    io.sockets.emit('broadcast',{ status: clients + ' clients connected!'});
// socket.on('disconnect', function () {
//       clients--;
//       io.sockets.emit('broadcast',{ status: clients + ' clients connected!'});
//    });
 

//   socket.on( 'chat_message', function( data ) {
//     console.log(data)
//     io.sockets.emit( 'chat_message', {
//       chat_from:data.chat_from,
//       chat_to:data.chat_to,
//       chat_text:data.chat_text,
//       chat_time:data.chat_time
//     });
//   });

  
// });
