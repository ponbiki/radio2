var config = {
    channels: ["#radio"],
    server: "irc.7chan.org",
    botName: "d[^_^]b",
    userName: "techno_viking",
    realName: "T-1000",
    autoConnect: false,
    autoRejoin: true
};

var irc = require("irc");

var bot = new irc.Client(config.server, config.botName, {
    userName: config.userName,
    realName: config.realName,
    channels: config.channels,
    autoConnect: config.autoConnect,
    autoRejoin: config.autoRejoin
});

bot.connect(5, function(input) {
    console.log("Connected to!");
    for (var channel in config.channels) {
        bot.join(config.channels, function(input) {
            console.log("Joined #radio");
            bot.say('#radio', "I like hipster music!");
        });
    }
});