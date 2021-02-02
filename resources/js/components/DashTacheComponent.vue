<template>
    <div class="container-fluid">
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
          <h2>Resumé graphique d'état des Taches {{' '}}<span class="badge badge-secondary">{{taches.length}}</span></h2>
            <form class="form-inline">
                <select class="custom-select " style="width: 20.60rem;">
                  <router-link to="/dashboard">
                      <button class="btn btn-secondary">Retour</button>
                  </router-link>
                </select>
            </form>        
        </nav>

        <div class="container-fluid">
            <bar-chart/>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
  
import UrlStore from "../stores/UrlStore";
import BarChart from '../chart/tacheBar'

  export default {

    components: {
      BarChart,
    },

    data () {
      return {
        Url: UrlStore.data,
        taches: {},
  
      }
    },

    mounted () {
      axios.get(this.Url.url + '/tacheListe')
          .then(response => this.taches = response.data)
          .catch(error => console.log(error));
    },

    methods: {

    }

  }
</script>
