<template>

    <div class="container-fluid sidebar-sticky">
        
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
            <h2>Les taches de l'activité: {{activite.name+" "}}<span class="badge badge-secondary">{{taches.length}}</span></h2>
            <form class="form-inline">
                <input class="form-control mr-md-2" type="search" placeholder="Recherche" aria-label="Search" style="width: 20.60rem;" @keyup="searchTache" v-model="crit">
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter" @click="init">
                <i class="fas fa-plus-circle" style="font-size:2em; margin:0.05em"></i>
            </button>
            </form>
        </nav>
        
        <div class="row" style="padding:0.5em">
            <div class="col-md-3" v-for="tache in taches" :key="tache.id">
                <div class="card text-white bg-primary mb-2" style="height:19rem" v-if="tache.etat_id ===1">
                    <div class="card-header overflow-auto">
                        <h5>{{tache.name}}</h5>
                    </div>
    
                    <div class="card-body overflow-auto">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{tache.description}}</p>
                    </div>
                
                    <div class="card-footer d-flex justify-content-between align-item-center ">
                        <em>Ouvert</em>
                        <div>
                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModalCenter" @click="edit(tache.id)" > 
                                <EditIcon stroke="#00FF00"/>
                            </button>
                            <button type="button" class="btn btn-sm form-inline" data-toggle="modal" data-target="#confirme" @click="edit(tache.id)">
                                <Trash2Icon stroke="#FF0000"/>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card text-white bg-success mb-2" style="height:19rem" v-if="tache.etat_id ===2">
                    <div class="card-header overflow-auto" >
                        <h5>{{tache.name}}</h5>
                    </div>
                    
                    <div class="card-body overflow-auto">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{tache.description}}</p>
                    </div>
                
                    <div class="card-footer d-flex justify-content-between align-item-center ">
                        <em>En cours</em>
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
                <div class="card text-white bg-secondary mb-2" style="height:19rem" v-if="tache.etat_id ===3">
                        <div class="card-header overflow-auto">
                            <h5>{{tache.name}}</h5>
                        </div>
                    
                    <div class="card-body overflow-auto">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{tache.description}}</p>
                    </div>
                
                    <div class="card-footer d-flex justify-content-between align-item-center ">
                        <em>Terminé</em>
                        <div>
                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#editModalCenter" @click="edit(tache.id)" > 
                                <EditIcon stroke="#00FF00"/>
                            </button>
                            <button type="button" class="btn btn-sm form-inline" data-toggle="modal" data-target="#confirme" @click="edit(tache.id)">
                                <Trash2Icon stroke="#FF0000"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <router-view ></router-view>
        </div>

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

        <!-- Modal de confirmation -->
        <div class="modal fade" id="confirme" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Supppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment confirmer la suppression?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="tacheDelete()">Oui</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal edit-->
        <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLongTitle">Edition d'une tache</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nameTache">Nom de l'activité</label>
                                <input type="text" class="form-control" id="nameTache" aria-describedby="nametache" placeholder="Nom de la tache" maxlength="35" v-model="tacheName" required>
                                <small id="nameTache" class="form-text text-muted">Precisez le nom de votre tache.</small>
                            </div>
                            <div class="form-group">
                                <label for="tacheDescription">Déscription:</label>
                                <textarea class="form-control" id="tacheDescription" placeholder="Description de la tache" rows="3" v-model="tacheDescription"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"  id="flexRadioDefault1" v-model="etat" value=1>
                                    <label class="form-check-label" for="flexRadioDefault1">Ouvert</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"  id="flexRadioDefault2" v-model="etat" value=2>
                                    <label class="form-check-label" for="flexRadioDefault2">En cours</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"  id="flexRadioDefault3" v-model="etat" value=3>
                                    <label class="form-check-label" for="flexRadioDefault3">Terminé</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success" @click="tacheUpdate" data-dismiss="modal">Enregistrer</button>
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
            return {
                etat: '',
                Url: UrlStore.data,
                activiteId: this.$route.params.id,
                taches:{},
                activite:{},
                tachesActivite: {},
                crit: '',
                tacheName: '',
                tacheDescription: '',
                id: '',
                flexRadioDefault: '',
            }
        },

        created(){//recuperation des donnees envoyee par tacheController@index
            this.recuperation();
        },

        methods:{

            recuperation(){
                axios.get(this.Url.url + '/tacheListe/'+ this.activiteId)
                .then(response => {
                    this.tachesActivite = response.data;
                    this.taches = this.tachesActivite.taches;
                    this.activite = this.tachesActivite.activite;
                    })
                .catch(error => console.log(error));
            },

            tacheStore(){
                if (this.tacheName != '') {
                        axios.post(this.Url.url + '/tacheListe/'+ this.activiteId, {
                        name: this.tacheName,
                        description: this.tacheDescription,
                        etat_id: 1,
                        activite_id: this.activiteId,
                        })
                        .then(response => {
                            this.$emit('tache-liste', response.data);
                            this.recuperation();
                            })
                        .catch(error => console.log(error));
                    }
            },

            tacheUpdate(){
                if (this.tacheName != '') {
                        axios.patch(this.Url.url + '/tacheListe/' + this.id, {
                        name: this.tacheName,
                        description: this.tacheDescription,
                        etat_id : this.etat,
                        activite_id: this.activiteId,
                        })
                        .then(response => {
                            this.$emit('tache-liste', response.data)
                            this.recuperation()
                        })
                        .catch(error => console.log(error));
                    }
            },
            tacheDelete(){
                  if(this.id){
                      axios.delete(this.Url.url + '/tacheListe/' + this.id,{
                          activite_id: this.activiteId,
                      })
                      .then(response => {
                          this.recuperation()
                        })
                      .catch(error => console.log(error));
                  }

            },

            edit(key){
                this.taches.forEach(element => {
                    if (element.id === key) {
                        this.id = element.id;
                        this.tacheName = element.name;
                        this.tacheDescription = element.description;
                        this.etat = element.etat_id;
                    }
                });
            },

            searchTache(){
                if (this.crit.length >= 2) {
                    axios.get(this.Url.url + '/tacheListe/'+this.activiteId+'/'+ this.crit)
                        .then(response => {
                            this.tachesActivite = response.data
                            this.taches = this.tachesActivite.taches;
                            this.activite = this.tachesActivite.activite;
                            })
                        .catch(error => console.log(error));
                } else {
                   this.recuperation();
                }
                
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