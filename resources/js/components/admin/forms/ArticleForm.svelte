<script>
	import { onMount } from "svelte";
	import { articleListStore } from "./../../stores.js";

	var article = [];
	var res = "";
	var allArticle = [];
	var formMessage = "";

	const unsubscribe = articleListStore.subscribe(value => {
		allArticle = value;
	});

	onMount(() => {
	  console.log("the component has mounted");
	});

async function saveArticle(article){
    console.log(article);
		const response = await axios(
		{
			url: "/article/store",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
                'name' : article.name,
				'plu' :  article.plu,
				'category' : article.category,
				'price'    : article.price,
				'purchasePrice' : article.purchasePrice,
				'stock' : article.stock,
				'printer' : 1
			}
		});
		console.log("Response: ",response);
		res = response.data.message;
		articleListStore.set(response.data.articleList);

}

function pluChange(e){
	console.log(e.target.value);
	console.log(allArticle);
	const existPlu = allArticle.find(element => element.plu == e.target.value)
	console.log(existPlu);
	if(existPlu != undefined){
		formMessage = "Diese Nummer wird bereits verwendet!"
	}else{
		formMessage = " "
	}
}

</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Admin Component </div>
					<div class="card-body">
					<div>{res}</div>
					    <div class="form-group">
                            <label for="">Name:</label>
                            <input name='name' type='text' class='form-control' id='name' bind:value="{article.name}"  >
                        </div>	
						<div class="form-group">
                            <label for="">PLU:</label>
                            <input name='PLU' type='number' class='form-control' id='PLU' bind:value="{article.plu}" on:change="{(e) => pluChange(e)}">
							<p>{formMessage}</p>
                        </div>	
						<div class="form-group">
                            <label for="">Kategorie:</label>
                            <input name='category' type='text' class='form-control' id='category' bind:value="{article.category}">
                        </div>
							
						<div class="form-group">
                            <label for="">Verkaufspreis:</label>
                            <input name='price' type='number' step='0.05' class='form-control' id='price' bind:value="{article.price}">
                        </div>
							
						<div class="form-group">
                            <label for="">Einkaufspreis:</label>
                            <input name='purchasePrice' type='number' step='0.01' class='form-control' id='purchasePrice' bind:value="{article.purchasePrice}">
                        </div>
							
						<div class="form-group">
                            <label for="">Bestand:</label>
                            <input name='stock' type='number' class='form-control' id='stock' bind:value="{article.stock}">
                        </div>
						<div class="form-group">
                            <label for="">Printer:</label>
                            <input name='printer' type='number' class='form-control' id='stock' bind:value="{article.printer}">
                        </div>
							<input type="button"  on:click|preventDefault="{() => saveArticle(article)}" value="Save" />
						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>