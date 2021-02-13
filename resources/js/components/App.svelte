<script>
  import { onMount } from "svelte";
  import { articleButtonList } from "./stores.js";
  import { articleLevelList } from "./stores/articleLevel/store.js";

  import { posStatusStore } from "./stores.js";
  import { articleListStore } from "./stores/articleList/store.js";
  import { postingPeriod } from "./stores/postingPeriod/store.js";

  import { orderListStore, totalStore } from "./stores.js";
  import ArticleButtons from "./ArticleButtons.svelte";
  import OrderList from "./OrderList.svelte";
  import Display from "./Display.svelte";
  import ControlButtons from "./ControlButtons.svelte";
  import { updateData } from "./stores.js";

  let articleButtonData = []; /* Die List mit allen Artikeln */
  let filteredArticleList = []; /* Artikel nach Ebenen filtern */
  var articleLevel = 1;
  var invoiceId = 0; /* ID der aktuellen Rechnung */
  var orderList = [];
  let orderElement = {};
  let articleList = {};
  let posStatus = "";
  let prev_page;
  let next_page;
  let postingPeriodVar;

  const unsubscribe = orderListStore.subscribe(value => {
    orderList = value;
  });
  //const unsubscribeArticleList = articleListStore.subscribe(value => {
  //  articleList = value;
  //});
  const unsubscribePosStatus = posStatusStore.subscribe(value => {
    posStatus = value;
  });

  onMount(async () => {
    /* Buttons aus der Datenbank holen */
    const resButton = await axios({
      url: "/articleButton/index/" + articleLevel,
      method: "GET"
    });
    console.log("resButton: ", resButton);
    articleButtonData = resButton.data.articleButtonList.data;
    console.log("articleButtonData: ", articleButtonData);
    articleButtonList.set(articleButtonData);
    let current_page = resButton.data.articleButtonList.current_page;
    console.log("current_page: ", typeof current_page, " ", current_page);

    next_page = current_page + 1;
    console.log("next_page: ", next_page);
    sortArticleButtons();
    postingPeriodVar = $postingPeriod.postingPeriod.id;
  });

  /* Neue Rechnung erzeugen -> in der Datenbank eintragen */

  /* Filter für die Ebenen zur Darstellung der Button */

  async function filter(aL, param = 0) {
    console.log("Function filter: al=", aL, " param=", param);

    let url = "/articleButton/index/" + aL + "?page=" + param;
    console.log(url);
    const resButton = await axios({
      url: url,
      method: "GET"
    });
    articleButtonData = resButton.data.articleButtonList.data;
    articleLevel = aL;
    console.log("articleButtonData: ", articleButtonData);
    articleButtonList.set(articleButtonData);
    sortArticleButtons();
  }

  let testFunc = () => {
    console.log("TEST");
  };

  function addArticle(id) {
    posStatusStore.set("open");
    const found = $articleListStore.find(element => element.id == id);
    console.log("$articleListStore: ", $articleListStore);
    console.log("found: ", found);
    console.log("found.id: ", found.id);
    orderElement = {
      quantity: 1,
      id: found.id,
      plu: found.plu,
      name: found.name,
      price: found.price,
      addText: "",
      group: 1
    };
    totalStore.update(n => n + found.price);

    if (orderList.length == 0) {
      orderList = [orderElement, ...orderList];
    } else {
      let exist = findElement(orderElement);
      if (exist < 0) {
        orderList = [orderElement, ...orderList];
      } else if (orderList[exist].group === 1) {
        orderList[exist].quantity++;
      }
    }
    orderListStore.set(orderList);
  }
  function findElement(oElement) {
    var ex = -1;
    orderList.forEach((element, i) => {
      if (oElement.id === element.id && element.group === 1) {
        ex = i;
      }
    });
    return ex;
  }
  function setLevel(level) {
    articleLevel = level;
  }
  function sortArticleButtons() {
    filteredArticleList.sort(function(a, b) {
      return a.position - b.position;
    });
  }
  function scroll(e) {
    console.log(e);
  }
</script>


<main>
  <div class="container">
    <div class="row">
      <div class="col-sm">
{postingPeriodVar}
        <Display {orderElement} />
        <ControlButtons bind:invoiceId />
        <button type="button" class="btn btn-primary" on:click={setLevel}>
          Offen
        </button>

        {#each $articleLevelList as level}
          <button
            type="button"
            class="btn btn-primary"
            on:click={filter(level.id, 1)}>
            {level.name}
          </button>
        {/each}

        <div
          style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;
          grid-gap: 1em">
          {#if prev_page}
            <button on:click={(articleLevel, next_page)}>Prev</button>
          {/if}
          <ArticleButtons {articleButtonData} {addArticle} />
          {#if next_page}
            <button on:click={filter(articleLevel, next_page)}>Next</button>
          {/if}
        </div>
      </div>
        <div class="col-sm orderlist overflow-auto" >
        

            <OrderList {orderList} on:pressedEnter={testFunc} />
        </div>
    </div>

  </div>

</main>
<style>
.orderlist {
  max-height: 50em !important;
}
</style>
