<script>
	import { onMount } from "svelte";
	import { articleButtonList } from './stores.js';
	import { articleLevelList } from "./stores/articleLevel/store.js";

	import {posStatusStore} from './stores.js';
	import {articleListStore} from './stores/articleList/store.js';
	import {orderListStore}  from './stores.js';
 	import ArticleButtons from './ArticleButtons.svelte';
	import OrderList from "./OrderList.svelte";
	import Display from "./Display.svelte";
	import ControlButtons from "./ControlButtons.svelte";



	let articleButtonData = [];    /* Die List mit allen Artikeln */
	let filteredArticleList = [];  /* Artikel nach Ebenen filtern */ 
	var articleLevel = 1;
	var invoiceId = 0;			   /* ID der aktuellen Rechnung */	
    var articles = [];
	var orderList = [];
	let orderElement = {};
	let articleList = {};
	let posStatus = "";


  const unsubscribe = orderListStore.subscribe(value => {
	orderList = value;
  });
  const unsubscribeArticleList = articleListStore.subscribe(value =>{
	  articleList = value;
  })
const unsubscribePosStatus = posStatusStore.subscribe(value => {
   posStatus = value;
});


	onMount(async () => {
	  /* Buttons aus der Datenbank holen */
        const resButton = await axios({
			    url: "/articleButton/index",
			    method: 'GET',
			});
			articleButtonData = resButton.data.articleButtonList;
			articleButtonList.set(articleButtonData);
			articles = $articleListStore[0];
			console.log("articles: ",articles);
	  /* Die Ebenen für das GUI */
        //const resLevel = await axios({
		//	    url: "/articleLevel/index",
		//	    method: 'GET',
		//	});
        //    articleLevelList.set(articleLevelData);
	  
	  
	/* Alle Artikel aus der Datenbank holen
        const resArticle = await axios({
			    url: "/article/index",
			    method: 'GET',
			});
			articles = resArticle.data.articleList;
			console.log("articles: ",articles);
			articleListStore.set(articles);
    */  
			filter(articleLevel);
			sortArticleButtons();

	});

	/* Neue Rechnung erzeugen -> in der Datenbank eintragen */

	/* Filter für die Ebenen zur Darstellung der Button */  
	function filter(aL){
		articleLevel = aL;
		filteredArticleList = articleButtonData.filter( item => item.level == articleLevel);
		console.log("Filtered: ",filteredArticleList);
		console.log("Level: ",articleLevel);
	}

	let testFunc = () =>{
		console.log("TEST");
	}

	function addArticle(id){
	console.log("ArticleList: ",filteredArticleList);
	    posStatusStore.set("open");
		const found = articles.find(element => element.id == id);
		console.log("found: ", found);
		console.log("found.id: ",found.id);
		orderElement = {
		  'quantity' : 1,
		  'id' : found.id,
		  'plu' : found.plu,
		  'name' : found.name,
		  'price' : found.price,
		  'addText'  : "",
		  'group' : 1
		}
		if(orderList.length == 0){
			orderList = [orderElement, ...orderList];
		}else{
			let exist = findElement(orderElement);
			if(exist < 0 ){
				orderList = [orderElement, ...orderList];

			}else if(orderList[exist].group === 1) {
				orderList[exist].quantity++;
			}

		}	
		orderListStore.set(orderList)

	}
	function findElement(oElement){
        var ex = -1;
        orderList.forEach((element,i) =>{
            if(oElement.id === element.id && element.group === 1){
                ex =  i;
            }
		});
        return ex;
	} 
function setLevel(level){
	articleLevel = level;
}	
function sortArticleButtons(){
  filteredArticleList.sort(function(a,b) {
    return a.position - b.position;
  });

	
}

</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card" >
					<Display  {orderElement}/>
					<ControlButtons  bind:invoiceId = {invoiceId}/>
					<div class="card-header">Test Component {invoiceId}</div>
					<div class="card-body">
					<button type="button"  class="btn btn-primary" on:click={setLevel}>Offen </button>

					{#each $articleLevelList as level}
					  <button type="button"  class="btn btn-primary" on:click={filter(level.id)}>{level.name} </button>
					{/each}  					

					<ArticleButtons {filteredArticleList} {addArticle} />
					<OrderList orderList={orderList} on:pressedEnter={testFunc}/>
					</div>
				</div>



	
			</div>
		</div>
	</div>



</main>

