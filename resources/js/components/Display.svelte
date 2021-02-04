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
  <h1>Total: {$lastTotalStore.toFixed(2)}</h1>
{:else}
  <h1>{orderElement.name} {$totalStore.toFixed(2)}</h1>
{/if}
