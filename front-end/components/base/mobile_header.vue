<script setup lang="ts">
import Mobile_language from "~/components/base/mobile_language.vue";
import Mobile_pages from "~/components/base/mobile_pages.vue";

</script>

<template>
  <div class="grid grid-cols-7 grid-rows-1 h-18 bg-[#F4EFE6]">
    <div class="flex justify-center pt-6 pl-6">
      <img src="../../assets/images/t-solid.svg" class="brand_icon content-center"/>
    </div>
    <div class="flex justify-center pt-6 col-start-6">
      <mobile_language />
    </div>
    <mobile_pages />
  </div>
</template>

<style scoped>

</style>