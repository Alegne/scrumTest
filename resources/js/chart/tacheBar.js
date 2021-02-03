import { HorizontalBar } from 'vue-chartjs'
import UrlStore from "../stores/UrlStore";

export default {

  extends: HorizontalBar,

  data: () => ({
    Url: UrlStore.data,
    nbEtatTache: null,
    i : null,
    
    chartdata: {
      labels: ['Ouvert', 'En cours', 'Terminé'],
      datasets: [
        {
          label: ['Repartition des taches selon son status'],
          backgroundColor: ['#0000ff', '#00FF00', '#999999'],
          data: [ ]
        },
        
      ],
    },

    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  }),

  mounted () {
    axios.get(this.Url.url + '/tacheDash/')
    .then(response => {
        this.i = 0
        this.nbEtattache = response.data
        this.renderChart(this.chartdata, this.options)
        this.nbEtatache.forEach(element => {
            this.chartdata.datasets[0].data[this.i] = element.nbEtat;
            this.i = this.i + 1;
        });
    })
    .catch(error => console.log(error));   
  }
}
