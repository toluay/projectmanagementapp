<template>
  <div class="mcontainer">
 <!-- <body-component></body-component> -->
 <div id="body">
<LeftBody/>
<router-view> <router-view/>
    </div>
  </div>
</template>

<script>
import Body from './Body';
import LeftBody from './LeftBody.vue'
import RightBody from './RightBody.vue'
export default {
  components: {
      Body,
      LeftBody,
      RightBody
  },
};
</script>
<style scoped>

</style>