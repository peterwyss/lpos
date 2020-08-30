<script>
import { orderListStore } from './stores.js'; 


let orderList = [];
export let orderElement;

const unsubscribeOrderlist = orderListStore.subscribe(value => {
    orderList = value;
});
let total = 0;
$: {
    total = 0;
    orderList.forEach((element,i) => {
    total = total + (element.quantity * element.price);    


});
}
console.log(total)
</script>

<h1>{orderElement.name} {total.toFixed(2)} </h1>
