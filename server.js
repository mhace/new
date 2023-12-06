const app = require("./src/app");
const http = require("http");

const server = http.createServer(app);

server.listen(3000, function () {
    console.log("App is listening on port 3000");
});
