import { writable } from "svelte/store";
console.log("Echo from store");

export const controllButtonStore = writable([], function start(set) {
  console.log("start function");

  fetch("/controllButton/index")
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      console.log("res: ",response);
      set(response);
    });
});