<script>
import { orderListStore } from './stores.js'; 
import { totalStore } from './stores.js'; 
import { lastTotalStore } from './stores.js'; 
import { getNewInvoice } from './handler.js';
import { saveJournal } from './handler.js';
import Modal from './Modal.svelte';

import { onMount } from "svelte";
//import Error from './Error.svelte';

export let articleList;



let orderList = [];
let total = 0;
let lastTotal = 0;
let invoice = [];
let response = "";
let showModal = false;

export let invoiceId = 0;

onMount(async () => {
    invoiceId = await getNewInvoice();
    console.log("new invoice: " , invoiceId);
});

const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });
const unsubscribetotal = totalStore.subscribe(value => {
   total = value;
});
const unsubscribelasttotal = lastTotalStore.subscribe(value => {
   lastTotal = value;
});

async function getInvoiceNumber(){
    invoiceId =   await getNewInvoice();
    console.log("invoiceId handleClick: ",invoiceId,"showModal: ", showModal);
       if( invoiceId < 0){
          showModal = true;
   }
}


 function handleClick(){
   if(getInvoiceNumber < 0){
      getInvoiceNumber();
   } 
   if(orderList.length == 0){
      console.log("leer");
   }else{ 
   invoice = [];
    orderList.forEach(item => {
       console.log(item)
       const invoiceItem = articleList.find(article => item.id == article.id);
       invoiceItem.quantity = item.quantity;
       console.log(invoiceItem);
       invoice.push(invoiceItem);
       console.log(invoice);
       
       response = saveJournal(invoiceItem, invoiceId);
       console.log("response after saveJournal:" ,response);


       });
    orderList = [];
    orderListStore.set(orderList);
    lastTotal = total;
    console.log("Total: ",total);

    console.log("lastTotal: ",lastTotal);
    lastTotalStore.set(lastTotal);
    getInvoiceNumber();
   }
}  
</script>


<input type="button" on:click={handleClick} value="Enter" />
{#if showModal}

	<Modal on:close="{() => showModal = false}">
		<h2 slot="header">  Error		</h2>


	</Modal>
{/if}
