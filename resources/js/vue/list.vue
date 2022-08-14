<template>
    <div>
        <h3 class="text-center">All Events</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Event title</th>
                    <th>Event date</th>
                    <th>Event city</th>
                    <th>Ticket count</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in events" :key="event.id">
                    <td>{{ event.eventTitle }}</td>
                    <td>{{ event.eventDate }}</td>
                    <td>{{ event.eventCity }}</td>
                    <td>{{ event.tickets.length }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link
                                :to="{ name: 'edit', params: { id: event.id } }"
                                class="btn btn-outline-primary"
                                >Edit
                            </router-link>
                            <button
                                class="btn btn-outline-danger"
                                @click="deleteEvent(event.id)"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            events: [],
        };
    },
    created() {
        this.axios.get("http://localhost/api/event").then((response) => {
            this.events = response.data.events;
        });
    },
    methods: {
        deleteEvent(id) {
            this.axios
                .delete(`http://localhost/api/event/${id}`)
                .then((response) => {
                    let index = this.events
                        .map((event) => event.id)
                        .indexOf(id);
                    this.events.splice(index, 1);
                    alert(response.data.message);
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>
