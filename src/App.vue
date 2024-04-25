<script setup>
import axios from 'axios'
import { useAppStore } from './store/app'
import { ref } from 'vue'
//
import ErrorDialog from './components/ErrorDialog.vue'
//
const store = useAppStore()
// refs
const error = ref()
//
const testingBd = async () => {
  await axios.get(store.url+'conn/pdo.php?fetch=1')
    .then(r => {
      let bd = r.data.bd
      if ( bd === true ) {
        testingTable()
      } else {
        error.value.open('Não foi possível se conectar ao banco de dados. Por favor, verifique os dados e tente novamente...')
      }
    })
}

const testingTable = async () => {
  await axios.get(store.url+'getBdtable.php')
    .then(r => {
      let table = r.data.table
      if ( table === true ) {
        defineAdmin()
      } else {
        error.value.open('A tabela necessária para o funcionamento desta página não foi encontrada. Clique em INSTALAR TABELA para continuar.', true)
      }
    })
}

const defineAdmin = async () => {
  await axios.get(store.url+'ip.php')
    .then(r => {
      if ( r.data.admin === true ) {
        store.admin = true
      } else {
        store.admin = false
      }
    })
    .catch(() => store.admin = false)
    .finally(() => getData())
}

const getData = async () => {
  await axios.get(store.url+'data.php')
    .then(r => {
      store.desserts = r.data
      setTimeout(() => {
        store.initialLoading = false
      },1000)
      getJson()
    })
}

const getJson = async () => {
  await axios.get('https://cdn.statically.io/gh/blbsouza/cdn/main/json/web-app.json')
    .then(r => {
      store.json = r.data
    })
}

testingBd()
</script>

<template>
  <v-app>
    <ErrorDialog ref="error" />
    <home-loading v-if="store.initialLoading" />
    <app-bar v-if="!store.initialLoading && store.admin" />
    <v-main class="bg-grey-lighten-4" v-if="!store.initialLoading" >
      <router-view />
    </v-main>
  </v-app>
</template>
