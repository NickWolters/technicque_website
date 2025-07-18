<script setup lang="ts">

import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "~/components/shadcn/card";
import {Badge} from "~/components/shadcn/badge";

defineProps<{
 job : {
   iconUrl: string,
   job_content : {
     title: string,
     description: string,
     start_month: number,
     start_year: number,
     stop_month: number,
     stop_year: number,
     experiences? : [{
       title: string,
       description: string,
       icon_abbreviation: string,
       id: number,
       start_year: number
     }]
   }
 }
}>()
</script>

<template>
  <div class="card_outline">
    <Card class="bg-[#F4EFE6] align-center flex">
      <CardHeader class="flex flex-col content-center">
        <img v-if="job.iconUrl != null" class="px-1 py-5 pb-5" :src='job.iconUrl'/>
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
      <CardContent class="grid gap-4">
        <span class="text-sm lg:text-lg" v-html="job.job_content.description"></span>
        <div class="flex flex-row gap-3">
          <div v-for="experience in job.job_content.experiences" >
            <Badge class="bg-[#808000] hover:bg-green-600 text-white text-sm" variant="default">
              {{ experience.title }}
            </Badge>
          </div>
        </div>
      </CardContent>
    </Card>
  </div>
</template>

<style scoped>

</style>