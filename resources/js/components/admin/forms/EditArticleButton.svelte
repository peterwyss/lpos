<script>
	import { onMount } from "svelte";

	var articleButtonList = [];
	var button = [];
	

	onMount(() => {
	    getArticleButtons();
	    async function getArticleButtons(){
          const response = await axios({
			    url: "/articleButton/index",
			    method: 'GET',

			});
			articleButtonList = response.data.articleButtonList;

      }

	});

async function updateButton(button){
    console.log(button);
		const response = await axios(
		{
			url: "/articleButton/store",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
                'name' : button.name,
				'reference' : button.reference

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
					<div class="card-header">Edit</div>
					<div class="card-body">
					 {#each  articleButtonList as button}
					 	<p>{button.id} {button.name}</p>
					 	<div class="form-group">
                            <label for="">Name:</label>
                            <input name='name' type='text' class='form-control' id='name' bind:value="{button.name}">
                        </div>
						<div class="form-group">
                            <label for="">Referenz:</label>
                            <input name='name' type='number' class='form-control' id='name' bind:value="{button.reference}">
                        </div>
							<div class="form-group">
                            <label for="">Ebene:</label>
                            <input name='name' type='number' class='form-control' id='name' bind:value="{button.level}">
                        </div>
						
					 {/each}  
	
					</div>
				</div>
			</div>
		</div>
	</div>
</main>