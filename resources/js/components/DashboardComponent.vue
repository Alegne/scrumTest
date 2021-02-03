<template>
    <div class="container-fluid">
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
          <h2>Resumé graphique d'état des activites {{' '}}<span class="badge badge-secondary">{{activites.length}}</span></h2>
            <!--
            <form class="form-inline">
                <select class="custom-select " style="width: 20.60rem;" v-model="tacheCourant">
                  <option disabled value="">Selectionnez une activité</option>
                  <option v-for="activite in activites" :key="activite.id" @click="click(activite.id)">
                    <router-link :to="'/dashTache/'+ activite.id">
                      {{activite.name}}
                    </router-link>
                  </option>
                </select>
            </form>    
            -->    
        </nav>

        <div class="container-fluid">
            <bar-chart/>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
  
import UrlStore from "../stores/UrlStore";
import BarChart from '../chart/activiteBar';

  export default {

    components: {
      BarChart,
    },

    data () {
      return {
        Url: UrlStore.data,
        activites: {},
        tacheCourant:'',
      }
    },

    mounted () {
      axios.get(this.Url.url + '/activiteListe')
          .then(response => this.activites = response.data)
          .catch(error => console.log(error));
    },

    methods: {
     /*
     click(id){
        router.push({ name: 'dashTache', params:{ id: id}})
      }
      */
    }

  }
</script>
