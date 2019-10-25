
<template>
  <div class="searchInOCF">
  <input v-on:keyup.enter="searchCompanies" v-model="searchedName" type="text" id="searchBar" autofocus>
  <button v-on:click="searchCompanies">Rechercher</button>
    <li v-for="company in companiesMatching">
      <a :href="company.url">{{ company.Name }} dans le secteur '{{ company.IndustryCode }}' avec {{ company.ComptesDeResultats.length }} bilan comptable en base</a>
    </li>
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
      companiesMatching: Array,
      searchedName : ''
    }
  },
  methods: {
    searchCompanies: function () {
      axios.get('api/corporates?Name=' + this.searchedName).then(response => {
            this.companiesMatching = response.data["hydra:member"];
            for (var company of this.companiesMatching) {
              company['url'] = Routing.generate('corporate_show', { 'id': company.id});
            }
            });
    }
  }
}
</script>
