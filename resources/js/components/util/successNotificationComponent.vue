<template>
    <div class="row justify-content-center top-buffer">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="alert alert-success" role="alert">
                {{notificationMessage}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "successNotificationComponent",
        props: ['notificationMessage']
    }
</script>

<style scoped>

</style>
