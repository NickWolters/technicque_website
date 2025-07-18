<script setup lang="ts">
  defineProps(['section'])
</script>

<template>
  <div class="flex gap-4 flex-col justify-center text-sm bg-[#E6B64E] rounded-3xl align-content-center m-6 p-6">
    <img src="../../assets/images/quote.svg" class="brand_icon content-center rotate-180"/>
    <div v-html="section.data.content" class=""/>
    <Separator />
    <div v-html="section.data.subtext" class="italic"/>
  </div>
</template>

<style scoped>

</style>