<script setup lang="ts">
import {Badge} from "~/components/shadcn/badge";
import {ClockIcon } from "@heroicons/vue/24/solid";

const { id } = useRoute().params

const { data : blog } = await useFetch('http:localhost:8000/api/blogs/' + id);


</script>



<template>
  <div class="mx-20 rounded-4xl bg-[#F4EFE6]">
    <div class="grid grid-cols-6 grid-rows-4 gap-4 px-16 py-16">
      <div class="col-span-3 flex flex-row gap-4 text-5xl">
        <Separator class="bg-[#808000] pr-4" orientation="vertical"/>
        <h1 v-html="blog.title" class="pt-3"/>
      </div>
      <div class="col-span-3 row-span-5 col-start-4 p-8 ">
        <img class="rounded-xl " src="../../assets/images/WhatsApp Image 2025-05-07 at 21.11.04.jpeg"/>
      </div>
      <div class="col-span-3 row-span-3 row-start-2 text-xl pr-16 pt-8 font-light" >
        <h2 v-html="blog.description" class=""/>
        <div class="mt-4 flex flex-row gap-3">
          <div v-for="tag in blog.tags">
            <Badge class="bg-[#808000] text-white text-sm" variant="default">
              {{ tag }}
            </Badge>
          </div>
        </div>
        <div class="flex flex-row gap-6 text-sm p-1 mt-8 px-8 justify-center h-10 bg-gray-200 rounded-2xl">
          <span class="inline-block align-middle ">
            <ClockIcon class="p-2"/>
            <i18n-d tag="p" :value="new Date(blog.created_at)"></i18n-d>
            <div class="font-semibold align-middle">
              Last updated at: <i18n-d tag="span" :value="new Date(blog.updated_at)" />
            </div>
          </span>
        </div>
      </div>
    </div>
  </div>


</template>

<style scoped>

</style>