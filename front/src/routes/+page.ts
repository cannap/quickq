import type { PageLoad } from './$types';

export const load: PageLoad = async ({ params, fetch }) => {
	//here i want o add a base api endpoint without writting it every time any ideas?
	const res = await fetch(`/json/`);
	const item = await res.json();
	console.log(item);
	return {
		...item
	};
};
