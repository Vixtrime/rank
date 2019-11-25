<template>
    <v-container fluid class="px-6 pt-0">
        <v-row>
            <v-col md="12" sm="12">
                <v-card style="margin: 20px">
                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                            <tr>
                                <th class="text-left">Id</th>
                                <th class="text-left">Key</th>
                                <th class="text-left">Search engine</th>
                                <th class="text-left">Results count</th>
                                <th class="text-left">Results Check Url</th>
                                <th class="text-left">Result snippet</th>
                                <th class="text-left">Result position</th>
                                <th class="text-left">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="task in tasks" :key="task.id">
                                <td>{{ task.apiId }}</td>
                                <td>{{ task.keyValue }}</td>
                                <td>{{ task.name }} (language:{{ task.language }})</td>
                                <td>{{ task.resultsCount }}</td>
                                <td>{{ task.resultSeCheckUrl }}</td>
                                <td>{{ task.resultSnippet }}</td>
                                <td>{{ task.resultPosition     }}</td>
                                <td v-if="task.status === 0">
                                    <v-btn @click="refreshTask(task.id)" class="mx-2" fab dark x-small
                                           color="orange lighten-1">
                                        <v-icon dark>mdi-refresh</v-icon>
                                    </v-btn>
                                </td>
                                <td v-else>
                                    <v-btn class="mx-2" fab dark x-small color="green lighten-1">
                                        <v-icon dark>mdi-check</v-icon>
                                    </v-btn>
                                </td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                    <v-divider></v-divider>
                    <v-card-actions class="pa-3">

                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "seoApiReviews",
        data() {
            return {
                desserts: [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                    },
                ],
                tasks: []
            }
        },
        created() {
            this.getTasks().then((response) => {
                this.tasks = response.data;
            });
            // setInterval(() => {
            //     this.refreshTasks()
            // }, 5000);
        },
        methods: {
            getTasks() {
                return axios.get('/seo-api/data-for-seo/rank/seo-tasks');
            },
            refreshTask(taskId) {
                axios.post('seo-api/data-for-seo/rank/seo-task/' + taskId + '/sync');
                this.refreshTasks();
            },
            refreshTasks() {
                this.getTasks().then((response) => {
                    this.tasks = response.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>