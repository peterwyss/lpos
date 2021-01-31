<script>
  import { orderListStore } from "./stores.js";
  import { totalStore } from "./stores.js";
  import { lastTotalStore } from "./stores.js";

  let orderList = [];
  let total = 0;
  let lastTotal = 0;

  export let orderElement;

  const unsubscribeOrderlist = orderListStore.subscribe(value => {
    orderList = value;
  });
  const unsubscribetotal = totalStore.subscribe(value => {
    total = value;
  });
  const unsubscribelasttotal = lastTotalStore.subscribe(value => {
    lastTotal = value;
  });

  $: {
    total = 0;
    orderList.forEach((element, i) => {
      total = total + element.quantity * element.price;
      totalStore.set(total);
    });
  }
  console.log(lastTotal);
</script>

{#if total === 0}
  <h1>Total: {lastTotal.toFixed(2)}</h1>
{:else}
  <h1>{orderElement.name} {total.toFixed(2)}</h1>
{/if}
