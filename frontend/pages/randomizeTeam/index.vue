<template>
  <div>
    <randomizeTeamForm/>
  </div>
</template>

<script>
import axios from 'axios';
import randomizeTeamForm from '~/components/randomize/randomizeTeam/randomizeTeamForm';

export default {
  auth:false,
  mixins: [
  
  ],
  
    
  head() {
      return {
          title: "Randomize Team"
      }
  },

  components: {
    randomizeTeamForm,
  },

  data() {
    return {
    
    }
  },

  created() {

  },

  methods: {
  }
}
</script>

<style>

</style>
