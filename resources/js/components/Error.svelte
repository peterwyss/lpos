<script>
import Modal from './Modal.svelte';

export let showModal = false;
</script>

TEST {showModal}
{#if showModal}

	<Modal on:close="{() => showModal = false}">
		<h2 slot="header">  Error		</h2>


	</Modal>
{/if}
