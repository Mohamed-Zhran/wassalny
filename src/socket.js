import { createClient } from 'redis';
import { Server } from "socket.io";
const io = new Server();
const client = createClient({
    url: 'redis://@redis:6379'
});

client.on('error', err => console.log('Redis Client Error', err));
await client.connect();
await client.subscribe('laravel_database_chat-room', (message, channel) => {
    console.log(message, channel);
    const msg = JSON.parse(message);
    io.emit('chat', msg.data.message)
});

io.listen(3000);
