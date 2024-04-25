<script setup>
import { useAppStore } from "@/store/app"
//
const store = useAppStore()

defineProps({
  json: Object
})
</script>

<style scoped>
  a {
    text-decoration: none;
    border: 1px solid rgba(0,0,0,0);
    color: #000
  }
  a:hover {
    border-color: rgba(0,0,0,.2)
  }
</style>

<template>
  <!-- produtos -->
  <v-snackbar
    v-model="store.prod"
    position="absolute"
    location="top right"
    max-width="150"
    color="white"
    class="mt-13"
  >
    <v-row
      v-if="!json?.product"
      dense
      class="ma-0 text-center"
    >
      <h6 class="mx-auto text-h6">Não foi possível localizar os produtos.</h6>
      <p class="text-caption mx-auto">Talvez você esteja sem conexão com a internet.</p>
    </v-row>
    <v-col v-if="json?.product">
      <v-row
        dense
        class="text-center"
      >
        <h3 class="mx-auto text-h6 text--primary">Conheça nossos Apps</h3>
      </v-row>
      <v-row dense justify="space-between">
        <a
          v-for="p in json?.product"
          :key="p.name"
          :title="json?.[p.name]?.version"
          class="rounded-lg text-opposite"
          :href="json[p.name]?.link" target="_blank"
        >
          <v-col class="d-flex flex-column align-center pa-1">
            <v-img height="40" width="40" :src="json?.[p.name]?.logo"></v-img>
            <p class="text-caption ma-0 mt-1 text--primary">{{p.name.toUpperCase()}}</p>
          </v-col>
        </a>
      </v-row>
    </v-col>
  </v-snackbar>
  <v-btn
    @click="store.prod = true"
    icon
    color="blue-grey-lighten-1"
  >
    <v-icon>mdi-apps</v-icon>
    <v-tooltip activator="parent">Confira os nossos produtos</v-tooltip>
  </v-btn>
</template>
