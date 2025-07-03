<script setup lang="ts">
  const { data : experience_groups } = await useFetch('http:localhost:8000/api/experience_group');
</script>

<template>
  <div class="justify-center px-8 flex flex-col items-center pb-10">
    <h2 class="p-8 font-medium text-4xl text-[#808000]">Techniques</h2>
    <p>These are all the technical and non-technical skill I have achieved during my studies.</p>
  </div>

  <div v-for="experience_group in experience_groups">
      <ExperienceGroup :experience_group="experience_group"/>
  </div>
</template>

<style scoped>

</style>