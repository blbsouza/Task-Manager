<script setup>
import axios from 'axios'
import { useAppStore } from '@/store/app'
import { ref } from 'vue'
// vars
const store = useAppStore()
const tasks = ref([])
const add = ref()
const toast = ref()
const confirm = ref()
const edit = ref()
const list = [
  {title: 'ABERTO', value: 1},
  {title: 'EM ATENDIMENTO', value: 2},
  {title: 'SOLUCIONADO', value: 3}
]
//functions
const getData = async () => {
  await axios.get(store.url+'data.php')
    .then(r => {
      if ((r.data).length > 0) {
        tasks.value = r.data
      }
    })
}

const defineColor = (v) => {
  let color
  if ( v === 1 ) {
    color = 'blue'
  } else if ( v === 2 ) {
    color = 'yellow-darken-4'
  } else {
    color = 'red-darken-1'
  }

  return color
}

const defineSts = (v) => {
  let sts
  if ( v === 1 ) {
    sts = 'ABERTO'
  } else if ( v === 2 ) {
    sts = 'EM ATENDIMENTO'
  } else {
    sts = 'SOLUCIONADO'
  }

  return sts
}

const activeTasks = () => {
  const total = (tasks.value).length;
  //
  const active = ((tasks.value).filter(task => (task.sts <= 2))).length;
  //
  const normais = ((tasks.value).filter(task => (task.urgency === 1))).length;
  const urgentes = ((tasks.value).filter(task => (task.urgency === 2))).length;
  const imediatos = ((tasks.value).filter(task => (task.urgency === 3))).length;
  //
  const inactive = total - active;

  return { tot: total, act: active, ina: inactive, nor: normais, urg: urgentes, ime: imediatos };
}

const updateSts = async (v, i) => {
  await axios.get(store.url+'updateSts.php?val='+v+'&id='+i)
    .then(() => {
      toast.value.show({m: 'Status atualizado com sucesso!'})
    })
    .catch(() => toast.value.show({m: 'Não consegui atualizar o status. Tente mais tarde...', t: 2}))
}

const deleteTask = async (id) => {
  if ( await confirm.value.open('Exclusão', 'Deseja excluir esta Task?') === true ) {
    await axios.get(store.url+'delete.php?id='+id)
      .then(() => {
        toast.value.show({m: 'Task deletada com sucesso!'})
        getData()
      })
      .catch(() => toast.value.show({m: 'Não consegui deletar a task. Tente mais tarde...', t: 2}))
  }
}

const editTask = (obj) => {
  edit.value.open(obj)
}

getData()
</script>

<template>
  <v-toolbar
    density="compact"
    :class="store.admin ? 'bg-grey-ligthen-3' : 'bg-white'"
    class="px-2"
  >
    <v-row class="ma-0 h-100 align-center justify-space-between">
      <div v-if="store.admin">
        <v-btn
          icon
          color="primary"
          variant="tonal"
          size="small"
          @click="add.open()"
        >
          <v-icon size="x-large">mdi-plus</v-icon>
          <v-tooltip activator="parent">Adicionar Task</v-tooltip>
        </v-btn>
        <add-dialog ref="add" @refresh="getData()" />
      </div>
      <p class="text-overline">total: {{ activeTasks().tot }}</p>
      <p class="text-overline">ativas: {{ activeTasks().act }}</p>
      <p class="text-overline">inativas: {{ activeTasks().ina }}</p>
      <p class="text-overline">normais: {{ activeTasks().nor }}</p>
      <p class="text-overline">urgentes: {{ activeTasks().urg }}</p>
      <p class="text-overline">imediatas: {{ activeTasks().ime }}</p>
    </v-row>
  </v-toolbar>
  <confirm-view ref="confirm" />
  <app-alert ref="toast" />
  <edit-dialog ref="edit" @refresh="getData()" />
  <v-row class="ma-0 align-center justify-center h-75" v-if="tasks.length == 0">
    <h2 class="text-primary">No momento não há pendências :)</h2>
  </v-row>
  <v-row class="ma-0 overflow-auto h-85" v-if="tasks.length > 0">
    <v-col class="pa-0">
      <v-row
        v-for="t in tasks"
        :key="t.id"
        :class="`ma-0 pa-3 bg-${defineColor(t.urgency)} justify-space-between`"
      >
        <v-col class="pa-0">
          <v-row class="ma-0 justify-space-between">
            <div class="w-10">
              <p class="text-overline">{{ t.data }}</p>
            </div>
            <div class="w-75">
              <p class="text-h6">{{ (t.title).toUpperCase() }}</p>
            </div>
            <div class="d-flex flex-row justify-end flex-wrap w-15">
              <v-select
                :items="list"
                :key="list.value"
                variant="underlined"
                :value="defineSts(t.sts)"
                density="compact"
                hide-details
                class="mb-1 text-caption"
              >
                <template v-slot:item="{ props }">
                  <v-list-item
                    v-bind="props"
                    :title="props.title"
                    class="text-caption"
                    @click="updateSts(props.value, t.id)"
                  ></v-list-item>
                </template>
              </v-select>
            </div>
          </v-row>
          <v-row class="ma-0 justify-space-between">
            <div class="w-10">
              <p class="text-overline">{{ t.datasts }}</p>
            </div>
            <div class="d-flex align-center w-75">
              <v-dialog max-width="800" v-if="(t.txt).length > 0 && t.txt != 'null'">
                <template v-slot:activator="{ props: activatorProps }">
                  <v-btn
                    v-bind="activatorProps"
                    icon
                    variant="text"
                  >
                    <v-icon>mdi-alert-box</v-icon>
                    <v-tooltip activator="parent">Ver complemento</v-tooltip>
                  </v-btn>
                </template>

                <template v-slot:default="{ isActive }">
                  <v-card>
                    <template v-slot:text>
                      <v-textarea
                        variant="solo"
                        flat
                        auto-grow
                        :model-value="t.txt"></v-textarea>
                    </template>
                  </v-card>
                </template>
              </v-dialog>
              <p>{{ t.subtitle }}</p>
            </div>
            <div class="w-15" v-if="!store.admin"></div>
            <div class="d-flex flex-row justify-end flex-wrap w-15" v-if="store.admin">
              <v-btn
                icon
                variant="text"
                size="small"
                class="mr-2"
                @click="editTask(t)"
              >
                <v-icon>mdi-pencil</v-icon>
                <v-tooltip activator="parent" location="bottom">Editar Task</v-tooltip>
              </v-btn>
              <v-btn
                icon
                variant="text"
                size="small"
                @click="deleteTask(t.id)"
              >
                <v-icon>mdi-delete</v-icon>
                <v-tooltip activator="parent" location="bottom">Excluir Task</v-tooltip>
              </v-btn>
            </div>
          </v-row>
        </v-col>
        <v-divider />
      </v-row>
    </v-col>
  </v-row>
</template>
