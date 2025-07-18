<script setup lang="ts">
import BlogHeaderComponent from "~/components/blogs/BlogHeaderComponent.vue";
import BlogSection from "~/components/blogs/BlogSection.vue";
import BlogQuote from "~/components/blogs/BlogQuote.vue";

const { id } = useRoute().params

const { data : blog } = await useFetch('http:localhost:8000/api/blogs/' + id);
const blog_content = blog.value.content;
</script>

<template>
  <BlogHeaderComponent :blog="blog"></BlogHeaderComponent>
  <div class="mx-16 mb-8">
    <Separator />
  </div>
  <div class="grid grid-col-1 lg:grid-cols-2 gap-2 lg:gap-4 py-5 mx-16">
      <div v-for="section in blog_content" class="col-span-1 flex items-center">
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