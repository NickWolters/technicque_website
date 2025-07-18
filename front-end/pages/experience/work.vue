<script setup lang="ts">
  import JobCard from "~/components/experience/JobCard.vue";

  interface Job {
    description: string,
    experiences: any,
    id: number,
    start_month: number,
    start_year: number,
    stop_month: number,
    stop_year: number,
    title: string,
  }

  const { data: jobs } = await useFetch('http:localhost:8000/api/work');
  const jobArray = jobs.value as Array<Job>;

  const { t } = useI18n();

  const jobCardList = jobArray.map((value, index) => {
    const {data: icon, refresh} = useFetch(`http://localhost:8000/api/work/${value.id}/download`, {
      onResponseError: function ({response}) {
        console.log(response);
      }
    });

    return {
      job_content: value,
      iconUrl: icon.value
    }
  })
</script>

<template>
  <div class="justify-center px-8 flex flex-col items-center pb-5 lg:pb-10 md:gap-6">
    <h2 class="p-2 md:p-8 py-8 md:py-0 font-medium text-4xl text-[#808000]"> {{ t('work.title') }} </h2>
    <p> {{ t('work.subtext') }} </p>
  </div>
  <div class="grid grid-col-1 lg:grid-cols-2 grid-rows 5 gap-2 lg:gap-6 px-3 lg:px-9 lg:pb-10">
    <div v-for="jobCard in jobCardList">
      <JobCard :job="jobCard"/>
    </div>
  </div>
</template>

<style scoped>

</style>