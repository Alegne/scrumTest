<template>
    <div class="container-fluid sidebar-sticky">
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
            <h2>Liste des Activités</h2>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
                <AddActivite-component></AddActivite-component>
            </form>
            
        </nav>

        <div class="row" style="padding:0.5em">
            <div class="col-sm-3" v-for="activite in activites" :key="activite.id">
                <div class="card text-white bg-primary mb-3" style="width: 18rem; height:19rem">
                    <div class="card-header"><h4>{{activite.name}}</h4></div>
                    <div class="card-body">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{activite.description}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <em>100% Terminé</em>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</template>




<script>

    import UrlStore from "../stores/UrlStore";
    import AddActiviteComponent from './AddActiviteComponent.vue'

    export default {

        components:{
            AddActiviteComponent,
        },

        data(){
            return{
                activites: {},
                Url: UrlStore.data,
                activiteName:'',
                activiteDescription: '',
            }
        },

        created(){//recuperation des donnees envoyee par ActiviteController@index
            axios.get(this.Url.url + '/activiteListe')
                .then(response => this.activites = response.data)
                .catch(error => console.log(error));

        },

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            

            refresh(activites){
                this.activites = activites.data;
            },
        },
    }
</script>