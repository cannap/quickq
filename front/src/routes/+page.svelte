<script lang="ts">
	import { db } from '$lib/database';
	import { liveQuery } from 'dexie';
	import type { PageData } from './$types';
	import Button from '$lib/components/ui/button/button.svelte';

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

<Button variant="success">Tefeddwdwdwdfst</Button>
