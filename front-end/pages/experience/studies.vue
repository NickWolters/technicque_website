<script setup lang="ts">
  import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
  } from '@/components/shadcn/card'

  interface Study {
      id: number,
      title: string,
      description: string,
      degree_type: string,
      start_month: number,
      stop_month: number,
      start_year: number,
      stop_year: number,
  }

  const { data } = await useFetch('http:localhost:8000/api/study');
  const studyArray = data.value as Array<Study>;

  const { t } = useI18n();

  const studyCardList = studyArray.map((value, index) => {
      const {data: icon, refresh} = useFetch(`http://localhost:8000/api/study/${value.id}/download`, {
          onResponseError: function ({response}) {
            console.log(response);
          }
    });

    return {
      study: value,
      iconUrl: icon.value
    }
  })
</script>



<template>
  <div class="justify-center px-8 flex flex-col items-center pb-10">
    <h2 class="p-8 font-medium text-4xl text-[#808000]">{{ t('studies.title') }}</h2>
    <p>{{ t('studies.subtext') }}</p>
  </div>
  <div class="grid grid-cols-1 lg:grid-cols-2 grid-rows 5 gap-6 px-2 lg:px-9 lg:pb-10" >
    <div v-for="studyCard in studyCardList">
      <div class="card_outline">
        <Card class="bg-[#F4EFE6] align-center flex">
          <CardHeader class="flex flex-col content-center text-sm">
            <img v-if="studyCard.iconUrl != null" class="p-1 pb-4" :src='studyCard.iconUrl'/>
            <div class="grid grid-cols-5 grid-rows-2 gap-4">
              <div class="col-span-4">
                <CardTitle>{{ studyCard.study.title }}</CardTitle>
              </div>
              <div class="col-span-4 col-start-1 row-start-2">
                <CardDescription>{{ studyCard.study.degree_type }}</CardDescription>
              </div>
              <div class="col-start-5 row-start-1 text-sm">
                <p><b>From:</b> {{ `${studyCard.study.start_month} / ${studyCard.study.start_year}` }}</p>
              </div>
              <div class="col-start-5 row-start-2 text-sm">
                <p><b>To:</b> {{ `${studyCard.study.stop_month} / ${studyCard.study.stop_year}` }}</p>
              </div>
            </div>
          </CardHeader>
          <Separator class="mx-2 lg:mx-6 !w-9/10" />
          <CardContent class="grid gap-4 text-sm">
            <span v-html="studyCard.study.description"></span>
          </CardContent>
        </Card>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>