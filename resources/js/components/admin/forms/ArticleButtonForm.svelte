<script>
	import { onMount } from "svelte";

	var button = [];
	var res = "";

	onMount(() => {
	  console.log("the component has mounted");
	});

async function saveButton(button){
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
				'reference' : button.reference,
				'level' : button.level

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
                            <input name='name' type='text' class='form-control' id='name' bind:value="{button.name}"  >
                        </div>	
							<div class="form-group">
                            <label for="">Reference:</label>
                            <input name='reference' type='text' class='form-control' id='reference' bind:value="{button.reference}" >
                        </div>	
							<div class="form-group">
                            <label for="">Ebene:</label>
                            <input name='level' type='number' class='form-control' id='level' bind:value="{button.level}">
                        </div>
							<input type="button"  on:click|preventDefault="{() => saveButton(button)}" value="Save" />
						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>