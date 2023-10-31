<script lang="ts">
	import { db } from '$lib/database';
	import { liveQuery } from 'dexie';
	import type { PageData } from './$types';

	export let data: PageData;
	let users = liveQuery(() => db.users.toArray());
	const addUser = async () => {
		try {
			const id = await db.users.add({
				email: 'yo',
				name: 'Marko'
			});
		} catch (error) {}
	};
</script>

{JSON.stringify(data)}
