var config = {
    channels: ["#radio"],
    server: "irc.7chan.org",
    botName: "d[^_^]b",
    userName: "techno_viking",
    realName: "T-1000",
    autoRejoin: true
};

var irc = require("irc");

var bot = new irc.Client(config.server, config.botName, {
    userName: config.userName,
    realName: config.realName,
    channels: config.channels
});
