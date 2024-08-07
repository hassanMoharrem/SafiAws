<script>
export default {
    props: [
        'successMsg'
    ],
}
</script>

<template>
    <div class="alert alert-success alert-dismissible transition position-fixed bottom-0 mx-4 my-5" role="alert">
        {{ successMsg }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
</template>
