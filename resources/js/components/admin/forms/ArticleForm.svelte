<script>
	import { onMount } from "svelte";

	var article = [];
	var res = "";

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
				'stock' : article.stock
			}
		});
		console.log(response);
		res = response.data.message;

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
                            <input name='PLU' type='number' class='form-control' id='PLU' bind:value="{article.plu}" >
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

							<input type="button"  on:click|preventDefault="{() => saveArticle(article)}" value="Save" />
						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>