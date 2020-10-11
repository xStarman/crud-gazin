<template>
  <q-toolbar class="bg-primary text-white shadow-1">
    <q-toolbar-title> 
      <span class="gt-xs">{{ title }}</span>
      <span class="xs">{{xsTitle}}</span>
    </q-toolbar-title>
    <q-input
      ref="searchInput"
      dark
      dense
      standout
      v-model="queryString"
      @input="onSearch"
      input-class="text-right"
      class="q-ml-md"
    >
      <template v-slot:append>
        <q-icon
          v-if="queryString === ''"
          name="search"
          @click="$refs.searchInput.focus()"
        />
        <q-icon
          v-else
          name="clear"
          class="cursor-pointer"
          @click="
            queryString = '';
            onSearch();
          "
        />
      </template>
    </q-input>
  </q-toolbar>
</template>

<script>
export default {
  name: "Searchbar",
  props: { title: {}, xsTitle:{}, minlen: { default: 3 } },
  data() {
    return {
      queryString: "",
    };
  },
  methods: {
    onSearch() {
      if (
        this.queryString.length >= this.minlen ||
        this.queryString.length == 0
      ) {
        this.$emit("search", this.queryString);
      }
    },
  },
};
</script>
