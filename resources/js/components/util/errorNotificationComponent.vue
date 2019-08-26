<template>
    <div class="row justify-content-center top-buffer">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="alert alert-danger" role="alert">
                {{errorMessage}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "errorNotificationComponent",
        props: ['errorMessage']
    }
</script>

<style scoped>

</style>
