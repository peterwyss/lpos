<script>
import { orderListStore } from './stores';
import {articleListStore} from './stores/articleList/store.js';



export let filteredArticleList;
export let addArticle;

export let orderList = [];
let articleList = [];


const unsubscribe = articleListStore.subscribe(value => {
	articleList = value;
  });

const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });



</script>

{#each filteredArticleList as button}
    <input type="button" value="{button.name}" on:click|preventDefault={() => addArticle(button.reference)}/>
{/each}  