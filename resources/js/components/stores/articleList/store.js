import { writable } from "svelte/store";

export const articleListStore = writable([], function start(set) {
    console.log("articleListStore start");
  
    fetch("/article/index")
      .then(function(response) {
        return response.json();
      })
      .then(function(response) {
        console.log("res articleList: ",response);
        set(response);
      });
  });