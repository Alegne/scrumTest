<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-plus-circle" style="font-size:2em; margin:0.05em"></i>
        </button>

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

        data(){
            return {
                activiteName: '',
                activiteDescription: '',
            }
        },
     
        methods:{
            activiteStore(){
                    if (this.name != '') {
                        axios.post(this.Url.url + '/activiteListe', {
                        name: this.name,
                        description: this.activiteDescription,
                        etat_id: 1,
                        })
                        .then(response => this.$emit('activite-liste', response))
                        .catch(error => console.log(error));
                    }
                    
                },
        },

    }
</script>