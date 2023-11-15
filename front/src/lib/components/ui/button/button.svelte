<script lang="ts">
	import { tv } from 'tailwind-variants';
	export let variant: 'secondary' | 'primary' | 'success' | 'danger' = 'secondary';
	const buttonVariants = tv({
		base: 'px-4 py-2 border rounded-lg shadow text-white font-medium focus:outline-none focus:ring-2 focus:ring-opacity-50 transition ease-in duration-150 text-center active:opacity-75',
		variants: {
			variant: {
				secondary: 'bg-blue-600 hover:bg-blue-700 border-blue-600 focus:ring-blue-500',
				primary: 'bg-indigo-600 hover:bg-indigo-700 border-indigo-600 focus:ring-indigo-500',
				success: 'bg-green-600 hover:bg-green-700 border-green-600 focus:ring-green-500',
				danger: 'bg-red-600 hover:bg-red-700 border-red-600 focus:ring-red-500'
			}
		}
	});
</script>

<button class={buttonVariants({ variant })} on:click type="button" {...$$restProps}><slot /></button
>
