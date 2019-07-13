<template>
  <GmapMap v-bind:center="center" v-bind:zoom="7" style="width: 500px; height: 300px">
    <GmapMarker
      v-bind:key="index"
      v-for="(m, index) in markers"
      v-bind:position="m.position"
      v-bind:clickable="true"
    />
  </GmapMap>
</template>
<script>
import Vue from "vue";
import * as VueGoogleMaps from "vue2-google-maps";
export default {
  data() {
    return {
      center: { lat: 10.0, lng: 10.0 },
      markers: [
        {
          positition: { lat: 10.0, lng: 10.0 }
        },
        {
          positition: { lat: 11.0, lng: 11.0 }
        }
      ]
    };
  }
};

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyCgwFQtMtDvqg2Bgs8qEbqnOidRUL8sPgc",
    libraries: "places" // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)

    //// If you want to set the version, you can do so:
    // v: '3.26',
  }
});
</script>
