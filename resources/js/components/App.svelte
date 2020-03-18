<script>
	import { onMount } from "svelte";
	import { articleButtonList } from './stores.js';
	import { articleLevelList } from './stores.js';
	import { articleListStore} from './stores.js';
	import ArticleButtons from './ArticleButtons.svelte';

	import OrderList, { sortOrderList } from "./OrderList.svelte";

	let articleButtonData = [];    /* Die List mit allen Artikeln */
	let articleLevelData = [];     /* Die Liste mit allen Ebenen */
	let filteredArticleList = [];  /* Artikel nach Ebenen filtern */ 
	var articleLevel = 1;
	var invoiceId = 0;			   /* ID der aktuellen Rechnung */	
    var articles = [];
	var orderList = [];
	var sortedList = [];



	onMount(async () => {
	  /* Buttons aus der Datenbank holen */
        const resButton = await axios({
			    url: "/articleButton/index",
			    method: 'GET',
			});
			articleButtonData = resButton.data.articleButtonList;
			articleButtonList.set(articleButtonData);
	  /* Die Ebenen für das GUI */
        const resLevel = await axios({
			    url: "/articleLevel/index",
			    method: 'GET',
			});
			articleLevelData = resLevel.data.articleLevelList;	
            articleLevelList.set(articleLevelData);
	  
	  
	/* Alle Artikel aus der Datenbank holen*/
        const resArticle = await axios({
			    url: "/article/index",
			    method: 'GET',
			});
			articles = resArticle.data.articleList;
			console.log("articles: ",articles);
			articleListStore.set(articles);

			filter(articleLevel);

	});

	/* Neue Rechnung erzeugen -> in der Datenbank eintragen */

	/* Filter für die Ebenen zur Darstellung der Button */  
	function filter(aL){
		articleLevel = aL;
		filteredArticleList = articleButtonData.filter( item => item.level == articleLevel);
		console.log("Filtered: ",filteredArticleList);
		console.log("Level: ",articleLevel);
	}
</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card" >
					<div class="card-header">Example Component {invoiceId}</div>
					<div class="card-body">

					{#each articleLevelData as level}
					  <button type="button"  class="btn btn-primary" on:click={filter(level.id)}>{level.name} </button>
					{/each}  					

					<ArticleButtons list={filteredArticleList} />
					<OrderList />
					</div>
				</div>



	
			</div>
		</div>
	</div>
</main>