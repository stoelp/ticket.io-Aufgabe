<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="createEvent">
                    <event-form :event="event"></event-form>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-primary">
                            Create event
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
                .then((response) => {
                    this.event = response.data.event;
                    alert(response.data.message);
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>
