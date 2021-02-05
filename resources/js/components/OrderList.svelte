<script>
  import { orderListStore, lastOrderListStore, posStatusStore } from './stores.js'; 
  import { beforeUpdate, onMount  } from "svelte";

import Modal from './Modal.svelte';

  	let showModal = false;

  //let invoiceId = 0;
  let orderList = [];
  let lastOrderList = [];
  let elementToEdit = {};
  let elementIndex = 0;
  let elementQuantity = 0;
  let addText = "";
  let posStatus = "";


  const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });
  
  const unsubscribeLastOrderlist = lastOrderListStore.subscribe(value => {
	lastOrderList = value;
  });
  
const unsubscribePosStatus = posStatusStore.subscribe(value => {
   posStatus = value;
});



function handleDblClick(index){
 
  console.log("doppelclick ",index);
  sortedOrderList[index].group = 0;
  console.log(sortedOrderList[index].id," ",sortedOrderList[index].name);
}

function increment(i){
    orderList[i].quantity++;
    orderListStore.set(orderList);

}
function decrement(i){
    console.log(i)
    orderList[i].quantity--;
    orderListStore.set(orderList);

}
function deleteElement(i){
    orderList.splice(i,1)
    orderListStore.set(orderList);

}
function editElement(index) {
  console.log("index: ",index, " orderlist.element ", orderList[index]);
  elementIndex = index;
  elementToEdit = orderList[index];
  elementQuantity = orderList[index].quantity;
  showModal = true;
  
}
function handleChange(e){
  console.log(e.target.value);
  //elementQuantity = orderList[elementIndex].quantity;
  //elementQuantity = e.target.value;
}
function handleChangeText(e) {
  console.log(e.target.value);
  addText = e.target.value;  
  orderElement.addText = e.target.value;
} 

function saveChange() {
      let el = orderList[elementIndex];
  		let orderElement = {
		  'quantity' : elementQuantity,
		  'id' : el.id,
		  'plu' : el.plu,
		  'name' : el.name,
		  'price' : el.price,
		  'addText'  : addText,
		  'group' : 0
    }
      console.log(elementQuantity," === " ,elementToEdit.quantity)

    if(elementQuantity === elementToEdit.quantity){
      orderList[elementIndex].group = 0;
      orderList[elementIndex].addText = addText;
    }else{
      orderList[elementIndex].quantity = orderList[elementIndex].quantity - elementQuantity;
      orderList = [...orderList,orderElement];
    }
    console.log("save: ", orderList);
    orderListStore.set(orderList);
    addText = "";

}

</script>
<h1>{posStatus}</h1>
<ul class="list-group">
  {#each orderList as element,index}
    <li class="list-group-item" on:dblclick={() => handleDblClick( index)}>
        {element.quantity} {element.name} {element.price.toFixed(2)} <b>{(element.quantity * element.price).toFixed(2)}</b><br/>
        {#if element.addText != ""}
        {element.addText}
        {/if}
        <button type='button' class='btn btn-info' on:click={() => increment(index)}>+</button>
        <button type='button' class='btn btn-info' on:click={() => decrement(index)}>-</button>
        <button type='button' class='btn btn-info' on:click={() => deleteElement(index)}>Delete</button>
        <button type='button' class='btn btn-info' on:click={() => editElement(index)}>Edit</button>
        
    
    </li>
  {/each}
</ul>

{#if posStatus == 'closed'}
  {#each lastOrderList as element}

  <p>{element.name}</p>
    
  {/each}
{/if}

{#if showModal}
	<Modal on:close="{() => showModal = false}">
		<h2 slot="header">
			{elementToEdit.name} 
		</h2>
    <p>{addText}</p>
  <input type="number"  on:change="{handleChange}" max="{elementToEdit.quantity}" bind:value="{elementQuantity}"/>
  <input type="text" on:change="{handleChangeText}" bind:value={addText}/>
	<input type="button" on:click={saveChange} value="Speichern" />	

	</Modal>
{/if}