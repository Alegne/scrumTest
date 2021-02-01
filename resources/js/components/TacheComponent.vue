<template>

    <div class="container-fluid sidebar-sticky">
        
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
            <h2>Les taches de l'activité: {{'this.taches[1].name'+" "}}<span class="badge badge-secondary">{{taches.length}}</span></h2>
            <form class="form-inline">
                <input class="form-control mr-md-2" type="search" placeholder="Recherche" aria-label="Search" style="width: 20.60rem;" @keyup="searchTache" v-model="q">
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter" @click="init">
                <i class="fas fa-plus-circle" style="font-size:2em; margin:0.05em"></i>
            </button>
            </form>
        </nav>

        <dir class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-2 alert alert-primary card" style="min-height:50em">
                        <h3 class="card-header">Ouvert</h3>
                        <draggable class="list-group" :list="tachesOuvert" group="tasks">
                            <div class="list-group-item" v-for="tache in tachesOuvert" :key="tache.id">
                                <div class="card text-white mt-3" style="height:12rem">
                                    <div class="card-header overflow-auto" >
                                        <h5>{{tache.name}}</h5>
                                    </div>
        
                                    <div class="card-body overflow-auto">
                                        <h5 class="card-title">Description:</h5>
                                        <p class="card-text">{{tache.description}}</p>
                                    </div>
                                
                                    <div class="card-footer d-flex justify-content-between align-item-center ">
                                        <em>Auteur</em>
                                        <div>
                                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModalCenter" @click="edit(tache.id)" > 
                                                <EditIcon stroke="#00FF00"/>
                                            </button>
                                            <button type="button" class="btn btn-sm form-inline" data-toggle="modal" data-target="#confirme" @click="edit(tache.id)" >
                                                <Trash2Icon stroke="#FF0000"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-2 alert alert-success card" style="min-height:50em">
                        <h3 class="card-header">En cours</h3>
                        <draggable class="list-group" :list="tachesEncours" group="tasks">
                            <div class="list-group-item" v-for="tache in tachesEncours" :key="tache.id">
                                <div class="card text-white mb-2" style="height:12rem">
                                    <div class="card-header overflow-auto" >
                                        <h5>{{tache.name}}</h5>
                                    </div>
        
                                    <div class="card-body overflow-auto">
                                        <h5 class="card-title">Description:</h5>
                                        <p class="card-text">{{tache.description}}</p>
                                    </div>
                                
                                    <div class="card-footer d-flex justify-content-between align-item-center ">
                                        <em>Auteur</em>
                                        <div>
                                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModalCenter" @click="edit(tache.id)" > 
                                                <EditIcon stroke="#00FF00"/>
                                            </button>
                                            <button type="button" class="btn btn-sm form-inline" data-toggle="modal" data-target="#confirme" @click="edit(tache.id)" >
                                                <Trash2Icon stroke="#FF0000"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="p-2 alert alert-secondary card" style="min-height:50em">
                        <h3 class="card-header">Terminé</h3>
                        <draggable class="list-group" :list="tachesTermine" group="tasks">
                            <div class="list-group-item" v-for="tache in tachesTermine" :key="tache.id">
                                <div class="card text-white mb-2" style="height:12rem">
                                    <div class="card-header overflow-auto" >
                                        <h5>{{tache.name}}</h5>
                                    </div>
        
                                    <div class="card-body overflow-auto">
                                        <h5 class="card-title">Description:</h5>
                                        <p class="card-text">{{tache.description}}</p>
                                    </div>
                                
                                    <div class="card-footer d-flex justify-content-between align-item-center ">
                                        <em>Auteur</em>
                                        <div>
                                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModalCenter" @click="edit(tache.id)" > 
                                                <EditIcon stroke="#00FF00"/>
                                            </button>
                                            <button type="button" class="btn btn-sm form-inline" data-toggle="modal" data-target="#confirme" @click="edit(tache.id)" >
                                                <Trash2Icon stroke="#FF0000"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
            </div>
        </dir>
        

        <!-- Modal Ajour-->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ajout d'une tache</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nameTache">Nom de la tache</label>
                                <input type="text" class="form-control" id="nameTache" aria-describedby="nameTache" placeholder="Nom de la tache" maxlength="35" v-model="tacheName" required>
                                <small id="nameTache" class="form-text text-muted">Precisez le nom de votre tache.</small>
                            </div>
                            <div class="form-group">
                                <label for="tacheDescription">Déscription:</label>
                                <textarea class="form-control" id="tacheDescription" placeholder="Description de la tache" v-model="tacheDescription"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success" @click="tacheStore" data-dismiss="modal">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import UrlStore from "../stores/UrlStore";
    import draggable from 'vuedraggable';
    import { EditIcon, Trash2Icon } from "vue-feather-icons";


    export default {

        components:{
            EditIcon,
            Trash2Icon,
            draggable
        },
        
        data(){
            return {
                Url: UrlStore.data,
                activiteId: this.$route.params.id,
                taches:{},
                q: '',
                tacheName: '',
                tacheDescription: '',
                tachesOuvert: [],
                tachesEncours: [],
                tachesTermine: [],

            }
        },

        created(){//recuperation des donnees envoyee par tacheController@index
            axios.get(this.Url.url + '/tacheListe/'+ this.activiteId)
            .then(response => this.taches = response.data)
            .catch(error => console.log(error));
            
            this.taches.forEach((element) => {
                if (element.etat_id == 1) {
                    this.tachesOuvert.push(element);
                }
                if (element.etat_id == 2) {
                    this.tachesEncours.push(element);
                }
                if (element.etat_id == 3) {
                    this.tachesTermine.push(element);
                }
            });
        },

        methods:{

            tacheStore(){
                if (this.tacheName != '') {
                        axios.post(this.Url.url + '/tacheListe/'+ this.activiteId, {
                        name: this.tacheName,
                        description: this.tacheDescription,
                        etat_id: 1,
                        })
                        .then(response => this.$emit('tache-liste', response.data))
                        .catch(error => console.log(error));
                    }
                    axios.get(this.Url.url + '/tacheListe/'+ this.activiteId)
                    .then(response => this.taches = response.data)
                    .catch(error => console.log(error));
                    this.taches.forEach((element) => {
                        console.log(element)
                        if (element.etat_id == 1) {
                            this.tachesOuvert.push(element);
                        }
                        if (element.etat_id == 2) {
                            this.tachesEncours.push(element);
                        }
                        if (element.etat_id == 3) {
                            this.tachesTermine.push(element);
                        }
                    });
            },

            searchTache(){

            },

            init(){
                this.tacheName = '';
                this.tacheDescription = '';
            },
        },

        mounted(){

        },
        
    }
</script>