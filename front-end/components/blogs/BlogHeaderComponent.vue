<script setup lang="ts">

import {ClockIcon} from "@heroicons/vue/24/solid";
import {Badge} from "~/components/shadcn/badge";

defineProps<{
  blog : {
    id: number,
    title: string,
    description: string,
    created_at: string,
    updated_at: string,
    tags: string[],
  }
}>()

</script>

<template>
  <div class="md:mx-6">
    <div class="grid lg:grid-cols-6 lg:grid-rows-4 gap-4 px-4 py-4 lg:px-12 lg:py-12">
      <div class="flex flex-row lg:col-span-3 lg:pt-4 pl-6 gap-4 text-2xl lg:text-5xl">
        <Separator class="bg-[#808000] pr-2 lg:pr-4" orientation="vertical"/>
        <h1 v-html="blog.title" class="pt-3"/>
      </div>
      <div class="lg:col-span-3 lg:row-span-5 lg:row-start-1 lg:col-start-4 pl-10 pr-6 py-4 ">
        <img class="rounded-xl " src="../../assets/images/WhatsApp Image 2025-05-07 at 21.11.04.jpeg" alt=""/>
      </div>

      <div class="lg:col-span-3 lg:row-span-3 lg:row-start-2 text-md lg:text-xl lg:pr-16 font-light px-4" >
        <div class="md:max-w-full hover:overflow-x-auto overflow-hidden hover:pb-2 px-5">
          <div class="md:pl-0 pl-4 mt-8 md:mt-4 gap-5 md:gap-4 inline-flex right-auto  ">
            <div v-for="tag in blog.tags">
              <Badge class="bg-[#808000] text-white text-xs md:text-sm" variant="default">
                {{ tag }}
              </Badge>
            </div>
          </div>
        </div>

        <h2 v-html="blog.description" class="pl-8 lg:pt-8 pt-4"/>

        <div class="flex flex-row gap-4 text-sm p-1 mt-8 px-6 h-14 md:h-10 bg-[#87D3E4] rounded-2xl text-white">
          <ClockIcon class="py-1"/>
          <i18n-d class="py-3 md:py-1" tag="p" :value="new Date(blog.created_at)"></i18n-d>
          <Separator class="bg-white pr-0.3" orientation="vertical"/>
          <div class="font-semibold py-1">
            Last updated at: <i18n-d tag="span" :value="new Date(blog.updated_at)" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>