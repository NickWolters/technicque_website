<script setup lang="ts">

import {Card, CardContent, CardHeader, CardTitle} from "~/components/shadcn/card";
import ExperienceBadge from "~/components/experience/ExperienceBadge.vue";

export interface Job {
  description: string,
  experiences : [{
    title: string,
    description: string,
    icon_abbreviation: string,
    id: number,
    start_year: number
    experience_group_id: number,
  }],
  id: number,
  start_month: number,
  start_year: number,
  stop_month: number,
  stop_year: number,
  title: string,
}

export interface Experience {
  title: string,
  description: string,
  icon_abbreviation: string,
  id: number,
  start_year: number
  experience_group?: {
    id: string,
    color: "#06f7e5"
  }
}

const { job } = defineProps<{
 job : {
   iconUrl: any,
   job_content : Job
 }
}>()


const experienceArray = job.job_content.experiences as Array<Experience>;

const experiences : Array<Experience> = experienceArray.map((value) => {
  const {data: experience} = useFetch(`http://127.0.0.1:8000/api/experience/${value.id}`, {
    onResponseError: function ({response}) {
      console.log(response);
    }
  });

  return experience.value as Experience;
})

</script>

<template>
  <div class="card_outline">
    <Card class="bg-[#F4EFE6] align-center flex">
      <CardHeader class="flex flex-col content-center">
        <img v-if="job.iconUrl != null" class="px-1 py-5 pb-5" :src='job.iconUrl' alt=""/>
        <div class="grid grid-cols-5 grid-rows-2 gap-4 pt-4 lg:pt-10 w-full">
          <div class="col-span-3">
            <CardTitle class="text-lg lg:text-2xl">{{ job.job_content.title }}</CardTitle>
          </div>
          <div class="col-start-1 md:col-start-4 row-start-2 md:row-start-1 col-span-2 text-sm flex md:justify-end">
            <p><b>From:</b> {{ `${job.job_content.start_month} / ${job.job_content.start_year}` }}</p>
          </div>
          <div class="col-start-3 md:col-start-4 row-start-2 col-span-2 text-sm flex md:justify-end">
            <p><b>To:</b> {{ `${job.job_content.stop_month} / ${job.job_content.stop_year}` }}</p>
          </div>
        </div>
      </CardHeader>
      <Separator class="mx-6 !w-9/10" />
      <CardContent class="flex flex-col gap-4">
        <span class="text-sm lg:text-lg" v-html="job.job_content.description"></span>
        <div class="flex flex-row gap-3">
          <div v-for="experience in experiences" key="experience.id">
            <ExperienceBadge :experience="experience"/>
          </div>
        </div>
      </CardContent>
    </Card>
  </div>
</template>

<style scoped>

</style>