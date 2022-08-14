<template>
    <div>
        <h5>Event</h5>
        <div class="form-group">
            <label>Title</label>
            <input
                type="text"
                class="form-control"
                required
                v-model="event.eventTitle"
            />
        </div>
        <div class="form-group">
            <label>Date</label>
            <input
                type="date"
                class="form-control"
                required
                v-model="event.eventDate"
            />
        </div>
        <div class="form-group">
            <label>City</label>
            <input
                type="text"
                class="form-control"
                required
                v-model="event.eventCity"
            />
        </div>
        <div class="tickets">
            <div v-for="ticket in event.tickets" :key="ticket.id">
                <h5>Ticket</h5>
                <div class="form-group">
                    <label>Barcode</label>
                    <input
                        type="text"
                        class="form-control"
                        pattern="^[a-zA-Z0-9]*$"
                        maxlength="8"
                        required
                        v-model="ticket.barcode"
                    />
                </div>
                <div class="form-group">
                    <label>First name</label>
                    <input
                        type="text"
                        class="form-control"
                        required
                        v-model="ticket.firstName"
                    />
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input
                        type="text"
                        class="form-control"
                        required
                        v-model="ticket.lastName"
                    />
                </div>
            </div>
            <button type="button" class="btn btn-primary" @click="addTicket()">
                Add ticket
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        event: {
            type: Object,
            required: false,
        },
    },
    methods: {
        addTicket() {
            this.event.tickets.push({});
        },
    },
};
</script>

<style>
.tickets {
    margin-bottom: 10px;
}
</style>
