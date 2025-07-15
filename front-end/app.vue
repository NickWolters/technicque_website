<template>
  <menubar v-if="width > 600"></menubar>
  <Mobile_header v-if="width < 600"/>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
  <Footer class="footer shadow-2xl"/>
  <Toaster />
</template>

<script setup lang="ts">

import Footer from "~/components/base/footer.vue";
import Mobile_header from "~/components/base/mobile_header.vue";
import { Toaster } from "~/components/shadcn/sonner"
import 'vue-sonner/style.css'

import { useWindowSize } from '@vueuse/core'
import Menubar from "~/components/base/menubar.vue";

const { width } = useWindowSize()

</script>

<style lang="scss">
  @use "~/assets/scss/main.scss";
</style>