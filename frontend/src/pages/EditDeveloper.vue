<template>
  <div>
    <q-linear-progress
      indeterminate
      rounded
      color="secondary"
      class=""
      v-if="loading"
    />
    <developer-form
      title="Editar Desenvolvedor"
      :developer="developer"
      saveMethod="put"
      :saveUrl="`developers/${this.$route.params.id}`"
    />
    <div class="q-px-lg q-pb-md q-mr-md text-right">
      <delete-developer
        ref="deleteDeveloper"
        @deleted="$router.push('/')"
        :id="developer.getId()"
      />
      <q-btn
        color="negative"
        v-if="$refs.deleteDeveloper"
        @click="$refs.deleteDeveloper.delete"
        flat
      >
        Excluir
      </q-btn>
    </div>
  </div>
</template>

<script>
import DeveloperEntity from "../entities/DeveloperEntity";
import DeveloperForm from "../components/DeveloperForm.vue";
import DeleteDeveloper from "../components/DeleteDeveloper";

export default {
  name: "EditDeveloper",
  components: { DeveloperForm, DeleteDeveloper },
  data() {
    return {
      developer: new DeveloperEntity(),
      loading: false,
    };
  },
  methods: {},
  mounted() {
    this.loading = true;
    this.$axios
      .get(`developers/${this.$route.params.id}`)
      .then(({ data }) => {
        this.developer = new DeveloperEntity(data);
      })
      .catch((e) => {
        this.$q.notify({
          message: "Desenvolvedor não encontrado.",
          color: "negative",
          position: "top",
        });
        this.$router.back();
      })
      .finally(() => {
        this.loading = false;
      });
  },
};
</script>
