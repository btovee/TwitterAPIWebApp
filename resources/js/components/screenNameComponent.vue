<template>
    <div class="row justify-content-center top-buffer">
        <div class="col-12 col-md-10 col-lg-8">
            <h1 v-if="screenName">Tweets Timeline: {{screenName}} </h1>
        </div>
    </div>
</template>

<script>
    export default {
        name: "screenNameComponent",
        props: ['screenName']
    }
</script>

<style scoped>

</style>
