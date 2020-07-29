<script>
  import { articleListStore } from './stores.js';
  import { orderListStore } from './stores.js'; 
  import { beforeUpdate, onMount  } from "svelte";
  
  //let invoiceId = 0;
  export let orderList = [];
  let sortedOrderList = [];

  const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });
  
  onMount(() => {
    console.log("OrderList mounted");

  });
/*
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
*/

beforeUpdate(() =>{
  console.log("orderList beforupdate: ", orderList);
  sortedOrderList =   sortOrderList(orderList);
  console.log("sortedOrderList inside ", sortedOrderList)
})


/* Sortiert die Artikel nach id */

 function sortOrderList(orderList){
  sortedOrderList = [];
  let list = JSON.parse(JSON.stringify(orderList)); 
  console.log( " sortedOrderList: ", sortedOrderList);
  list.forEach((element,i) => {
    if(sortedOrderList.length == 0){
      let elem = list.slice(0,1)
      sortedOrderList =  newElement(elem[0]);
    }else{
      var exist = findElement(element);
      console.log("exist: ", exist);
      if(exist < 0 || sortedOrderList[exist].group == 0){
        let elem = list.slice(i,i+1);
        sortedOrderList =  newElement(elem[0]);
      }else{
        sortedOrderList[exist].quantity++;
      }
    }
  });
    console.log(" sortedOrderList: ", sortedOrderList, "list: ",  list, "orderList: ",orderList);
    return sortedOrderList;
}
function newElement(element){
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
  console.log(sortedOrderList[index].id," ",sortedOrderList[index].name);
}

function increment(i){
    console.log("element: ",sortedOrderList[i].plu);
    sortedOrderList[i].quantity += 1;
    orderListStore.set(sortedOrderList);

}
function decrement(i){
    console.log(i)
}
function deleteElement(i){
  console.log("delete: ", orderList," ",i, "plu: ", sortedOrderList[i].plu);
  let plu = sortedOrderList[i].plu;
  console.log("Länge: ",orderList.length);
    let index = 0;
    var l = orderList.length;
    for(index = l-1 ;index > -1 ; index--){
        console.log("index: ",index," l: ",l," sortedOrderlist.length: ", orderList.length);
        let elementPlu = orderList[index ].plu;  
            if(elementPlu == plu){
                orderList.splice(index,1)
             }
    }
    orderListStore.set(orderList);

}

</script>


<ul class="list-group">
  {#each sortedOrderList as element,index}
    <li class="list-group-item" on:dblclick={() => handleDblClick( index)}>
        {element.quantity} {element.name} {element.price}
        <button type='button' class='btn btn-info' on:click={() => increment(index)}>+</button>
        <button type='button' class='btn btn-info' on:click={() => decrement(index)}>-</button>
        <button type='button' class='btn btn-info' on:click={() => deleteElement(index)}>Delete</button>
        
    
    </li>
  {/each}
</ul>