import { sveltekit } from '@sveltejs/kit/vite';
import { defineConfig } from 'vite';
import Icons from 'unplugin-icons/vite';
export default defineConfig({
	plugins: [sveltekit(), Icons({ compiler: 'svelte', autoInstall: true })],
	server: {
		host: '0.0.0.0',
		port: 5173,
		cors: true,
		watch: {
			usePolling: true
		},
		hmr: {
			host: 'localhost',
			port: 5173,
			protocol: 'ws'
		}
	}
});
