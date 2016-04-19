var http = require('http');
var irc = require('irc');

var client = new irc.Client('irc.7chan.org', 'd[^_^]b', {
    autoConnect: false
});
client.connect(5, function(input) {
    console.log("Connected!");
    client.join('#radio', function(input) {
        console.log("Joined #radio");
        client.say('#radio', "Oh, Hey, I'm back!");
    });
});

client.addListener('pm', function (from, text) {
    console.log("[PM] - " + from + ': ' + text);
    client.say(from, text);
    if(text.indexOf('die') !== -1) {
        client.disconnect("Goodbye, cruel world!", function() {
            console.log("YOLO");
        });
    }
});

client.addListener('message', function (from, to, text) {
    console.log(from + ' => ' + to + ': ' + text);
});