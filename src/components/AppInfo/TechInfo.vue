<script setup lang="ts">
const icons = [
  { t: 'HTML5', i: 'language-html5' },
  { t: 'CSS3', i: 'language-css3' },
  { t: 'VUEJS', i: 'vuejs' },
  { t: 'VUETIFY', i: 'vuetify' },
  { t: 'JAVASCRIPT', i: 'language-javascript' },
  { t: 'PHP', i: 'language-php' },
  { t: 'JSON', i: 'code-json' },
  { t: 'MATERIAL DESIGN', i: 'material-design' },
  { t: 'BANCO DE DADOS', i: 'database' },
  { t: 'SERVIÇOS EM NUVEM', i: 'cloud' }
]
</script>

<script lang="ts">
  export default {}
</script>

<template>
  <span class="pb-1">Tecnologias</span>
  <div>
    <v-icon
      v-for="i in icons"
      :key="i.t"
      :title="i.t"
    >mdi-{{ i.i }}</v-icon>
  </div>
</template>