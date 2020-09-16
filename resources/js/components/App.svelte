<script>
	import { onMount } from "svelte";
	import { articleButtonList } from './stores.js';
	import { articleLevelList } from './stores.js';
	import { articleListStore, posStatusStore} from './stores.js';
	import {orderListStore}  from './stores.js';
 	import ArticleButtons from './ArticleButtons.svelte';
	import OrderList from "./OrderList.svelte";
	import Display from "./Display.svelte";
	import ControlButtons from "./ControlButtons.svelte";


	let articleButtonData = [];    /* Die List mit allen Artikeln */
	let articleLevelData = [];     /* Die Liste mit allen Ebenen */
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

	let testFunc = () =>{
		console.log("TEST");
	}

	function addArticle(id){
	console.log(filteredArticleList);
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
		/*
		Hier das neue Element zur Orderlist hinzufügen.
		Ist Element vorhanden = orderElement.quantity += +
		sonst neues Element
		*/

		console.log("orderElement: " , orderElement);
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
        console.log("addarticle orderList: ",orderList);
        orderListStore.set(orderList)
	}
	function findElement(oElement){
        var ex = -1;
        orderList.forEach((element,i) =>{
            if(oElement.id === element.id && element.group === 1){
                ex =  i;
            }
		});
		console.log("findElement: " , ex);
        return ex;
	} 
function setLevel(level){
	articleLevel = level;
}	
</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card" >
					<Display  {orderElement}/>
					<ControlButtons {articleList} bind:invoiceId = {invoiceId}/>
					<div class="card-header">Test Component {invoiceId}</div>
					<div class="card-body">

					{#each articleLevelData as level}
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

