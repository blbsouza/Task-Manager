<script>
export default {
  data () {
    return{
      showSnackBar: false,
      message: '',
      color: 'success',
      icon: 'mdi-check-circle',
      timer: 3000
    }
  },
  methods:{
    show(data) {
      this.showSnackBar = true
      this.message      = data.m
      let t, i
      switch (data.t) {
        case 1: t = 'warning';i = 'mdi-alert';        break;
        case 2: t = 'error';  i = 'mdi-close-circle'; break;
        case 3: t = 'info';   i = 'mdi-alert-circle'; break;
        default:t = 'success';i = 'mdi-check-circle'; break;
      }
      this.color  = t
      this.icon   = i
    }
  }
}
</script>

<template>
  <v-snackbar
    bottom
    :color="color"
    :timeout="timer"
    v-model="showSnackBar"
    transition="slide-y-transition"
    location="top"
  >
    <div style="background-color: rgba(255,255,255,0.2);width: 10px;height: 100%;position: absolute;top: 0;left: 0;border-radius: 2px 0 0 2px;"></div>
    <v-icon left>{{icon}}</v-icon>{{message || 'default message'}}
    <template v-slot:action="{ attrs }">
      <v-btn
        icon
        v-bind="attrs"
        @click="showSnackBar = false"
        small
      >
        <v-icon small>mdi-close</v-icon>
      </v-btn>
    </template>
  </v-snackbar>
</template>