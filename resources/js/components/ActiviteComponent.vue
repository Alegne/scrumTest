<template>

    <div class="container-fluid sidebar-sticky">
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
            <h2>Liste des Activités {{' '}}<span class="badge badge-secondary">{{activites.length}}</span></h2>
            <form class="form-inline">
                <input class="form-control mr-md-2" type="search" placeholder="Recherche" aria-label="Search" style="width: 20.60rem;" @keyup="searchActivite" v-model="q">
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter" @click="init">
                <i class="fas fa-plus-circle" style="font-size:2em; margin:0.05em"></i>
            </button>
            </form>
            
        </nav>

        <div class="row" style="padding:0.5em">
            <div class="col-md-3" v-for="activite in activites" :key="activite.id">
                <div class="card text-white bg-primary mb-2" style="height:19rem">
                    <router-link to="/tache" class="text-white">
                        <div class="card-header overflow-auto"><h5>{{activite.name}}</h5></div>
                    </router-link>
                    <div class="card-body overflow-auto">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{activite.description}}</p>
                    </div>
                
                    <div class="card-footer text-muted d-flex justify-content-between align-item-center ">
                        <em>100% Terminé</em>
                        <div>
                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModalCenter" @click="edit(activite.id)" > 
                                <EditIcon stroke="#00FF00"/>
                            </button>
                            <button type="button" class="btn btn-sm form-inline" @click="activiteDelete(activite.id)" >
                                <Trash2Icon stroke="#FF0000"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <router-view></router-view>
        </div>  

        <!-- Modal Ajour-->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ajout d'une activité</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nameActivite">Nom de l'activité</label>
                                <input type="text" class="form-control" id="nameActivite" aria-describedby="nameActivite" placeholder="Nom de l'activité" maxlength="35" v-model="activiteName" required>
                                <small id="nameActivite" class="form-text text-muted">Precisez le nom de votre activité.</small>
                            </div>
                            <div class="form-group">
                                <label for="activiteDescription">Déscription:</label>
                                <textarea class="form-control" id="activiteDescription" placeholder="Description de l'activité" v-model="activiteDescription"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success" @click="activiteStore" data-dismiss="modal">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal edit-->
        <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLongTitle">Edition d'une activité</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nameActivite">Nom de l'activité</label>
                                <input type="text" class="form-control" id="nameActivite" aria-describedby="nameActivite" placeholder="Nom de l'activité" maxlength="35" v-model="activiteName" required>
                                <small id="nameActivite" class="form-text text-muted">Precisez le nom de votre activité.</small>
                            </div>
                            <div class="form-group">
                                <label for="activiteDescription">Déscription:</label>
                                <textarea class="form-control" id="activiteDescription" placeholder="Description de l'activité" rows="5" v-model="activiteDescription"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success" @click="activiteUpdate" data-dismiss="modal">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>




<script>

    import UrlStore from "../stores/UrlStore";
    import { EditIcon, Trash2Icon } from "vue-feather-icons";

    export default {

        components:{
            EditIcon,
            Trash2Icon,
        },

        data(){
            return{
                activites: {},
                Url: UrlStore.data,
                id: '',
                activiteName: '',
                activiteDescription: '',
                q: '',
            }
        },

        created(){//recuperation des donnees envoyee par ActiviteController@index
            axios.get(this.Url.url + '/activiteListe')
                .then(response => this.activites = response.data)
                .catch(error => console.log(error));

        },

        methods:{
            activiteStore(){
                    if (this.activiteName != '') {
                        axios.post(this.Url.url + '/activiteListe', {
                        name: this.activiteName,
                        description: this.activiteDescription,
                        etat_id: 1,
                        })
                        .then(response => this.$emit('activite-liste', response.data))
                        .catch(error => console.log(error));
                    }
                    axios.get(this.Url.url + '/activiteListe')
                    .then(response => this.activites = response.data)
                    .catch(error => console.log(error));
                        
            },

            activiteUpdate(){
                 if (this.activiteName != '') {
                        axios.patch(this.Url.url + '/activiteListe/' + this.id, {
                        name: this.activiteName,
                        description: this.activiteDescription,
                        })
                        .then(response => this.$emit('activite-liste', response.data))
                        .catch(error => console.log(error));
                    }
                    axios.get(this.Url.url + '/activiteListe')
                    .then(response => this.activites = response.data)
                    .catch(error => console.log(error));
            },

            activiteDelete(key){
                if (confirm("Veuillez confirmer la suppression.")) {
                  if(key){
                      axios.delete(this.Url.url + '/activiteListe/' + key)
                      .then(response => console.log(response.data))
                      .catch(error => console.log(error));
                  }
                    axios.get(this.Url.url + '/activiteListe')
                    .then(response => this.activites = response.data)
                    .catch(error => console.log(error));  
                }
            },

            edit(key){
                this.activites.forEach(element => {
                    if (element.id === key) {
                        this.id = element.id;
                        this.activiteName = element.name;
                        this.activiteDescription = element.description;
                    }
                });
            },

            init(){
                this.activiteName = '';
                this.activiteDescription='';
                this.id = '';
            },

            searchActivite(){
                if (this.q.length >= 2) {
                    axios.get(this.Url.url + '/activiteListe/' + this.q)
                        .then(response => this.activites = response.data)
                        .catch(error => console.log(error));
                } else {
                    axios.get(this.Url.url + '/activiteListe')
                        .then(response => this.activites = response.data)
                        .catch(error => console.log(error));
                }
            },
        },

        mounted() {
            console.log('Component mounted.')
        },
    }
</script>