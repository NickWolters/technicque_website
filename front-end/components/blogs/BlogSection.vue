<script setup lang="ts">

const props = defineProps(['section'])
</script>

<template>
  <div class="flex gap-6 flex-col justify-center  rounded-2xl lg:rounded-r-3xl py-8 lg:m-4">
    <component v-html="section.data.heading" class="text-2xl lg:text-3xl text-[#808000]"/>
    <Separator v-if="section.data.heading != undefined"/>
    <div v-html="section.data.paragraph" class="text-sm lg:text-md flex flex-col gap-4"/>
  </div>
</template>

<style scoped>

</style>