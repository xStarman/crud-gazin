<template>
  <developer-form title="Cadastrar Desenvolvedor" saveMethod="post" :saveUrl="`developers`"/>
</template>

<script>
import DeveloperEntity from "../entities/DeveloperEntity";
import DeveloperForm from "../components/DeveloperForm.vue";

export default {
  name: "CreateDeveloper",
  components:{ DeveloperForm },
  data() {
    return {
      developer: new DeveloperEntity(),
    };
  },
  methods: {
  },
  mounted() {
  }
};
</script>
