<template>
    <div class="container">
        <div class="loader" v-if="docs.length == 0">
            <Loader />
        </div>
        <table v-else class="crm-table">
            <thead>
            <th>File</th>
            <th>Is approved</th>
            <th>Is Rejected</th>
            <th>Type</th>
            <th>Comments</th>
            <th>Created At</th>
            </thead>
            <tbody>
            <tr v-for="(doc, index) in (docs)" :key="index">
                <td><span class="link" @click="showFile(doc)">{{ doc.file_name }}</span></td>
                <td>
                    <user-param-toggle
                        :param-name="'is_doc_approved'"
                        :status="doc.is_approved == true ? 1 : 0"
                        :user-id="doc.user_id"
                        :entity-id="doc.id"
                        :label="{checked: 'Yes', unchecked: 'No'}"
                    />
                </td>
                <td>
                    <user-param-toggle
                        :param-name="'is_doc_rejected'"
                        :status="doc.is_rejected == true ? 1 : 0"
                        :user-id="doc.user_id"
                        :entity-id="doc.id"
                        :color="{checked: '#FF0000'}"
                        :label="{checked: 'Yes', unchecked: 'No'}"
                    />
                </td>
                <td>{{ doc.type }}</td>
                <td>{{ doc.comments }}</td>
                <td>{{ doc.created_at }}</td>
            </tr>
            </tbody>
        </table>
        <button v-on:click="showForm" class="btn-show-form mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
            <i class="material-icons">add</i>
        </button>

        <div class="cover" v-if="renderForm">
            <div class="form-slot">
                <form method="post" @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="doc" type="file" id="doc">
                        <label class="mdl-textfield__label" for="doc">File</label>
                        <span class="mdl-textfield__error"></span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="type" v-model="form.type" type="text" id="type">
                        <label class="mdl-textfield__label" for="type">Doc type</label>
                        <span class="mdl-textfield__error"></span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="comments" type="text" v-model="form.comments" id="comments">
                        <label class="mdl-textfield__label" for="comments">Comments</label>
                        <span class="mdl-textfield__error"></span>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell-3">
                            <button type="submit" :disabled="disabledSubmit" class="mdl-button mdl-js-button mdl-button--colored">Save</button>
                        </div>
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-cell-5">
                            <button type="button" class="mdl-button mdl-js-button" v-on:click="hideForm">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Loader from "./Loader";
    import axios from "axios";
    import { show_form_errors } from "../utils";
    export default {
        name: "UserAuthDocs",
        components: {Loader},

        props: ['userId'],

        data() {
            return {
                renderForm: false,
                disabledSubmit: false,

                docs: [],

                form: {
                    type: null,
                    comments: null
                }
            }
        },

        mounted() {

            let _self = this;

            axios.get('/dashboard/crm_api/auth_docs/' + this.$props.userId)
                .then((response) => {
                    _self.docs = response.data.data;
                }).catch((err) => {
                    alert("Something went wrong.\nPlease try again later");
                    console.log(err);
            });
        },

        methods: {
            showForm() {
                this.renderForm = true;
            },

            hideForm() {
                this.renderForm = false;
            },

            submitForm() {
                this.disabledSubmit = true;

                let formData = new FormData();

                let file = this.$el.querySelector('form').querySelector('input[type=file]');
                formData.append('doc', file.files[0]);
                formData.append('type', this.form.type);
                formData.append('comments', this.form.comments);
                formData.append('user_id', this.$props.userId);

                let _self = this;

                axios.post('/dashboard/crm_api/auth_docs', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                        console.log(response);
                        _self.hideForm();
                    }).catch((err) => {
                    _self.disabledSubmit = false;

                    if (err.response && err.response.status === 422) {
                        show_form_errors(_self.$el.querySelector('form'), err.response.data.errors);
                    } else {
                        _self.clearFormData()
                    }
                });
            },

            clearFormData() {
                this.form.type = null;
                this.form.comments = null;

                this.$el.querySelector('form').querySelector('input[type=file]').value = '';
            },

            showFile(doc) {
                window.open('/dashboard/user/' + this.$props.userId + '/doc/' + doc.id, "width=400,height=300");
            }
        },

        updated: function () {

            let _self = this;

            this.$nextTick(function () {
                componentHandler.upgradeElements(_self.$el);
            })
        }
    }
</script>

<style scoped>

    .loader {
        width: 35px;
        height: 35px;
    }

    .container {
        position: relative;
        min-height: 200px;
    }

    .btn-show-form {
        position: absolute;
        right: 1rem;
        bottom: 0rem;
    }

    .mdl-button--fab {
        width: 24px;
        height: 24px;
        min-width: 0;
    }

    .mdl-textfield {
        display: block;
    }

    .form-slot {
        min-width: 200px;
        width: 30%;
        -webkit-box-shadow: -1px 6px 17px -9px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 6px 17px -9px rgba(0,0,0,0.75);
        box-shadow: -1px 6px 17px -9px rgba(0,0,0,0.75);
        padding: 1rem;
        position: relative;
        top: 30%;
        left: 30%;
        z-index: 99999997;
    }

    /*.cover {
        position: fixed;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(100, 100, 100, 0.5);
    }*/

</style>

