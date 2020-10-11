<template>
  <q-layout view="lHh Lpr lFf" style="style: #e2e2e2">
    <q-page-container >
      <q-page class="flex q-pt-xl q-pt-xss-none" >
        <div class="row full-width justify-center items-center full-height ">
          <div class="col-12 col-sm-8 col-md-5 col-lg-4 bg-white">
            <router-view :key="$route.fullPath"/>
          </div>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: "MainLayout",
  data() {
    return {
    };
  },
};
</script>
