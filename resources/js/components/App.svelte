<script>
	import { onMount } from "svelte";
	import { articleButtonList } from './stores';
	import { articleLevelList } from './stores';

	let articleButtonData = [];
	let articleLevelData = [];
	let filteredArticleList = [];
	let articleLevel = 1


	onMount(() => {
	  console.log("the component has mounted");
	  getArticleButtons();
	  getArticleLevels();
	  async function getArticleButtons(){
        const response = await axios({
			    url: "/articleButton/index",
			    method: 'GET',

			});
			articleButtonData = response.data.articleButtonList;

            articleButtonList.set(articleButtonData);
      }
	  async function getArticleLevels(){
        const response = await axios({
			    url: "/articleLevel/index",
			    method: 'GET',

			});
			articleLevelData = response.data.articleLevelList;
	
            articleLevelList.set(articleLevelData);
      }
	});
	
	function filter(articleLevel){
		filteredArticleList = articleButtonData.filter( item => item.level == articleLevel);
		console.log(filteredArticleList);
		console.log(articleLevel);
	}

</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Example Component :)</div>
					<div class="card-body">
					{#each articleLevelData as level}
					  <button type="button"  class="btn btn-primary" on:click="{filter(level.id)}">{level.name} </button>
					{/each}  					
					{#each filteredArticleList as button}
					  <input type="button" value="{button.name}" />
					{/each}  
					</div>
				</div>
				<div class="card">
					<div class="card-header">Example Component :)</div>
					<div class="card-body">
						I'm an example component.
					</div>

			</div>
		</div>
	</div>
</main>