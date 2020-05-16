<template>
  <draggable class="ul-nested" tag="ul" :list="tasks" :options="{animation:200}" :group="{ name: 'g1' }">
    <li class="li-nested" v-for="el in tasks" :key="el.name">
      <p class="p-nested">{{ el.name }}</p>
      <!-- <p>{{el.children}}</p> -->
      <nested-draggable :tasks="el.children" />
    </li>
  </draggable>
</template>

<script>
import draggable from "vuedraggable";
export default {
  props: {
    tasks: {
      required: false,
      type: Array
    }
  },
  components: {
    draggable
  },
  name: "nested-draggable",
  created: function() {
    console.log("Nested:",this.tasks)
  }
};
</script>
<style>
    .ul-nested, .li-nested{
        list-style-type: none; 
        list-style-position: inside;
        margin: 0;
        padding: 0;
    }
    .li-nested{
        background: yellow;
        border: 1px solid black;
        float:left;
        list-style-type: none;
    }
    .p-nested{
        padding: 5px 50px;
    }
</style>
