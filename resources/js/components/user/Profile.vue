<template>
    <div v-if="showSuccessMsg"
         class="transition bg-sub px-4 py-2 border-start border-success border-2 rounded-3 shadow position-fixed bottom-0 mx-4 my-5">
        <img :src="'../assets/images/flashMsg.png'" class="d-inline-block" :width="'50'" :height="'50'" alt="img">
        <div class="d-inline-block align-middle mx-2 text-center">
            <h4 class="mb-1 text-success">Alert</h4>
            <h5 class="ms-1">{{ successMsg }}</h5>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="updateUser_easy" class="p-3 rounded-card shadow-sm border border-muted">
                <form  method="post" @submit.prevent="UpdateUser" enctype="multipart/form-data"
                       class="mx-2">
                    <div class="form-group mb-0 text-center">
                        <div id="file-upload-filename"
                             class="text-right text-truncate w-75 name-file-upload position-absolute"></div>
                        <label for="file-upload-communication-comments-edite"
                               class="btn text-muted text-center p-1 mb-0 mx-auto position-relative bg-image-border p-0 bg-sub shadow-sm">
                            <img id="selected-update-image" v-if="user_update.image" class="w-100 h-100 object-fit-cover" :src="'../storage/'+user_update.image" alt="">
                            <img id="selected-update-image" v-else class="w-100 h-100 object-fit-cover" style="display:none;" src="" alt="">
                        </label>
                        <small class="text-label d-block py-2 font-12 fw-light">Click to Edit Your Image</small>
                        <input type="file" v-on:change="selectedFileEdit" class="input-file start-0 file-upload-communication-comments-create"
                               id="file-upload-communication-comments-edite"/>
                        <div class="file-upload-filename-communication-comments-create mx-auto w-100 text-truncate"></div>
                        <span v-if="flashMsg.image"
                              class="text-danger fw-400 font-12">{{ flashMsg.image[0] }}</span>

                    </div>
                    <div class="form-group mb-3 text-start">
                        <label class="fw-400 text-label font-14">Name</label>
                        <input type="text" v-model="user_update.name"
                               class="form-control shadow-input mt-2 border-transparent bg-sub font-12 text-white">
                        <span v-if="flashMsg.name"
                              class="text-danger fw-400 font-12">{{ flashMsg.name[0] }}</span>
                    </div>
                    <div class="form-group mb-3 text-start">
                        <label class="fw-400 text-label font-14">Email</label>
                        <input type="email" v-model="user_update.email"
                               class="form-control shadow-input mt-2 border-transparent bg-sub font-12 text-white">
                        <span v-if="flashMsg.email"
                              class="text-danger fw-400 font-12">{{ flashMsg.email[0] }}</span>
                    </div>
                    <div class="form-group mb-3 text-start">
                        <label class="fw-400 form-label font-14">Phone</label>
                        <input type="text" v-model="user_update.phone"
                               class="form-control shadow-input mt-2 border-transparent bg-sub font-14 text-muted">
                        <span v-if="flashMsg.phone" class="text-danger font-12 fw-400">{{ flashMsg.phone[0] }}</span>
                    </div>
                    <div class="form-group mb-3 text-start">
                        <label class="fw-400 text-label font-14">Password</label>
                        <input type="password" v-model="user_update.password"
                               class="form-control shadow-input mt-2 border-transparent bg-sub font-12 text-white">
                        <span v-if="flashMsg.password"
                              class="text-danger fw-400 font-12">{{ flashMsg.password[0] }}</span>
                    </div>
                    <div class="text-center my-2">
                        <button type="submit"
                                class="btn px-4 bg-button font-14 text-label rounded-10 border-0">
                            <span class="mx-2">Update</span><span v-if="this.loading_update === true"><i class="fas fa-spinner fa-spin text-white"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive} from "vue/dist/vue.esm-bundler";

export default {
    props: [
        'user_data',
        'user_data_update',
    ],
    data() {
        const user = reactive({
            name: '',
            password: '',
            email: '',
            phone: '',
        })


        return {
            users: [],
            user_update: [],
            user,
            flashMsg: [],
            loading: false,
            loading_update: false,
            loading_data: false,
            showSuccessMsg: false,
            successMsg: '',
            image: '',
            key_index: null,
        }
    },

    methods: {
        async getDate() {
            this.loading = true;
            axios.post(this.user_data)
                .then(response => {
                    this.user_update = response.data;
                    this.loading = false;
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                });
        },
        selectedFileEdit(event) {
            this.image = event.target.files[0];
            document.getElementById("selected-update-image").src= URL.createObjectURL(this.image);
            document.getElementById('selected-update-image').style.display = 'block';
        },
        async UpdateUser() {
            this.loading_update = true;
            let formDataEdit = new FormData();
            formDataEdit.append('image', this.image);
            formDataEdit.append('email', this.user_update.email);
            formDataEdit.append('name', this.user_update.name);
            formDataEdit.append('phone', this.user.phone);
            formDataEdit.append('password', this.user_update.password ? this.user_update.password : '');
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }
            axios.post(this.user_data_update , formDataEdit, config)
                .then((res) => {
                    localStorage.setItem('name', res.data.name);
                    this.user_update = res.data.data;
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
    },
    async created() {
        this.getDate();
        this.__ = window.__;
    },
}
</script>
