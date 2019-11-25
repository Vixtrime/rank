<template>
    <v-app id="inspire">
        <seo-api-task></seo-api-task>
        <seo-api-reviews></seo-api-reviews>
    </v-app>
</template>

<script>
    import seoApiTask from "./components/seoApiTask/seoApiTask";
    import seoApiReviews from "./components/seoApiReview/seoApiReviews";

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