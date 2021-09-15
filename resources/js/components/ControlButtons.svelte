<script>
import { orderListStore, lastOrderListStore, posStatusStore } from './stores.js'; 
import { lastTotalStore, totalStore } from './stores.js'; 
import {articleListStore} from './stores/articleList/store.js';

import { getNewInvoice } from './handler.js';
import { saveJournal, updateInvoice } from './handler.js';
import { controllButtonStore}  from './stores/controllButtons/store.js';
import Modal from './Modal.svelte';

import { onMount, onDestroy } from "svelte";
//import Error from './Error.svelte';


let orderList = [];
let total = 0;
let lastTotal = 0;
let invoice = [];
let response = "";
let showModal = false;
let lastOrderList = [];
let posStatus = ""; //closed
let controllButtonList = [];

export let invoiceId = 0;

let articleList = [];
console.log("anfang: ",articleList);

onMount(async () => {
    invoiceId = await getNewInvoice();
    console.log("new invoice: " , invoiceId);
    articleList = $articleListStore;

});


const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });

const unsubscribelastorderlist = lastOrderListStore.subscribe(value => {
   lastOrderList = value;
});
//const unsubscribePosStatus = posStatusStore.subscribe(value => {
//   posStatus = value;
//});
function getInvoiceNumber(){
   console.log("function getInvoiceNumber");
    return getNewInvoice()
    .then(res => {
       invoiceId = res;
       console.log("invoiceId handleClick: ",invoiceId,"showModal: ", showModal);
       if( invoiceId < 0){
          showModal = true;
       }
    })
   
}

function saveData(dest){
   if(orderList.length == 0){
      console.log("leer");
   }else{ 
   invoice = [];
    orderList.forEach(item => {
       const invoiceItem = articleList.find(article => item.id == article.id);
       invoiceItem.quantity = item.quantity;
       invoice.push(invoiceItem);
       response = saveJournal(invoiceItem, invoiceId);
       //if(invoiceItem.combi !== null){
       //   invoiceItem.combi.forEach(element => {
       //      console.log(element); //Kombiartikel abarbeiten
             
       //   });
       //}
       });
       
    lastOrderListStore.set(orderList);   
    orderList = [];
    orderListStore.set(orderList);
    lastTotal = $totalStore;

    lastTotalStore.set(lastTotal);
    updateInvoice(invoiceId, $totalStore); 
    getInvoiceNumber();
    totalStore.update(n => n = 0);
   }
}

 function handleClick(dest){
    console.log("Dest: ",dest);
   if(invoiceId < 0){
      getInvoiceNumber()
      .then(() => {
         saveData(dest);
      });
   }else{
      saveData(dest);
   } 

}  

</script>
{#each $controllButtonStore as button}

{button[0].name}

{/each}

<input type="button" on:click={handleClick} value="Enter" />
<input type="button" on:click={() => handleClick("close")} value="Close" />

{#if showModal}

	<Modal on:close="{() => showModal = false}">
		<h2 slot="header">  Error		</h2>


	</Modal>
{/if}
