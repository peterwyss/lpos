<script>
export let articleButtonData;
export let addArticle;
</script>

{#each articleButtonData as button}
    <input type="button" value="{button.name}" on:click|preventDefault={() => addArticle(button.reference)}/>
{/each}  