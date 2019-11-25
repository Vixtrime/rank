<template>
    <v-container fluid class="px-6 pb-0">
        <v-row>
            <v-col md="6" sm="12">
                <v-card style="margin: 20px">
                    <v-card-actions>
                        <v-row class="pa-4">
                            <v-col sm="6">
                                <v-text-field v-model="form.formSchema.key" label="Keyword"></v-text-field>
                            </v-col>
                            <v-col sm="6">
                                <v-text-field v-model="form.formSchema.site" label="Website Name"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                    <v-card-actions>
                        <v-row class="pa-4">
                            <v-col sm="6">
                                <v-select v-model="form.formData.seSelected" label="Seo Engine"
                                          :items="this.form.formData.se"
                                          item-text="name"
                                          item-value="id"
                                          persistent-hint
                                          return-object>
                                </v-select>
                            </v-col>
                            <v-col sm="6">
                                <v-select v-model="form.formData.locSelected" label="Location"
                                          :items="this.form.formData.loc"
                                          item-text="locNameCanonical"
                                          item-value="id"
                                          persistent-hint
                                          return-object>
                                </v-select>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                    <v-divider></v-divider>
                    <v-card-actions class="pa-3">
                        <v-spacer></v-spacer>
                        <div class="pr-3">{{ btnInfo }}</div>
                        <v-btn @click="createTask">
                            Submit
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "seoApiTask",
        data() {
            return {
                app: {},
                btnInfo: null,
                form: {
                    formData: {
                        se: [],
                        loc: [],
                        seSelected: {},
                        locSelected: {},
                    },
                    formSchema: {}
                }
            }
        },
        created() {
            this.getForm().then((response) => {
                this.form.formData.se = Array.from(response.data.formData.se);
                this.form.formData.loc = Array.from(response.data.formData.loc);
                this.form.formSchema = response.data.formSchema;
            });
        },
        methods: {
            getForm() {
                return axios.get('seo-api/data-for-seo/rank/form');
            },
            createTask() {
                this.prepareTaskForm();
                axios.post('/seo-api/data-for-seo/rank/seo-task', {
                    taskForm: this.form.formSchema
                }).then((response) => {
                    this.btnInfo = response.data.message;
                    if (response.data.success) {
                        this.clearFormFields();
                    }
                });
            },
            prepareTaskForm() {
                this.form.formSchema.loc = this.form.formData.locSelected.id;
                this.form.formSchema.se = this.form.formData.seSelected.id;
            },
            clearFormFields() {
                this.form.formData.locSelected = {};
                this.form.formData.seSelected = {};
                this.form.formSchema.key = [];
                this.form.formSchema.site = [];
            }
        }
    }
</script>

<style scoped>

</style>