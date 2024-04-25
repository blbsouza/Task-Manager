<script setup>
import { useAppStore } from '@/store/app'
import AppInfo from '@/components/AppInfo'
//
const store = useAppStore()
</script>

<template>
  <v-app-bar
    density="compact"
    class="bg-white"
  >
    <img
      src="@/assets/task.svg"
      :width="40"
      :height="40"
      class="ml-1"
    />
    <v-app-bar-title class="font-weight-bold text-primary ml-1">Task-Manager</v-app-bar-title>
    <v-spacer />
    <ProdInfo :json="store.json" />
    <AppInfo />
    <v-divider vertical />
    <div class="px-1 d-flex align-center">
      <v-img
        :src="store.json?.myLogo"
        :height="35"
        :width="35"
        class="mx-5"
      />
      <p v-if="store.json?.tm?.version === undefined || store.json?.tm?.version === store.version" class="text-caption text-blue-grey-lighten-3">blbtech &copy; All<br>rights reserved</p>
      <p v-else class="text-success text-caption text-center" style="line-height: 0.8rem;"><v-icon>mdi-update</v-icon>Há uma<br>atualização<br>disponível({{ store.json?.tm?.version }})</p>
    </div>
  </v-app-bar>
</template>