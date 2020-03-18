<script>
import { orderListStore } from './stores';
import { articleListStore} from './stores';


export let list;

let orderList = [];
let articleList = [];

const unsubscribe = articleListStore.subscribe(value => {
	articleList = value;
  });

async function addArticle(id){
    console.log(articleList);
		const found = articleList.find(element => element.id == id);
		console.log("found: ", found);
		console.log("found.id: ",found.id);
		let orderElement = {
		  'quantity' : 0,
		  'id' : found.id,
		  'plu' : found.plu,
		  'name' : found.name,
		  'price' : found.price,
		  'addText'  : "",
		  'group' : 1
		}
		console.log("orderElement: " , orderElement);
		orderList = [orderElement, ...orderList];
        console.log("addarticle orderList: ",orderList);
        orderListStore.set(orderList)
	}


</script>

{#each list as button}
    <input type="button" value="{button.name}" on:click|preventDefault={() => addArticle(button.reference)}/>
{/each}  