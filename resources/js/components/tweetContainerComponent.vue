<template>
    <!-- Page Content -->
    <div class="container">
        <search-bar-component
            v-if="!loading"
            v-on:loading-status="isLoading"
            v-on:tweet-data="updateTweetData"
            v-on:screen-name="updateScreenName"
        ></search-bar-component>
        <screen-name-component
            :screen-name="screenName"
        ></screen-name-component>
        <loader-component
            v-if="loading"
        ></loader-component>
        <tweet-component
            v-if="!loading"
            v-for="tweet in tweets"
            :data="tweet"
            :key="tweet.text"
            :tweet-text="tweet.text"
            :tweet-created-at="tweet.created_at"
        ></tweet-component>
    </div>
    <!-- /.container -->
</template>

<script>
    export default {
        name: "TweetContainerComponent",
        data() {
            return {
                loading: false,
                screenName: "",
                tweets: []
            }
        },
        methods: {
            isLoading: function (status) {
                this.loading = status;
            },
            updateTweetData: function (tweets) {
                console.log(tweets);
                this.tweets = tweets;
            },
            updateScreenName: function (screenName) {
                this.screenName = screenName;
                this.getUserTimeLineTweets()
            },
            getUserTimeLineTweets: function () {
                axios.get(`/api/userTimeline/${this.screenName}`).then((payload) => {
                    this.tweets = payload.data;
                    this.isLoading(false);
                });

            }
        }
    }
</script>

<style scoped>

</style>
