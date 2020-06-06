<script>
    import { onMount } from "svelte";
    import ArticleButtonForm from "./forms/ArticleButtonForm.svelte";
    import EditArticleButton from "./forms/EditArticleButton.svelte";
	import ArticleForm from "./forms/ArticleForm.svelte";
	import { articleListStore }  from './../stores.js';

	
	onMount(() => {
	  console.log("the component has mounted");
	  getArticle();
	  
	});
	async function getArticle(){
          const response = await axios({
			    url: "/article/index",
			    method: 'GET',

			});
			articleListStore.set(response.data.articleList);

      }
	const options = [
		{ form: 'ArticleButton', component: ArticleButtonForm},
		{ form: 'EditArticleButton', component: EditArticleButton},
	    { form: 'ArticleForm', component: ArticleForm}

	]
    let activeForm = options[0];

</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Admin </div>
					<select bind:value={activeForm}>
					    {#each options as option}
						  <option value={option}>{option.form}</option>
						{/each}
					</select>
					<div class="card-body">
						<svelte:component this={activeForm.component} />
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

