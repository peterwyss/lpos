<script>
import { orderListStore } from './stores.js'; 
import { totalStore } from './stores.js'; 
import { lastTotalStore } from './stores.js'; 
import { getNewInvoice } from './handler.js';
import { saveJournal } from './handler.js';

import { onMount } from "svelte";

export let articleList;



let orderList = [];
let total = 0;
let lastTotal = 0;
let invoice = [];
let response = "";

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
    console.log("invoiceId handleClick: ",invoiceId)
}

 function handleClick(){
   invoice = [];
    orderList.forEach(item => {
       console.log(item)
       const invoiceItem = articleList.find(article => item.id == article.id);
       invoiceItem.quantity = item.quantity;
       console.log(invoiceItem);
       invoice.push(invoiceItem);
       console.log(invoice);
       
       response = saveJournal(invoiceItem, invoiceId);


       });
    orderList = [];
    orderListStore.set(orderList);
    lastTotal = total;
    console.log("Total: ",total);

    console.log("lastTotal: ",lastTotal);
    lastTotalStore.set(lastTotal);
    getInvoiceNumber();
}  
</script>


<input type="button" on:click={handleClick} value="Enter" />