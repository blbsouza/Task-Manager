<script>
import axios from 'axios'
import { useAppStore } from '@/store/app'
export default {
  data: () => {
    return {
      model: false,
      form: false,
      id: null,
      title: null,
      subtitle: null,
      txt: null,
      urgency: 1,
      loading: false,
      // rules
      rules: [v => !!v || 'Precisa preencher o campo']
    }
  },
  methods: {
    open(obj) {
      this.id = obj.id
      this.title = obj.title
      this.subtitle = obj.subtitle
      this.txt = obj.txt
      this.urgency = obj.urgency
      this.model = true
    },
    async validate () {
      this.loading = true
      const { valid } = await this.$refs.form.validate()

      if (valid) {
        this.updateTask()
      } else {
        this.loading = false
      }
    },
    reset () {
      this.$refs.form.reset()
    },
    async updateTask() {
      await axios.get(useAppStore().url+'update.php?tit='+this.title+'&sub='+this.subtitle+'&txt='+this.txt+'&urg='+this.urgency+'&idd='+this.id)
        .then(r => {
          if ( r.data.typ === 1 ) {
            this.$refs.toast.show({m: 'Atualizado com sucesso!'})
          }
        })
        .catch(() => this.$refs.toast.show({m: 'Não foi possível atualizar', t: 2}))
        .finally(() => {
          this.loading = false
          this.model = false
          this.$emit('refresh')
        })
    }
  }
}
</script>

<template>
  <app-alert ref="toast" />
  <v-dialog
    v-model="model"
    max-width="500"
  >
    <v-card
      class="rounded-lg"
    >
      <v-toolbar
        class="bg-primary"
        density="compact"
      >
        <v-toolbar-title><v-icon>mdi-pencil</v-icon> Editar Task</v-toolbar-title>
        <v-spacer />
        <v-btn
          icon
          density="compact"
          @click="model = false"
        >
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-col class="ma-0 pa-1">
        <v-form
          ref="form"
          v-model="form"
          class="pt-2 px-2"
        >
          <text-field
            label="Título"
            :counter="100"
            v-model="title"
            :rules="rules"
            required
          />
          <text-field
            label="Subtítulo"
            :counter="100"
            v-model="subtitle"
          />
          <v-textarea
            v-model="txt"
            label="Complemento"
            variant="outlined"
            color="primary"
            :counter="500"
            density="compact"
          ></v-textarea>
          <v-row class="ma-0 justify-center bg-grey-lighten-3 pa-1 rounded-lg">
            <div class="d-flex align-center flex-column">
              <h3 class="text-overline">URGÊNCIA</h3>
              <v-btn-toggle
                v-model="urgency"
                density="compact"
                divided
                group
                class="d-flex justify-center"
              >
                <v-btn
                  color="blue"
                  :value="1"
                >
                  NORMAL
                </v-btn>
                <v-btn
                  color="yellow-darken-4"
                  :value="2"
                >
                  URGENTE
                </v-btn>
                <v-btn
                  color="red-darken-1"
                  :value="3"
                >
                  IMEDIATO
                </v-btn>
              </v-btn-toggle>
            </div>
          </v-row>
          <v-divider class="my-1" />
          <v-row class="ma-0 pa-1 justify-space-between">
            <v-btn
              color="success"
              width="45%"
              @click="validate"
              :disabled="!form"
              :loading="loading"
            >SALVAR</v-btn>
            <v-btn
              color="warning"
              width="45%"
              @click="reset"
            >RESET</v-btn>
          </v-row>
        </v-form>
      </v-col>
    </v-card>
  </v-dialog>
</template>