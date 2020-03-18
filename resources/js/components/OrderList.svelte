<script>
  import { articleListStore } from './stores.js';
  import { orderListStore } from './stores.js';
	import { beforeUpdate, onMount  } from "svelte";
  let invoiceId = 0;
  let orderList = [];
  let sortedOrderList = [];
  
  const unsubscribe = orderListStore.subscribe(value => {
	orderList = value;
  });

  onMount(() => {
    console.log("OrderList mounted");

  });

	async function newInvoice(){
          const response = await axios({
			    url: "/invoice/store",
				method: 'POST',
				params: {
					'status' : 1,
					'sum' : 0
				}

			});
      invoiceId = response.data.invoiceId;	
      console.log("invoiceId: ", invoiceId);

  }

beforeUpdate(() =>{
  sortOrderList(orderList);
})


/* Sortiert die Artikel nach id */

export function sortOrderList(){

  sortedOrderList = [];
  console.log( " sortedOrderList: ", sortedOrderList);
  orderList.forEach((element,i) => {
    if(sortedOrderList.length == 0){
      sortedOrderList =  newElement(element,sortedOrderList);
    }else{
      var exist = findElement(element);
      console.log("exist: ", exist);
      if(exist < 0 || sortedOrderList[exist].group == 0){
        sortedOrderList =  newElement(element,sortedOrderList);
      }else{
        sortedOrderList[exist].quantity++;
      }
    }
  });
    console.log(" sortedOrderList: ", sortedOrderList );

}
function newElement(element,sortedOrderList){
  element.quantity = 1;
  sortedOrderList = [...sortedOrderList, element];
  return sortedOrderList;
}

function findElement(nElement){
  var ex = -1;
  sortedOrderList.forEach((element,i) =>{
      if(nElement.id === element.id){
          ex =  i;
         }
  });
  return ex;
} 
function handleDblClick(index){
  console.log("doppelclick ",index);
  sortedOrderList[index].group = 0;
}

</script>


<ul class="list-group">
<button on:click={() => sortOrderList()}>click</button>

  {#each sortedOrderList as element,index}
    <li class="list-group-item" on:dblclick={() => handleDblClick(index)}>{element.quantity} {element.name} {element.price}</li>
  {/each}
</ul>