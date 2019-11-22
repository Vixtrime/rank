<template>
    <div>
        <v-card>
            akdnao
            asdad
            asd
        </v-card>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Main",
        data() {
            return {
                app: {},
                form: {
                }
            }
        },
        beforeCreate() {
            axios.get('seo-api/data-for-seo/rank/form').then((response) => {
                this.form = response.data;
            });
        }
    }
</script>

<style scoped>

</style>