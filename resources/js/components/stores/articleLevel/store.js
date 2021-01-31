import { writable } from "svelte/store";
console.log("Echo from articleLevelStore");

export const articleLevelList = writable([], async function start(set) {
  console.log("start function (articleLevel)");

  await fetch("/articleLevel/index")
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      console.log("articleLevel: ",response);
      set(response[0]);
    });
});