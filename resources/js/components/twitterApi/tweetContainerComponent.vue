<template>
    <!-- Page Content -->
    <div class="container">
        <search-bar-component
            v-if="!loading"
            v-on:loading-status="isLoading"
            v-on:tweet-data="updateTweetData"
            v-on:screen-name="updateScreenName"
        ></search-bar-component>
        <error-notification-component
            v-if="error"
            :error-message="errorMessage"
        >
        </error-notification-component>
        <success-notification-component
            v-if="notification"
            :notification-message="notificationMessage"
        >
            {{notificationMessage}}
        </success-notification-component>
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
    import ErrorNotificationComponent from "../util/errorNotificationComponent";

    export default {
        name: "TweetContainerComponent",
        components: {ErrorNotificationComponent},
        data() {
            return {
                loading: false,
                screenName: "",
                tweets: [],
                error: false,
                errorMessage: "",
                notification: false,
                notificationMessage: "",
                polling: null
            }
        },
        methods: {
            isLoading: function (status) {
                this.loading = status;
            },
            updateTweetData: function (tweets) {
                this.tweets = tweets;
            },
            updateScreenName: function (screenName) {
                this.screenName = screenName;
                if (screenName) {
                    this.getUserTimeLineTweets();
                    this.pollForUpdate();
                }
            },
            pollForUpdate: function () {
                this.polling = null;
                this.polling = setInterval(() => {
                    this.setNotification(true, "Checking Twitter for updates....");
                    this.getUserTimeLineTweets();
                }, 180000)
            },
            failedToLoadUserTimeline: function () {
                this.setError(true, "An unexpected error seems to have occurred. " +
                    "Why not try refreshing the page? Or you can contact us if the problem persists");
                this.updateTweetData([]);
                this.updateScreenName("");
                this.isLoading(false);
                setTimeout(() => {
                        this.setError(false);
                    }, 4000
                );
            },
            setError: function (isError, message = "") {
                this.error = isError;
                this.errorMessage = message;
            },
            setNotification: function (isNotification, message = "") {
                this.notification = isNotification;
                this.notificationMessage = message;
            },
            getUserTimeLineTweets: function () {
                this.isLoading(true);
                axios.get(`/api/userTimeline/${this.screenName}`).then((payload) => {
                    this.tweets = payload.data;
                    this.isLoading(false);
                    this.setNotification(false);
                }).catch(() => {
                    this.failedToLoadUserTimeline();
                    this.setNotification(false);
                });
            }
        }
    }
</script>

<style scoped>

</style>
