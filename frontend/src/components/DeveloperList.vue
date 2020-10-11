<template>
  <q-list class="q-pt-md" v-if="developers.getDevelopers().length || loading">
    <developer-list-item
      v-for="(developer, index) in developers.getDevelopers()"
      :developer="developer"
      :key="index"
    />
    <div v-if="loading">
      <q-item
        style="max-width: 60%"
        v-for="(i, index) in [3, 2, 1]"
        :style="{ opacity: i * 0.33 }"
        :key="index"
      >
        <q-item-section avatar>
          <q-skeleton type="QAvatar" />
        </q-item-section>

        <q-item-section>
          <q-item-label>
            <q-skeleton type="text" />
          </q-item-label>
          <q-item-label caption>
            <q-skeleton type="text" width="65%" />
          </q-item-label>
        </q-item-section>
      </q-item>
    </div>
  </q-list>

  <q-list v-else class="q-py-lg q-px-md text-center" :style="{background: 'rgb(243 243 243)'}">
    Nenhum resultado encontrado.
  </q-list>
</template>

<script>
import DeveloperEntityList from "../entities/DeveloperEntityList";
import DeveloperListItem from "../components/DeveloperListItem.vue";

export default {
  name: "DeveloperList",
  components: { DeveloperListItem },
  props: {
    developers: {
      type: DeveloperEntityList,
    },
    loading: {
      default: false,
    },
  },
  data() {
    return {};
  },
  mounted() {
    console.log(this.developers.getDevelopers());
  },
};
</script>
