<template>
    <div class="alert alert-success" role="alert">
        {{notificationMessage}}
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
