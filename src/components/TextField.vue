<script>
export default {
  props: {
    label: String,
    counter: Number
  }
}
</script>

<template>
  <v-text-field
    :label="label"
    variant="outlined"
    color="primary"
    :counter="counter"
    density="compact"
    clearable
  ></v-text-field>
</template>