<template>
    <div class="row justify-content-center top-buffer">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">{{tweetText}}</p>
                </div>
                <div class="card-footer text-muted">
                    <span class="badge badge-success">Posted {{tweetCreatedAt}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "tweetComponent",
        props: [
            'tweetText',
            'tweetCreatedAt'
        ]
    }
</script>

<style scoped>

</style>
