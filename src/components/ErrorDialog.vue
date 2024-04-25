<template>
  <v-dialog
    v-model="dialog"
    @keydown.esc="cancel"
    max-width="500"
  >
    <v-card color="error">
      <v-card-text v-show="!!message" class="pa-4">{{ message }}</v-card-text>
      <v-card-actions class="pt-0 justify-end" v-if="type">
        <v-btn variant="text" @click="link">INSTALAR TABELA</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { useAppStore } from '@/store/app'

export default {
  data: () => ({
    dialog: false,
    type: false,
    message: '',
    local: useAppStore().url
  }),
  methods: {
    open(message, type) {
      this.dialog = true
      this.type = type
      this.message = message
    },
    cancel() {
      this.dialog = false
    },
    link () {
      window.open(this.local + 'error/telaconfig.php')
    }
  }
}
</script>