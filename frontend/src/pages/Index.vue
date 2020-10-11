<template>
  <div>
    <searchbar
      @search="search"
      title="Desenvolvedores"
      xsTitle="DEV"
    ></searchbar>
    <developer-list :developers="developers" :loading="loading" />
    <div class="q-px-lg q-pt-md text-right" style="">
      <q-btn fab icon="add" color="secondary" @click="$router.push({ name: 'createDeveloper' })" />
    </div>
    
    <div class="q-pb-lg flex justify-center">
      <q-pagination
        v-model="params.page"
        :max="pagination.lastPage"
        @input="loadData"
        :direction-links="true"
      >
      </q-pagination>
    </div>
  </div>
</template>

<script>
import Searchbar from "../components/Searchbar.vue";
import DeveloperList from "../components/DeveloperList";
import DeveloperEntity from "../entities/DeveloperEntity";
import DeveloperEntityList from "../entities/DeveloperEntityList";
import axios from 'axios';
var cancelToken = axios.CancelToken.source()
export default {
  name: "PageIndex",
  components: { Searchbar, DeveloperList },
  data() {
    return {
      searchString: "",
      developers: new DeveloperEntityList(),
      params: { perPage: 8, page: 1 },
      pagination: { lastPage: 1, total: 0 },
      loading: false,
      cancelToken: null
    };
  },
  methods: {
    search(queryString) {
      this.params.q = queryString;
      this.loadData();
      this.params.page = 1;
    },
    loadData() {
      if(cancelToken){
        cancelToken.cancel("canceled");
        cancelToken = axios.CancelToken.source();
      }
      this.developers = new DeveloperEntityList();
      this.loading = true;
      this.$axios
        .get("developers", { params: this.params, cancelToken: cancelToken.token })
        .then(({ data }) => {
          let developers = data.data.map((developer) => {
            return new DeveloperEntity(developer);
          });

          this.developers = new DeveloperEntityList(developers);
          this.pagination.lastPage = data.last_page;
          this.pagination.total = data.total;
          this.loading = false;
        })
        .catch((error) => {
          if(error.message !== "canceled"){
            this.loading = false;
          }
        })
    },
  },
  mounted() {
    this.loadData();
  },
};
</script>
