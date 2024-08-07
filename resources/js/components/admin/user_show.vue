<template>
    <div class="card px-3">
        <div class="row">
            <div class="col-md-6 mb-3 my-md-auto">
                <h5 class="card-header">{{ __('Station',this.lang)+'  '+ this.user_name }}</h5>
            </div>
            <div class="col-md-6 mb-3 my-md-auto text-end">
                <button type="button" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#modalCreatedessert">
                    <i class="fas fa-plus align-items-center me-1"></i> <span class=" align-items-center">{{ __('Create dessert Station', this.lang) }}</span>
                </button>
            </div>
        </div>
        <div class="modal fade" id="modalCreatedessert" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreatedessertTitle">{{ __('Create dessert Station', this.lang) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="updateUser_easy">
                        <form @submit.prevent="AddDessert()" enctype="multipart/form-data">
                            <span v-if="flashMsg.error" class="text-danger font-12 mb-3 d-block">{{ flashMsg.error }}</span>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Name', this.lang) }}</label>
                                    <input type="text" v-model="dessert.name"
                                           class="form-control" :placeholder="__('Name', this.lang)">
                                    <span v-if="flashMsg.message && flashMsg.message.name" class="text-danger font-12 fw-400">{{ flashMsg.message.name[0] }}</span>
                                </div>
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Number Phase', this.lang) }}</label>
                                    <input type="text" v-model="dessert.phase"
                                           class="form-control" :placeholder="__('Number Phase', this.lang)">
                                    <span v-if="flashMsg.message && flashMsg.message.phase" class="text-danger font-12 fw-400">{{ flashMsg.message.phase[0] }}</span>
                                </div>
                            </div>
                            <div class="modal-footer px-0 mb-0 pb-0 mt-2">
                                <button type="button" class="btn btn-outline-secondary" id="CloseCreateDessert" data-bs-dismiss="modal">{{ __('Close',this.lang)}}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Save changes',this.lang)}} <i v-if="loading_create" class="fas fa-spinner ms-1 fa-spin text-white"></i></button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Name', this.lang) }}</th>
                    <th>{{ __('Number Phase', this.lang) }}</th>
                    <th>{{ __('Action', this.lang) }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <tr v-if="desserts.length === 0" class="">
                    <td colspan="4" class="text-danger">{{ __('Data is null',this.lang)}}</td>
                </tr>
                <tr v-for="(dessert, index) in desserts" :key="dessert.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ dessert.name }}</td>
                    <td><span class="badge bg-label-primary me-1">{{ dessert.phase }}</span></td>
                    <td>
                        <a :href="stations_show+'/'+dessert.id" class="btn btn-primary ms-1 px-2">
                            <i class="fas fa-eye"></i>
                        </a>
<!--                        <button type="button" @click="editUser(user.id, index)" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#modalCenter">-->
<!--                            <i class="fas fa-edit"></i>-->
<!--                        </button>-->

                        <button type="button" @click="deleteDessert(dessert.id,index)" class="btn btn-primary ms-1 px-2" data-bs-toggle="modal" data-bs-target="#modalCenterDelete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>

            <div class="modal fade" id="modalCenterDelete" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitleDelete">{{ __('Delete Dessert',this.lang)}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center mb-0">{{ __('Are you sure to delete ?',this.lang)}}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="CloseDeleteDessert" data-bs-dismiss="modal" >{{ __('Close',this.lang)}}</button>
                            <button type="button" class="btn btn-danger" @click="DestroyDessert">{{ __('Yes , Delete',this.lang)}}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="this.loading === true" id="loader" class="w-100 text-center my-3">
                <i class="fas fa-spinner fa-spin text-primary fa-2x" style="color: #797D90;"></i>
            </div>
            <button type="button" class="btn d-block text-center text-white font-14 fw-400 mx-auto" v-if="!this.finished && !this.loading" @click="plusPage()">Show More</button>
        </div>
    </div>
    <div v-if="showSuccessMsg">
        <alert-message :successMsg="this.successMsg"></alert-message>
    </div>
</template>

<script>
import {reactive} from "vue/dist/vue.esm-bundler";
import AlertMessage from "../layout/alertMessage.vue";
import Modal from "../layout/modal.vue";

export default {
    components: {Modal, AlertMessage},
    props: [
        'user_name',
        'user_id',
        'dessarts_data',
        'stations_show',
        'dessert_add',
        'dessert_delete',
        'lang',
    ],
    data() {
        const dessert = reactive({
            name: '',
            phase: '',
        })

        const del_id = null;

        return {
            desserts: [],
            // users_update: [],
            dessert,
            flashMsg: [],
            showModal: false,
            loading: false,
            // loading_data: false,
            // loading_delete: false,
            // loading_update: false,
            loading_create: false,
            del_id,
            showSuccessMsg: false,
            successMsg: '',
            // image: '',
            finished: false,
            // page: 1,
            key_index: null,
        }
    },

    methods: {
        async getDessert() {
            this.loading = true;
            axios.get(this.dessarts_data+'/'+this.user_id)
                .then(response => {
                    this.desserts = response.data.data;
                    this.loading = false;
                    if (response.data.data_count === this.desserts.length) {
                        this.finished = true;
                    }
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                });
        },
        async AddDessert() {
            this.loading_create = true;
            let formData = new FormData();
            formData.append('name', this.dessert.name ? this.dessert.name : '');
            formData.append('phase', this.dessert.phase ? this.dessert.phase : '');
            formData.append('user_id', this.user_id ? this.user_id : '');
            const config = {
                headers: {'content-type': 'multipart/form-data','Accept-Language': this.lang}
            }
            axios.post(this.dessert_add, formData, config)
                .then((res) => {
                    localStorage.setItem('name', res.data.name);
                    if (this.desserts.length + 1 === res.data.data_count) {
                        this.desserts.push(res.data.data)
                    }
                    this.showModal = false;
                    this.dessert = []
                    document.getElementById('CloseCreateDessert').click();
                    this.loading_create = false;
                    if (res.data.status == 200 && res.data.success == true) {
                        this.showSuccessMsg = true;
                        this.successMsg = res.data.message;
                        setTimeout(() => this.showSuccessMsg = false, 2500);
                    }
                    this.flashMsg.message = ''
                })
                .catch((err) => {
                    this.loading_create = false;
                    if (err.response.data.message){
                        this.flashMsg.message = err.response.data.message;
                    }else if(err.response.data.error){
                        this.flashMsg.error = err.response.data.error;
                    }

                });
        },
        async deleteDessert(id , index) {
        this.del_id = id;
        this.key_index = index;
    },
        async DestroyDessert() {
        this.loading_delete = true;
        const config = {
            headers: {'Accept-Language': this.lang}
        }
        axios.post(this.dessert_delete + '/' + this.del_id , {
            'user_id':this.user_id
        },config)
            .then((res) => {
                localStorage.setItem('name', res.data.name);
                this.desserts.splice(this.key_index, 1)
                document.getElementById('CloseDeleteDessert').click();
                if (res.data.status == 200 && res.data.success == true) {
                    this.loading_delete = false;
                    this.showSuccessMsg = true;
                    this.successMsg = res.data.message;
                    setTimeout(() => this.showSuccessMsg = false, 2500);
                }
                this.flashMsg.error = '';
            })
            .catch((err) => {
                this.loading_delete = false;
                console.log(err);
                this.flashMsg = err.response.data.message;
            });
    }
    },
    async created() {
        this.getDessert();
        this.__ = window.__;
        console.log(typeof this.user);
    },
}
</script>
