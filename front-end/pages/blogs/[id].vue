<script setup lang="ts">
import BlogHeaderComponent from "~/components/blogs/BlogHeaderComponent.vue";
import BlogSection from "~/components/blogs/BlogSection.vue";
import BlogQuote from "~/components/blogs/BlogQuote.vue";
import type {LocaleContent} from "~/lib/locale";
import {getLocaleSpecificVariable} from "~/lib/utils";

export interface BlogContent {
  id: number,
  title: LocaleContent,
  description: LocaleContent,
  created_at: any,
  updated_at: any,
  tags: LocaleContent,
  content: any,
}

const { id } = useRoute().params

const { data : blog } = await useFetch('http:localhost:8000/api/blogs/' + id);
const blog_content = blog.value as BlogContent
</script>

<template>
  <BlogHeaderComponent :blog_content="blog_content"></BlogHeaderComponent>
  <div class="mx-16 mb-8">
    <Separator />
  </div>
  <div class="grid grid-col-1 lg:grid-cols-2 gap-2 lg:gap-4 py-5 mx-16">
    <div v-for="section in getLocaleSpecificVariable(blog_content.content)" class="col-span-1 flex items-center">
        <div v-if="section.type === 'section'">
          <BlogSection :section="section"/>
        </div>
        <div v-else-if="section.type === 'quote'">
          <BlogQuote :section="section" class="align-middle"/>
        </div>
        <div v-if="section.type === 'empty'"></div>
      </div>
  </div>
</template>