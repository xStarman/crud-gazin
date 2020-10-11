<template>
  <div>
    <q-toolbar class="bg-primary text-white shadow-1">
      <q-btn icon="arrow_back" round flat @click="$router.push('/')" />
      <q-toolbar-title>
        <q-spinner v-if="loading" color="white" size="2em" :thickness="2" />
        <span>{{ title }}</span>
      </q-toolbar-title>
    </q-toolbar>
    <div class="row flex q-pt-lg">
      <div class="col-12 col-md-3 text-center">
        <q-avatar color="secondary" text-color="white" style="font-size: 7em">
          <span class="text-uppercase">
            <span v-if="developer.getNome()">
              {{ developer.getNome()[0] }}
            </span>
            <q-icon v-else name="person" />
          </span>
        </q-avatar>
        <div class="q-pa-sm" v-if="developer.getId()">
          id: {{ developer.getId() }}
        </div>
      </div>
      <q-form
        class="q-gutter-md col-12 col-md-9 q-pb-lg q-px-lg"
        @submit="save"
      >
        <q-input
          v-model="developer.nome"
          label="Nome"
          placeholder="Informe o nome..."
          square
          filled
          stack-label
          :error="!!(errors.nome && errors.nome.length)"
        >
          <template v-slot:error>
            <span v-for="(error, index) in errors.nome" :key="index">
              {{ error }}
            </span>
          </template>
        </q-input>
        <q-input
          v-model="developer.hobby"
          label="Hobby"
          placeholder="Informe o hobby..."
          square
          filled
          stack-label
          :error="!!(errors.hobby && errors.hobby.length)"
        >
          <template v-slot:error>
            <span v-for="(error, index) in errors.hobby" :key="index">
              {{ error }}
            </span>
          </template>
        </q-input>

        <q-input
          filled
          v-model="developer.datanascimento"
          stack-label
          mask="##/##/####"
          label="Nascimento"
          placeholder="Informe a data de nascimento"
          :error="!!(errors.datanascimento && errors.datanascimento.length)"
        >
          <template v-slot:error>
            <span v-for="(error, index) in errors.datanascimento" :key="index">
              {{ error }}
            </span>
          </template>
          <template v-slot:append>
            <q-icon name="event" class="cursor-pointer">
              <q-popup-proxy ref="qDateProxy">
                <q-date v-model="developer.datanascimento" mask="DD/MM/YYYY">
                  <div class="row items-center justify-end">
                    <q-btn v-close-popup label="OK" color="primary" flat />
                  </div>
                </q-date>
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
        <div class="q-pb-xs">
          <div class="bg-grey-2 q-px-md q-pb-md q-pt-sm q-mb-sm">
            <div class="text-caption q-field__label">Gênero</div>

            <q-radio
              v-model="developer.sexo"
              dense
              class="q-mr-sm"
              val="M"
              label="Masculino"
            />
            <q-radio
              v-model="developer.sexo"
              dense
              class="q-mr-sm"
              val="F"
              label="Feminino"
            />
            <q-radio
              v-model="developer.sexo"
              dense
              class="q-mr-sm"
              val="O"
              label="Outro"
            />
          </div>
        </div>
        <div class="text-right">
          <q-btn
            label="Salvar"
            :disable="loading"
            type="submit"
            color="primary"
          />
        </div>
      </q-form>
    </div>
  </div>
</template>

<script>
import DeveloperEntity from "../entities/DeveloperEntity";

export default {
  name: "DeveloperForm",
  props: {
    developer: {
      default: () => new DeveloperEntity(),
      type: DeveloperEntity,
    },
    saveUrl: {},
    saveMethod: { default: "post" },
    title: {},
  },
  data() {
    return {
      loading: false,
      errors: {},
    };
  },
  methods: {
    save() {
      this.loading = true;
      this.$axios[this.saveMethod](this.saveUrl, {
        ...this.developer,
        ...{ datanascimento: this.developer.getDatadascimentoIso() },
      })
        .then(({ status, data }) => {
          this.$q.notify({
            type: "positive",
            position: "top",
            message: `Registro salvo com sucesso.`,
          });
          if (status == 201) {
            this.developer = new DeveloperEntity();
            this.$router.push({
              name: "editDeveloper",
              params: { id: data.id },
            });
          }
        })
        .catch((e) => {
          if (e.response.status == 400) {
            this.errors = e.response.data;
            console.log(this.errors);
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
  mounted() {},
};
</script>
