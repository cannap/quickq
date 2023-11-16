import {test} from './src/test'

const server = Bun.serve({
    port: 3000,
    fetch(request) {
        return new Response(test);
    },
});

console.log(`Listening on localhost22fefe test: ${server.port}`);