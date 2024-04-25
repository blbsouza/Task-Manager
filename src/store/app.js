import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    version: 1.0,
    admin: true,
    url: 'https://srvsave158/tm/php/',
    json: [],
    initialLoading: true
  }),
})
