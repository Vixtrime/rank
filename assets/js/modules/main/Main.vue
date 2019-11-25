<template>
    <v-app id="inspire">
        <seo-api-task></seo-api-task>
        <seo-api-reviews></seo-api-reviews>
    </v-app>
</template>

<script>
    import axios from 'axios';
    import seoApiTask from "./components/seo-api-task/seoApiTask";
    import seoApiReviews from "./components/seo-api-review/seoApiReviews";

    export default {
        name: "Main",
        components: {
            seoApiTask,
            seoApiReviews,
        }
    }
</script>

<style scoped>

</style>