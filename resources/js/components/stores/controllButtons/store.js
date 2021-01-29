import { writable } from "svelte/store";

export const controllButtonStore = writable([], function start(set) {
  fetch(process.env.SITE + "/controllButtonController/index")
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      console.log("controllButtonStore: ", response);

      set(response);
    });
});