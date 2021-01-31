<template>
    
    <div class="container-fluid sidebar-sticky">
        <nav class="navbar navbar-dark sticky-top" style="background-color: rgb(247, 247, 247)">
            <h2>Liste des Taches pour l'activité: </h2>
            <form class="form-inline">
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-plus-circle" style="font-size:2em; margin:0.05em"></i>
            </button>
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

        <!-- Modal -->
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
                                <input type="text" class="form-control" id="nameActivite" aria-describedby="nameActivite" placeholder="Nom de l'activité" maxlength="50" v-model="activiteName" required>
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
                        <button type="submit" class="btn btn-success" @click="activiteStore">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>
    export default {
        
    }
</script>