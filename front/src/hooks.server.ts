import type { HandleFetch } from '@sveltejs/kit';
const apiUrl = import.meta.env.VITE_BASE_API;

export const handleFetch: HandleFetch = async ({ request, fetch }) => {
	const originalUrl = new URL(request.url);
	if (request.url.includes('localhost')) {
		// clone the original request, but change the URL
		const path = originalUrl.pathname;
		const searchParams = originalUrl.search;

		const newUrl = new URL(`${apiUrl}${path}${searchParams}`);
		request = new Request(newUrl.toString(), request);
	}
	console.log(request);
	return fetch(request);
};
