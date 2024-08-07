<template>
    <div class="card px-3">
        <div class="row">
            <div class="col-md-6 mb-3 my-md-auto">
                <h5 class="card-header">{{ __('Update Phase',this.lang)+'  '+ this.station_name }}</h5>
            </div>
            <div class="col-md-6 mb-3 my-md-auto text-end">
                <button type="button" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#modalCreatephase">
                    <i class="fas fa-plus align-items-center me-1"></i> <span class=" align-items-center">{{ __('Create phase Station', this.lang) }}</span>
                </button>
            </div>
        </div>
        <div class="modal fade" id="modalCreatephase" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreatephaseTitle">{{ __('Create phase Station', this.lang) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="updateUser_easy">
                        <form @submit.prevent="AddPhase()" enctype="multipart/form-data">
                            <span v-if="flashMsg.error" class="text-danger font-12 mb-3 d-block">{{ flashMsg.error }}</span>
                            <div class="row g-2">
                                <div class="col-6 mb-0">
                                    <label class="form-label">{{ __('Last Date', this.lang) }}</label>
                                    <input type="datetime-local" value="" v-model="phase.last_date"
                                           class="form-control" :placeholder="__('last_date', this.lang)">
                                    <span v-if="flashMsg.message && flashMsg.message.last_date" class="text-danger font-12 fw-400">{{ flashMsg.message.last_date[0] }}</span>
                                </div>
                                <div class="col-6 mb-0">
                                    <label class="form-label">{{ __('Next Date', this.lang) }}</label>
                                    <input type="datetime-local" v-model="phase.next_date"
                                           class="form-control" :placeholder="__('Next Date', this.lang)">
                                    <span v-if="flashMsg.message && flashMsg.message.next_date" class="text-danger font-12 fw-400">{{ flashMsg.message.next_date[0] }}</span>
                                </div>
                                <div class="col-4 mb-0">
                                    <label class="form-label">{{ __('Time', this.lang) }}</label>
                                    <input type="number" v-model="phase.time"
                                           class="form-control" min="1" :placeholder="__('Time', this.lang)">
                                    <span v-if="flashMsg.message && flashMsg.message.time" class="text-danger font-12 fw-400">{{ flashMsg.message.time[0] }}</span>
                                </div>
                            </div>
                            <div class="modal-footer px-0 mb-0 pb-0 mt-2">
                                <button type="button" class="btn btn-outline-secondary" id="CloseCreatePhase" data-bs-dismiss="modal">{{ __('Close',this.lang)}}</button>
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
                    <th>{{ __('Last Date', this.lang) }}</th>
                    <th>{{ __('Next Date', this.lang) }}</th>
                    <th>{{ __('Time', this.lang) }}</th>
                    <th>{{ __('Action', this.lang) }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <tr v-if="phases.length === 0" class="">
                    <td colspan="4" class="text-danger">{{ __('Data is null',this.lang)}}</td>
                </tr>
                <tr v-for="(phase, index) in phases" :key="phase.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ phase.last_date }}</td>
                    <td><span class="badge bg-label-primary me-1">{{ phase.next_date }}</span></td>
                    <td><span class="badge bg-label-primary me-1">{{ phase.time }}</span></td>
                    <td>
                        <!--                        <a :href="station_show+'/'+station.id" class="btn btn-primary ms-1 px-2">-->
                        <!--                            <i class="fas fa-eye-alt"></i>-->
                        <!--                        </a>-->
                        <!--                        <button type="button" @click="editUser(station.id, index)" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#modalCenter">-->
                        <!--                            <i class="fas fa-edit"></i>-->
                        <!--                        </button>-->

                        <button type="button" @click="deletePhase(phase.id,index)" class="btn btn-primary ms-1 px-2" data-bs-toggle="modal" data-bs-target="#modalCenterDelete">
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
                            <h5 class="modal-title" id="modalCenterTitleDelete">{{ __('Delete Phase',this.lang)}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center mb-0">{{ __('Are you sure to delete ?',this.lang)}}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="CloseDeletePhase" data-bs-dismiss="modal" >{{ __('Close',this.lang)}}</button>
                            <button type="button" class="btn btn-danger" @click="DestroyPhase">{{ __('Yes , Delete',this.lang)}}</button>
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
        'station_name',
        'station_id',
        'phases_data',
        'phase_add',
        'phase_delete',
        'lang',
    ],
    data() {
        const phase = reactive({
            last_date: '',
            time: '',
            next_date: '',
        })

        const del_id = null;

        return {
            phases: [],
            // stations_update: [],
            phase,
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
        async getPhase() {
            this.loading = true;
            axios.get(this.phases_data+'/'+this.station_id)
                .then(response => {
                    this.phases = response.data.data;
                    this.loading = false;
                    if (response.data.data_count === this.phases.length) {
                        this.finished = true;
                    }
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                });
        },
        async AddPhase() {
            this.loading_create = true;
            let formData = new FormData();
            formData.append('last_date', this.phase.last_date ? this.phase.last_date : '');
            formData.append('time', this.phase.time ? this.phase.time : '');
            formData.append('next_date', this.phase.next_date ? this.phase.next_date : '');
            formData.append('station_id', this.station_id ? this.station_id : '');
            const config = {
                headers: {'content-type': 'multipart/form-data','Accept-Language': this.lang}
            }
            axios.post(this.phase_add, formData, config)
                .then((res) => {
                    if (this.phases.length + 1 === res.data.data_count) {
                        this.phases.push(res.data.data)
                    }
                    this.showModal = false;
                    this.phase = []
                    document.getElementById('CloseCreatePhase').click();
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
        async deletePhase(id , index) {
            this.del_id = id;
            this.key_index = index;
        },
        async DestroyPhase() {
            this.loading_delete = true;
            const config = {
                headers: {'Accept-Language': this.lang}
            }
            axios.post(this.phase_delete + '/' + this.del_id , {},config)
                .then((res) => {
                    this.phases.splice(this.key_index, 1)
                    document.getElementById('CloseDeletePhase').click();
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
        this.getPhase();
        this.__ = window.__;
    },
}
</script>
