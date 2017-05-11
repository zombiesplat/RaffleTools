Vue.component('event-show', {
    props: ['event_id'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({}),
            event: {
                type: "",
                name: "",
                description: "",
                location_name: "",
                location_address: "",
                contact_name: "",
                contact_email: "",
                contact_phone: "",
                open_date_time: "",
                drawing_date_time: "",
                terms_and_conditions: "",
            },
            dataLoaded: false,
        };
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.$nextTick(function(){
            this.getEvent();
        });
    },

    methods: {
        getEvent() {
            if (!this.form.busy) {
                this.dataLoaded = false;
                this.form.startProcessing();
                axios.get('/api/event/' + this.event_id)
                    .then(response => {
                        this.form.finishProcessing();
                        this.dataLoaded = true;
                        event = response.data;
                        this.event.type_name = event.type_name;
                        this.event.name = event.name;
                        this.event.description = event.description;
                        this.event.location_name = event.location_name;
                        this.event.location_address = event.location_address;
                        this.event.contact_name = event.contact_name;
                        this.event.contact_email = event.contact_email;
                        this.event.contact_phone = event.contact_phone;
                        this.event.open_date_time = event.open_date_time;
                        this.event.drawing_date_time = event.drawing_date_time;
                        this.event.terms_and_conditions = event.terms_and_conditions;
                    });
            }
        },
    }
});
