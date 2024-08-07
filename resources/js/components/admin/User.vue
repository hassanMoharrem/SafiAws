<template>
    <div class="card px-3">
        <div class="row">
            <div class="col-md-6 mb-3 my-md-auto">
                <h5 class="card-header">{{ __('Table', this.lang) }}</h5>
            </div>
            <div class="col-md-6 mb-3 my-md-auto text-end">
                <button type="button" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
                    <i class="fas fa-plus align-items-center me-1"></i> <span class=" align-items-center">{{ __('Create User', this.lang) }}</span>
                </button>
            </div>
        </div>
        <div class="modal fade" id="modalCreateUser" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateUserTitle">{{ __('Create User', this.lang) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <form @submit.prevent="AddUser" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center mb-3">
                                    <div id="file-upload-filename"
                                         class="text-right text-truncate w-75 name-file-upload position-absolute"></div>
                                    <label for="file-upload-communication-comments-create"
                                           class="btn text-muted text-center p-1 mb-0 mx-auto position-relative bg-image-border p-0 bg-sub shadow-sm">
                                        <img id="selected-image" class="w-100 h-100 object-fit-cover" style="display:none;" src="" alt="">
                                    </label>
                                    <small class="text-muted d-block py-2 font-12 fw-light">{{ __('Click to Add Your Profile Image', this.lang) }}</small>

                                    <input type="file" v-on:change="selectedFile" class="input-file start-0 file-upload-communication-comments-create"
                                           id="file-upload-communication-comments-create"/>
                                    <div class="file-upload-filename-communication-comments-create mx-auto w-100 text-truncate"></div>
                                    <span v-if="flashMsg.image"
                                          class="text-danger font-12 fw-400">{{ flashMsg.image[0] }}</span>

                                </div>

                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Name', this.lang) }}</label>
                                    <input type="text" v-model="user.name"
                                           class="form-control" :placeholder="__('Name', this.lang)">
                                    <span v-if="flashMsg.name" class="text-danger font-12 fw-400">{{ flashMsg.name[0] }}</span>
                                </div>
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Number System', this.lang) }}</label>
                                    <input type="text" v-model="user.num_system"
                                           class="form-control" :placeholder="__('Number System', this.lang)">
                                    <span v-if="flashMsg.num_system" class="text-danger font-12 fw-400">{{ flashMsg.num_system[0] }}</span>
                                </div>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Email', this.lang) }}</label>
                                    <input type="email" v-model="user.email"
                                           class="form-control" :placeholder="__('Email', this.lang)">
                                    <span v-if="flashMsg.email"
                                          class="text-danger font-12 fw-400">{{ flashMsg.email[0] }}</span>
                                </div>
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Phone', this.lang) }}</label>
                                    <input type="text" v-model="user.phone"
                                           class="form-control" :placeholder="__('Phone', this.lang)">
                                    <span v-if="flashMsg.phone" class="text-danger font-12 fw-400">{{ flashMsg.phone[0] }}</span>
                                </div>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col mb-0">
                                    <label class="form-label">{{ __('Password', this.lang) }}</label>
                                    <input type="password" v-model="user.password"
                                           class="form-control" placeholder="*******">
                                    <span v-if="flashMsg.password"
                                          class="text-danger font-12 fw-400">{{ flashMsg.password[0] }}</span>
                                </div>
                            </div>
                            <div class="modal-footer px-0 mb-0 pb-0 mt-2">
                                <button type="button" class="btn btn-outline-secondary" id="CloseCreateUser" data-bs-dismiss="modal">{{ __('Close',this.lang)}}</button>
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
                    <th>{{ __('Number System', this.lang) }}</th>
                    <th>{{ __('Email', this.lang) }}</th>
                    <th>{{ __('Phone', this.lang) }}</th>
                    <th>{{ __('Action', this.lang) }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ index + 1 }}</td>
                    <td><img :src="user.image ? user.image : '../assets/images/logo.jpeg'"
                             :width="'30'" height="30" class="align-middle object-fit-contain rounded" :class="user.image ? '' : 'bg-user-image p-1'" alt=""> <span class="fw-medium">{{ user.name }}</span></td>
                    <td><span class="badge bg-label-primary me-1">{{ user.num_system }}</span></td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone ? user.phone : __('Empty',this.lang) }}</td>
                    <td>
                        <a :href="user_show+'/'+user.id" class="btn btn-primary me-1 px-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button type="button" @click="editUser(user.id, index)" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button" @click="deleteUser(user.id, index)" class="btn btn-primary ms-1 px-2" data-bs-toggle="modal" data-bs-target="#modalCenterDelete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">{{ __('Edit a user',this.lang)}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="updateUser_easy">
                            <form @submit.prevent="UpdateUser" id="" enctype="multipart/form-data">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center mb-3">
                                        <label for="file-upload-communication-comments-update"
                                               class="btn text-muted text-center p-1 mb-0 mx-auto position-relative bg-image-border p-0 bg-sub shadow-sm">
                                            <img id="selected-update-image" v-if="users_update.image === ''" class="w-100 h-100 object-fit-cover" style="display:none;" src="" alt="">
                                            <img id="selected-update-image" v-else class="w-100 h-100 object-fit-cover" :src="users_update.image" alt="">
                                        </label>
                                        <small class="text-main d-block py-2 font-12 fw-light">{{ __('Click to Add Your Profile Image',this.lang)}}</small>

                                        <input type="file" v-on:change="selectedFileEdit" class="input-file start-0 file-upload-communication-comments-create"
                                               id="file-upload-communication-comments-update"/>
                                        <div class="file-upload-filename-communication-comments-create mx-auto w-100 text-truncate"></div>
                                        <span v-if="flashMsg.image"
                                              class="text-danger font-12 fw-400">{{ flashMsg.image[0] }}</span>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label class="form-label">{{ __('Name',this.lang)}}</label>
                                        <input type="text" v-model="users_update.name"
                                               class="form-control" placeholder="Your Name">
                                        <span v-if="flashMsg.name" class="text-danger font-12 fw-400">{{ flashMsg.name[0] }}</span>
                                    </div>
                                    <div class="col mb-0">
                                        <label class="form-label">{{ __('Number System',this.lang)}}</label>
                                        <input type="text" v-model="users_update.num_system"
                                               class="form-control" placeholder="Number">
                                        <span v-if="flashMsg.num_system" class="text-danger font-12 fw-400">{{ flashMsg.num_system[0] }}</span>
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col mb-0">
                                        <label class="form-label">{{ __('Email',this.lang)}}</label>
                                        <input type="email" v-model="users_update.email"
                                               class="form-control" placeholder="Email">
                                        <span v-if="flashMsg.email"
                                              class="text-danger font-12 fw-400">{{ flashMsg.email[0] }}</span>
                                    </div>
                                    <div class="col mb-0">
                                        <label class="form-label">{{ __('Phone',this.lang)}}</label>
                                        <input type="text" v-model="users_update.phone"
                                               class="form-control" placeholder="phone number">
                                        <span v-if="flashMsg.phone" class="text-danger font-12 fw-400">{{ flashMsg.phone[0] }}</span>
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col mb-0">
                                        <label class="form-label">{{ __('Password',this.lang)}}</label>
                                        <input type="password" v-model="users_update.password"
                                               class="form-control" placeholder="*********">
                                        <span v-if="flashMsg.password"
                                              class="text-danger font-12 fw-400">{{ flashMsg.password[0] }}</span>
                                    </div>
                                </div>
                                <div class="modal-footer px-0 mb-0 pb-0 mt-2">
                                    <button type="button" class="btn btn-outline-secondary" id="CloseEditUser" data-bs-dismiss="modal">{{ __('Close',this.lang)}}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('Save changes',this.lang)}} <i v-if="loading_update" class="fas fa-spinner ms-1 fa-spin text-white"></i></button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalCenterDelete" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitleDelete">{{ __('Delete User',this.lang)}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center mb-0">{{ __('Are you sure to delete ?',this.lang)}}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="CloseDeleteUser" data-bs-dismiss="modal" >Close</button>
                            <button type="button" class="btn btn-danger" @click="DestroyUser">{{ __('Yes , Delete',this.lang)}}</button>
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
        'users_data',
        'users_add',
        'users_edit',
        'users_delete',
        'users_show',
        'user_show',
        'lang',
    ],
    data() {
        const user = reactive({
            name: '',
            password: '',
            email: '',
            phone: '',
            num_system: '',
        })

        const del_id = null;

        return {
            users: [],
            users_update: [],
            user,
            flashMsg: [],
            showModal: false,
            loading: false,
            loading_data: false,
            loading_delete: false,
            loading_update: false,
            loading_create: false,
            del_id,
            showSuccessMsg: false,
            successMsg: '',
            image: '',
            finished: false,
            page: 1,
            key_index: null,
        }
    },

    methods: {
        async plusPage(){
            this.page++;
            this.getUser()
        },
        async getUser() {
            this.loading = true;
            axios.post(this.users_data + '?page=' + this.page)
                .then(response => {
                    this.users = this.users.concat(response.data.data.data);
                    this.loading = false;
                    if (response.data.data_count === this.users.length) {
                        this.finished = true;
                    }
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                });
        },
        async AddUser() {
            document.getElementById("selected-image").src = "";
            document.getElementById('selected-image').style.display = 'none';
            this.loading_create = true;
            let formData = new FormData();
            formData.append('image', this.image ? this.image : '');
            formData.append('email', this.user.email ? this.user.email : '');
            formData.append('name', this.user.name ? this.user.name : '');
            formData.append('num_system', this.user.num_system ? this.user.num_system : '');
            formData.append('phone', this.user.phone ? this.user.phone : '');
            formData.append('password', this.user.password ? this.user.password : '');
            const config = {
                headers: {'content-type': 'multipart/form-data','Accept-Language': this.lang}
            }
            axios.post(this.users_add, formData, config)
                .then((res) => {
                    localStorage.setItem('name', res.data.name);
                    if (this.users.length + 1 === res.data.data_count) {
                        this.users.push(res.data.data)
                    }
                    this.showModal = false;
                    this.user = []
                    this.image = ''
                    document.getElementById('CloseCreateUser').click();
                    this.loading_create = false;
                    if (res.data.status == 200 && res.data.success == true) {
                        this.showSuccessMsg = true;
                        this.successMsg = res.data.message;
                        setTimeout(() => this.showSuccessMsg = false, 2500);
                    }
                    this.flashMsg = ''
                })
                .catch((err) => {
                    this.loading_create = false;
                    console.log(err)
                    this.flashMsg = err.response.data.message;
                });
        },
        selectedFile(e) {
            this.image = e.target.files[0];
            document.getElementById("selected-image").src= URL.createObjectURL(this.image);
            // Show the image
            document.getElementById('selected-image').style.display = 'block';
            },
        selectedFileEdit(event) {
            this.image = event.target.files[0];
            document.getElementById("selected-update-image").src= URL.createObjectURL(this.image);
            document.getElementById('selected-update-image').style.display = 'block';
        },
        async editUser(id, index) {
            document.getElementById('updateUser_easy').style.opacity='0';
            this.flashMsg = '';
            this.loading_data = true;
            axios.post(this.users_show + '/' + id,[],{
                headers:{
                    'Accept-Language': this.lang,
                }
            })
                .then((res) => {
                    console.log(res.data)
                    this.users_update = res.data;
                    this.key_index = index;
                    this.loading_data = false;
                    document.getElementById('updateUser_easy').style.transition='1.2s ease';
                    document.getElementById('updateUser_easy').style.opacity='1';
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async UpdateUser() {
            this.loading_update = true;
            let formDataEdit = new FormData();
            formDataEdit.append('image', this.image ? this.image : '');
            formDataEdit.append('email', this.users_update.email ? this.users_update.email : '');
            formDataEdit.append('name', this.users_update.name ? this.users_update.name : '');
            formDataEdit.append('num_system', this.users_update.num_system ? this.users_update.num_system : '');
            formDataEdit.append('phone', this.users_update.phone ? this.users_update.phone : '');
            formDataEdit.append('password', this.users_update.password ? this.users_update.password : '');
            const config = {
                headers: {'content-type': 'multipart/form-data','Accept-Language': this.lang}
            }
            axios.post(this.users_edit + '/' + this.users_update.id, formDataEdit, config)
                .then((res) => {
                    localStorage.setItem('name', res.data.name);
                    this.users[this.key_index] = res.data.data;
                    // this.users[this.key_index].id = res.data.id;
                    this.key_index = null;
                    document.getElementById('CloseEditUser').click();
                    document.getElementById('updateUser_easy').style.opacity='0';
                    this.loading_update = false;
                    if (res.data.status == 200 && res.data.success == true) {
                        this.showSuccessMsg = true;
                        this.successMsg = res.data.message;
                        setTimeout(() => this.showSuccessMsg = false, 2500);
                    }
                    this.flashMsg = ''
                })
                .catch((err) => {
                    this.loading_update = false;
                    console.log(err);
                    this.flashMsg = err.response.data.message;
                });
        },
        async deleteUser(id, index) {
            this.del_id = id;
            this.key_index = index;
        },
        async DestroyUser() {
            this.loading_delete = true;
            const config = {
                headers: {'Accept-Language': this.lang}
            }
            axios.post(this.users_delete + '/' + this.del_id, this.user,config)
                .then((res) => {
                    localStorage.setItem('name', res.data.name);
                    this.users.splice(this.key_index, 1)
                    document.getElementById('CloseDeleteUser').click();
                    if (res.data.status == 200 && res.data.success == true) {
                        this.loading_delete = false;
                        this.showSuccessMsg = true;
                        this.successMsg = res.data.message;
                        setTimeout(() => this.showSuccessMsg = false, 2500);
                    }
                })
                .catch((err) => {
                    this.loading_delete = false;
                    console.log(err);
                    this.flashMsg = err.response.data.message;
                });
        }
    },
    async created() {
        this.getUser();
        this.__ = window.__;
    },
}
</script>
