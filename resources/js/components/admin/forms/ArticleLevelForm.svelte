<script>
	import { onMount } from "svelte";
	import { articleLevelList } from "./../../stores.js";

	var level = [];
	var res = "";
	var allLevels = [];
	var formMessage = "";

	const unsubscribe = articleLevelList.subscribe(value => {
		allLevels = value;
	});

	onMount(() => {
	  console.log("the component has mounted");
	});

async function saveLevel(level){
    console.log(level);
		const response = await axios(
		{
			url: "/articleLevel/store",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
                'id' : level.name,
				'name' :  level.plu,

			}
		});
		console.log("Response: ",response);
		res = response.data.message;
		articleLevelList.set(response.data.articleLevelList);

}

function levelChange(e){
	console.log(e.target.value);
	console.log(allLevels);
	const exist = allLevels.find(element => element.id == e.target.value)
	console.log(exist);
	if(exist != undefined){
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
                            <label for="">ID:</label>
                            <input name='name' type='number' class='form-control' id='name' bind:value="{level.name}" on:change="{(e) => levelChange(e)}"  >
                        </div>	
						<div class="form-group">
                            <label for="">Name:</label>
                            <input name='PLU' type='text' class='form-control' id='PLU' bind:value="{level.plu}" >
							<p>{formMessage}</p>
                        </div>	
						
							<input type="button"  on:click|preventDefault="{() => saveLevel(level)}" value="Save" />
						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>