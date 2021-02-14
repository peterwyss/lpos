<script>
  import { orderListStore } from "./stores.js";
  import { totalStore } from "./stores.js";
  import { lastTotalStore } from "./stores.js";

  let total = 0;
  let lastTotal = 0;

  export let orderElement;

  //const unsubscribeOrderlist = orderListStore.subscribe(value => {
  //  orderList = value;
  //});
  //const unsubscribetotal = totalStore.subscribe(value => {
  //  total = value;
  //});
  //const unsubscribelasttotal = lastTotalStore.subscribe(value => {
  //  lastTotal = value;
  //});

  //$: {
  //  total = 0;
  //  $orderListStore.forEach((element, i) => {
  //    total = total + element.quantity * element.price;
  //    totalStore.set(total);
  //  });
 // }
  console.log("Last total: ",lastTotal);
</script>

{#if $totalStore === 0}

<div class="row">
  <div class=" col "><h1>Total:</h1></div>
  <div class="col"><h1> {$lastTotalStore.toFixed(2)}</h1></div>
</div>
{:else}
<div class="row">
<div class=" col "><h1>{orderElement.name}</h1></div> 
<div class=" col "><h1>{$totalStore.toFixed(2)}</h1></div>
</div>

{/if}
