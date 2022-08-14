<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="updateEvent">
                    <event-form :event="event"></event-form>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            event: {},
        };
    },
    created() {
        this.axios
            .get(`http://localhost/api/event/${this.$route.params.id}`)
            .then((response) => {
                this.event = response.data.event;
            });
    },
    methods: {
        updateEvent() {
            this.axios.put(
                `http://localhost/api/event/${this.$route.params.id}`,
                this.event
            );
        },
    },
};
</script>

<style>
.tickets {
    margin-bottom: 10px;
}
</style>
