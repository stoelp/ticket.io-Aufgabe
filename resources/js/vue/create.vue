<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="createEvent">
                    <event-form :event="event"></event-form>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Create Event
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
            event: {
                tickets: [{}],
            },
        };
    },
    methods: {
        createEvent() {
            this.axios
                .post("http://localhost/api/event", this.event)
                .catch((error) => console.log(error));
        },
    },
};
</script>
