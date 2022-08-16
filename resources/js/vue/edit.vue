<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="updateEvent">
                    <event-form :event="event"></event-form>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-primary">
                            Update event
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
            .get(`/api/event/${this.$route.params.id}`)
            .then((response) => {
                this.event = response.data.event;
            });
    },
    methods: {
        updateEvent() {
            this.axios
                .put(`/api/event/${this.$route.params.id}`, this.event)
                .then((response) => {
                    this.event = response.data.event;
                    alert(response.data.message);
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>

<style>
.tickets {
    margin-bottom: 10px;
}
</style>
