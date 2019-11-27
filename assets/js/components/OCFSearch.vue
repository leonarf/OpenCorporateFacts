
<template>
  <div class="searchInOCF">
  <input v-on:keyup.enter="searchCompanies" v-model="searchedName" type="text" id="searchBar" autofocus>
  <button v-on:click="searchCompanies">Rechercher</button>
    <template v-for="company in companiesMatching">
      <a v-if="company.ComptesDeResultats.length >= 0" :href="company.url"><li>{{ company.Name }} dans le secteur '{{ company.IndustryCode }}' avec {{ company.ComptesDeResultats.length }} bilan comptable en base</li></a>
    </template>
    <template v-if="companiesMatching.length > 0 && searchedName.length > 0">
      <p > {{ totalResult }} résultats, en incluant les entreprises sans comptes de résultat disponible</p>
      <p><button v-if="previousPage != ''" v-on:click="goToPreviousPage"><</button> page {{ currentPageNumber }} <button v-if="nextPage != ''" v-on:click="goToNextPage">></button></p>
    </template>
  </div>
</template>

<script>
import axios from 'axios'
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
const routes = require('../../../public/js/fos_js_routes.json');
Routing.setRoutingData(routes);

export default {
  name: 'searchInOCF',
  data () {
    return {
      companiesMatching: [],
      searchedName : '',
      totalResult : 0,
      currentPageNumber : 1,
      previousPage :'',
      nextPage :''
    }
  },
  methods: {
    sortResults : function (companyA, companyB) {
                    if (companyB.ComptesDeResultats.length < companyA.ComptesDeResultats.length){
                      return -1;
                    }
                    else if (companyB.ComptesDeResultats.length > companyA.ComptesDeResultats.length) {
                      return 1;
                    }
                    return 0;
                  },
    searchCompanies: function () {
      axios.get('api/corporates?Name=' + this.searchedName).then(response => {
            this.companiesMatching = response.data["hydra:member"].sort(this.sortResults);
            this.totalResult = response.data["hydra:totalItems"];
            this.nextPage = response.data["hydra:view"]["hydra:next"];
            for (var company of this.companiesMatching) {
              company['url'] = Routing.generate('corporate_show', { 'siren': company.CompanyNumber});
            }
            });
    },
    goToNextPage : function () {
      axios.get(this.nextPage).then(response => {
            this.companiesMatching = response.data["hydra:member"].sort(this.sortResults);
            this.nextPage = response.data["hydra:view"]["hydra:next"];
            this.previousPage = response.data["hydra:view"]["hydra:previous"];
            for (var company of this.companiesMatching) {
              company['url'] = Routing.generate('corporate_show', { 'siren': company.CompanyNumber});
            }
            this.currentPageNumber++;
            });
    },
    goToPreviousPage : function () {
      axios.get(this.previousPage).then(response => {
            this.companiesMatching = response.data["hydra:member"].sort(this.sortResults);
            this.nextPage = response.data["hydra:view"]["hydra:next"];
            this.previousPage = response.data["hydra:view"]["hydra:previous"];
            for (var company of this.companiesMatching) {
              company['url'] = Routing.generate('corporate_show', { 'siren': company.CompanyNumber});
            }
            this.currentPageNumber--;
            });
    }
  }
}
</script>
