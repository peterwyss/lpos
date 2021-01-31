<script>
export let filteredArticleList;
export let addArticle;
</script>

{#each filteredArticleList as button}
    <input type="button" value="{button.name}" on:click|preventDefault={() => addArticle(button.reference)}/>
{/each}  