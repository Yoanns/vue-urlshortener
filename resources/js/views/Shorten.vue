<template>
  <div class="links">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <ul v-if="links">
            <li v-if="{ short_link } in links">
                <router-link :to="{ short_link }"> {{ short_link }} </router-link>"
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            links: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.links = null;
            this.loading = true;
            axios
                .get('/api/links')
                .then(response => {
                    console.log(response);
                });
        }
    }
}
</script>
