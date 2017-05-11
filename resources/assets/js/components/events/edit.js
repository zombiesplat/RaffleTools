Vue.component('event-edit', {
    props: ['event_id'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({
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
            }),
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
                        this.form.type = event.type;
                        this.form.name = event.name;
                        this.form.description = event.description;
                        this.form.location_name = event.location_name;
                        this.form.location_address = event.location_address;
                        this.form.contact_name = event.contact_name;
                        this.form.contact_email = event.contact_email;
                        this.form.contact_phone = event.contact_phone;
                        this.form.open_date_time = event.open_date_time;
                        this.form.drawing_date_time = event.drawing_date_time;
                        this.form.terms_and_conditions = event.terms_and_conditions;
                    });
            }
        },
        saveForm() {
            if (!this.form.busy) {
                this.form.startProcessing();
                axios.put('/api/event/' + this.event_id, this.form)
                    .then(response => {
                        this.form.finishProcessing();
                        window.location.href = '/events';
                    },
                    error => {
                        this.form.setErrors(error.response.data);
                    });
            }
        }
    }

});
