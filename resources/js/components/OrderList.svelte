<script>
  import { articleListStore } from './stores.js';
  import { orderListStore } from './stores.js'; 
  import { beforeUpdate, onMount  } from "svelte";
  import { testFunc } from './ArticleButtons.svelte';
	import Modal from './Modal.svelte';

  	let showModal = false;

  //let invoiceId = 0;
  let orderList = [];
  let elementToEdit = {};
  let addText = "";
  const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });
  
 
/*
 $: {
   console.log("reactive: ", orderList)
   orderList = rawOrderList.slice();
   let elem = orderList.slice(0,1);
   console.log("elem: ",elem);
   elem.quantity = 1;
   console.log("elem: ",elem," orderList: ", orderList, "rawOrderList: ", rawOrderList);
   sortedOrderList = sortOrderList(orderList);
   console.log(sortedOrderList);

   } 
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
function editElement(index) {
  console.log("index: ",index, " orderlist.element ", orderList[index]);
  elementToEdit = orderList[index];
  showModal = true;
  
}
function handleChange(e){
  console.log(e.target.value);
}
</script>

<ul class="list-group">
  {#each orderList as element,index}
    <li class="list-group-item" on:dblclick={() => handleDblClick( index)}>
        {element.quantity} {element.name} {element.price.toFixed(2)} <b>{(element.quantity * element.price).toFixed(2)}</b>
        <button type='button' class='btn btn-info' on:click={() => increment(index)}>+</button>
        <button type='button' class='btn btn-info' on:click={() => decrement(index)}>-</button>
        <button type='button' class='btn btn-info' on:click={() => deleteElement(index)}>Delete</button>
        <button type='button' class='btn btn-info' on:click={() => editElement(index)}>Edit</button>
        
    
    </li>
  {/each}
</ul>
<button on:click="{() => showModal = true}">
	show modal
</button>
{#if showModal}
	<Modal on:close="{() => showModal = false}">
		<h2 slot="header">
			{elementToEdit.name}
		</h2>
    <p>{addText}</p>
  <input type="number" value="{elementToEdit.quantity}" on:change="{handleChange}" max="{elementToEdit.quantity}"/>
  <input type="text" on:change="{handleChange}" bind:value={addText}/>
		

	</Modal>
{/if}