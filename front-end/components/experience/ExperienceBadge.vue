<script setup lang="ts">

import {Badge} from "~/components/shadcn/badge";
import type {Experience} from "~/components/experience/JobCard.vue";

const { experience } = defineProps<{
  experience : Experience
}>()

let colorFromScript = '';
if (experience) {
  colorFromScript = experience.experience_group!.color;
}

</script>

<template>
  <p v-if="experience == null">Loading...</p>
  <Badge v-else class=" text-white text-sm pointer-none:" variant="secondary" :style="{ 'background-color': experience.experience_group!.color}">
    {{ experience.title }}
  </Badge>
</template>

<style scoped>
#script {
  background-color: v-bind('colorFromScript')
}
</style>