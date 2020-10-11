<template>
  <q-item
    v-if="!destroyed"
    clickable
    v-ripple
    class="q-py-md developer-item"
    @click="
      $router.push({ name: 'editDeveloper', params: { id: developer.getId() } })
    "
  >
    <q-item-section avatar>
      <q-avatar color="secondary" text-color="white">
        <span class="text-uppercase">{{ developer.getNome()[0] }}</span>
      </q-avatar>
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ developer.getNome() }}</q-item-label>
      <q-item-label caption>
        <q-icon name="cake" /> {{ developer.getIdade() }} anos
        <q-icon name="sports_esports" /> {{ developer.getHobby() }}
      </q-item-label>
    </q-item-section>
    <q-item-section top side>
      <div class="text-grey-8 q-gutter-xs">
        <q-btn
          class="delete-developer"
          flat
          dense
          round
          icon="delete"
          @click.stop="$refs.deleteDeveloper.delete"
        />
      </div>
    </q-item-section>
    <delete-developer
      ref="deleteDeveloper"
      @deleted="destroyMyself"
      :id="developer.getId()"
    />
  </q-item>
</template>
<style>
@media screen and (min-width: 761px) {
  .delete-developer {
    opacity: 0;
    transition: opacity 0.1s;
  }
  .developer-item:hover .delete-developer {
    opacity: 1;
  }
}
</style>
<script>
import DeveloperEntity from "../entities/DeveloperEntity";
import DeleteDeveloper from "../components/DeleteDeveloper";

export default {
  name: "DeveloperListItem",
  components: {
    DeleteDeveloper,
  },
  props: {
    developer: {
      type: DeveloperEntity,
    },
  },
  data() {
    return {
      destroyed: false,
    };
  },
  methods: {
    destroyMyself() {
      this.destroyed = true;
    },
  },
};
</script>
