<template>
  <q-spinner v-if="loading" color="primary" size="2em" :thickness="2" />
</template>

<script>
export default {
  name: "DeleteDeveloper",
  props: { id: {} },
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    delete() {
      this.$q
        .dialog({
          title: "Excluir devensolvedor?",
          message: "Tem certeza que deseja excluir o desenvolvedor?",
          cancel: true,
          ok: {
            label: "Sim",
            flat: true,
          },
          cancel: {
            label: "Não",
            flat: true,
            color: "negative",
          },
        })
        .onOk(() => {
          this.loading = true;
          this.$axios.delete(`developers/${this.id}`).then(()=>{
            this.$q.notify({
              type: 'positive',
              position: "top",
              message: `Desenvolvedor excluído com sucesso.`
            })
            this.$emit("deleted");
          }).catch(()=>{
            this.$q.notify({
              type: 'negative',
              position: "top",
              message: `Não foi possível executar a ação, tente novamente mais tarde.`
            })
          }).finally(()=>{
            this.loading = false;
          })


          
        })
        .onCancel(() => {
          // console.log('>>>> second OK catcher')
        })
        .onDismiss(() => {
          // console.log('I am triggered on both OK and Cancel')
        });
    },
  },
};
</script>
