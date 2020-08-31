import {  writable } from 'svelte/store';

export const articleButtonList = writable([]);
export const articleLevelList = writable([]);
export const articleListStore = writable([]);
export const orderListStore = writable([]);
export const totalStore = writable(0);
export const lastTotalStore = writable(0);
