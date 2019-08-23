<template>
    <div class="row justify-content-center top-buffer">
        <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm" v-on:submit.prevent="sendScreenNameToParent">
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <i class="fas fa-search h4 text-body"></i>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" type="search" v-model="screenName" placeholder="Search Twitter Screen Name">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" type="submit">Search</button>
                    </div>
                    <!--end of col-->
                </div>
            </form>
        </div>
        <!--end of col-->
    </div>
</template>

<script>
    export default {
        name: "searchBarComponent",
        data() {
            return {
                screenName: ""
            }
        },
        methods: {
            sendScreenNameToParent: function (event) {
                // now we have access to the native event
                if (event) event.preventDefault();
                if(this.screenName) {
                    this.isLoading(true);
                    this.$emit('screen-name', this.screenName);
                    this.screenName = "";
                }
            },
            isLoading: function (status = false) {
                this.$emit('loading-status', status);
            }
        }
    }
</script>

<style scoped>

</style>
