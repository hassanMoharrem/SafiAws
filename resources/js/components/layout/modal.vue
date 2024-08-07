<template>
    <button type="button"
            class="btn padding-button-cancel px-4 bg-button font-14 text-label rounded-8 border-0"
            data-bs-toggle="modal" :data-bs-target="'#modal'+this.buttonName">
        <img :src="'../assets/images/plus.svg'" width="10" alt=""> {{ this.buttonName }}
    </button>
    <div class="modal fade" :id="'modal'+this.buttonName" aria-hidden="true"
         aria-labelledby="exampleModalLabel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-main mx-md-5 rounded-top-20 rounded-bottom-20">
                <div class="modal-header bg-linear rounded-top-20 border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">{{ this.buttonName }}</h5>
                    <button type="button" class="btn border-0 p-0 ms-auto" id="CloseCreateUser"
                            data-bs-dismiss="modal" aria-label="Close">
                        <img :src="'../assets/images/icons8-cancel-30.png'" width="16" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'buttonName'
    ],
}
</script>
