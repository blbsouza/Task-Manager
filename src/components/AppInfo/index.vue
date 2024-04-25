<script setup>
  import { useAppStore } from '@/store/app'
  import { ref } from 'vue'
  //
  const store = useAppStore()
  const dialog = ref()
</script>

<template>
  <v-snackbar
    v-model="dialog"
    position="absolute"
    location="top right"
    rounded="shaped"
    color="white"
    max-width="80"
    class="mt-12"
    content-class="text-opposite text-caption pa-0 mx-auto"
  >
    <v-col class="d-flex flex-column align-center">
      <TitleInfo />
      <br />
      <VersionInfo :version="store.version" />
      <CreateInfo />
      <br />
      <TechInfo />
      <br />
      <ContactInfo />
      <br />
      <CopyRight />
    </v-col>
  </v-snackbar>
  <v-btn
    icon
    @click="dialog = !dialog"
    color="blue-grey-lighten-1"
  >
    <v-icon>mdi-information</v-icon>
  </v-btn>
</template>