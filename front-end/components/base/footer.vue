<script setup lang="ts">
import { useWindowSize } from '@vueuse/core'

const { width, height } = useWindowSize()

</script>

<template>
  <div class="grid lg:grid-cols-8 grid-cols-3 lg:grid-rows-3 grid-rows-3 flex-col lg:flex-row">
    <div class="lg:col-span-2 col-span-3 lg:row-span-3 row-span-1 pt-5 pl-4">
      <div class="footer_branding">
        <img src="../../assets/images/t-solid.svg" class="brand_icon content-center"/>
        <Separator orientation="vertical" class="bg-gray-500" />
        <div class="text-center text-xl lg:text-3xl font-semibold content-center">Technique</div>
      </div>
    </div>
    <div class="lg:col-span-4 col-span-3 row-span-2 lg:row-span-3 lg:col-start-3 col-start-1 lg:mt-4">
      <div class="grid lg:grid-cols-4 grid-cols-1 grid-rows-3 lg:grid-rows-1 lg:gap-4 gap-1 lg:pt-5 pl-4 lg:pb-4">
        <div class="footer_refs">
          <a href="/experience/work" class="font-normal lg:font-semibold">Experience</a>
          <div class="flex-row grid gap-4 py-5" v-if="width >= 1024">
            <a href="/experience/work" class="font-light text-sm">Work experience</a>
            <a href="/experience/studies" class="font-light text-sm">Studies</a>
            <a href="/experience/subjects" class="font-light text-sm">Techniques</a>
          </div>
        </div>
        <div class="footer_refs">
          <a href="/blogs">Blogs</a>
        </div>
        <div class="footer_refs">
          <a href="/personal">Personal</a>
        </div>
      </div>
    </div>
    <div class="lg:col-span-2 col-span-3 row-span-1 lg:row-span-3 lg:col-start-7 pl-6 lg:pl-0 lg:pt-9 flex flex-col">
      <div class="py-2 font-semibold">Contact</div>
      <Separator v-if="width >= 1024" class="mb-4 pr-8 bg-gray-300 !w-1/2" orientation="horizontal"/>
      <div class="flex px-1 py-2 gap-5 content-center">
        <a href="https://www.linkedin.com/in/nick-wolters-04432a22/" class="bg-gray-200 hover:bg-gray-400 p-3 rounded-full">
          <img class="footer_icon" src="../../assets/images/contact/linkedin-in-brands.svg" />
        </a>
        <a class="bg-gray-200 hover:bg-gray-400 p-3 rounded-full ">
          <img class="footer_icon" src="../../assets/images/contact/instagram-brands.svg"/>
        </a>
        <a class="bg-gray-200 hover:bg-gray-400  p-3 rounded-full">
          <img class="footer_icon" src="../../assets/images/contact/envelope-solid.svg"/>
        </a>
      </div>
    </div>
  </div>
</template>


<style scoped>

</style>