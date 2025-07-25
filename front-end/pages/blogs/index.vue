<script setup lang="ts">
  import Pagination from "~/components/shadcn/pagination/Pagination.vue";
  import PaginationContent from "~/components/shadcn/pagination/PaginationContent.vue";
  import PaginationPrevious from "~/components/shadcn/pagination/PaginationPrevious.vue";
  import PaginationNext from "~/components/shadcn/pagination/PaginationNext.vue";
  import PaginationItem from "~/components/shadcn/pagination/PaginationItem.vue";
  import {ClockIcon} from "@heroicons/vue/24/solid";
  import type {BlogContent} from "~/pages/blogs/[id].vue";
  import {getLocaleSpecificVariable} from "~/lib/utils";

  const { data : blogs } = await useFetch('http:localhost:8000/api/blogs/');
  const first_blog = blogs.value[0] as BlogContent;
  const other_blogs = blogs.value.filter((blog, index) => index !== 0) as Array<BlogContent>

  const { t } = useI18n();
  const localePath = useLocalePath();

  //Pagination Information
  const blogs_per_page = 6;
  const blogs_amount = other_blogs.length;
  let page_index = 1;

   function open_blog(id: number) {
     window.location.href = localePath("/blogs/" + id);
   }

   function blogs_on_page() {
     const calcIndexRange = 1 + (blogs_per_page * page_index);
     const starting_index = blogs_per_page * (page_index - 1);

     if(calcIndexRange > other_blogs.length) {
      return other_blogs.slice(starting_index, other_blogs.length);
     } else {
       return other_blogs.slice(starting_index, calcIndexRange);
     }
   }
</script>

<template>
  <div class="grid grid-cols-5 grid-rows-1 lg:h-150 mx-6 bg-[#F4EFE6] hover:bg-[#E2CBA3] hover:shadow-2xl rounded-3xl" v-on:click="open_blog(first_blog.id)">
    <div class="p-10 flex gap-6 flex-col overflow-hidden col-span-2">
      <div v-html="getLocaleSpecificVariable(first_blog.title)" class="text-6xl text-[#808000]" />
      <div v-html="getLocaleSpecificVariable(first_blog.description)" class="text-lg italic line-clamp-6" />
      <div class="flex flex-row gap-4 text-sm p-1 px-6 h-14 md:h-10 bg-[#87D3E4] rounded-2xl text-white">
        <ClockIcon class="py-1"/>
        <i18n-d class="py-3 md:py-1" tag="p" :value="new Date(first_blog.created_at)"></i18n-d>
        <Separator class="bg-white pr-0.3" orientation="vertical"/>
        <div class="font-semibold py-1">
          {{ t('blog.last_update') }} <i18n-d tag="span" :value="new Date(first_blog.updated_at)" />
        </div>
      </div>
    </div>
    <div class="bg-[#E2CBA3] col-span-3 justify-end flex rounded-3xl">
      <img class="h-full rounded-3xl" src="../../assets/images/WhatsApp Image 2025-05-07 at 21.11.04.jpeg" alt="" />
    </div>
  </div>

  <div class="mt-12 grid grid-cols-3 gap-12 p-12">
      <div v-for="blog in blogs_on_page()" class="col-span-1 flex flex-col">
        <div class="flex flex-col rounded-2xl w-100 bg-[#F4EFE6] hover:bg-[#E2CBA3] hover:shadow-lg items-center h-125" v-on:click="open_blog(blog.id)">
          <img class="w-full rounded-t-2xl top-0" src="../../assets/images/blog_base_icon.svg" alt="" />
          <div class="px-4 pb-8">
            <div  v-if="getLocaleSpecificVariable(blog.title) !== undefined || getLocaleSpecificVariable(blog.description) !== undefined">
              <div v-html="getLocaleSpecificVariable(blog.title)" class="text-lg py-4 text-[#808000]"/>
              <div v-html="getLocaleSpecificVariable(blog.description)" class="text-md italic line-clamp-4" />
            </div>
            <div v-else>
              <p class="py-6 text-md italic line-clamp-4 text-lg"> {{ t("blog.not_yet_translated") }} </p>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="mt-12">
    <Pagination v-slot="{ page }" :items-per-page="blogs_per_page" :total="blogs_amount" :default-page="1">
      <PaginationContent v-slot="{ items }">
        <PaginationPrevious />

        <template v-for="(item, index) in items" :key="index">
          <PaginationItem
              class="rounded-full bg-amber-100 hover:bg-amber-500 mx-1"
              v-if="item.type === 'page'"
              :value="item.value"
              :is-active="item.value === page"
              :class="{'bg-amber-400': item.value === page}"
          >
            {{ item.value }}
          </PaginationItem>
        </template>
        <PaginationNext />
      </PaginationContent>
    </Pagination>
  </div>



</template>

<style scoped>

</style>