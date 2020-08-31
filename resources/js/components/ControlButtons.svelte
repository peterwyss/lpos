<script>
import { orderListStore } from './stores.js'; 
import { totalStore } from './stores.js'; 
import { lastTotalStore } from './stores.js'; 




let orderList = [];
let total = 0;
let lastTotal = 0;

const unsubscribeOrderlist = orderListStore.subscribe(value => {
	orderList = value;
  });
const unsubscribetotal = totalStore.subscribe(value => {
   total = value;
});
const unsubscribelasttotal = lastTotalStore.subscribe(value => {
   lastTotal = value;
});

function handleClick(){
    orderList.forEach(item => console.log(item));
    orderList = [];
    orderListStore.set(orderList);
    lastTotal = total;
    console.log("Total: ",total);

    console.log("lastTotal: ",lastTotal);
    lastTotalStore.set(lastTotal);
}  
</script>


<input type="button" on:click={handleClick} value="Enter" />