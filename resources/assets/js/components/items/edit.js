Vue.component('item-edit', {
    props: ['item_id'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({
                event_id: "",
                type: "",
                name: "",
                description: "",
                image: "",
                value: "",
                cost: "",
                sponsor: "",
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
            this.getItem();
        });
    },

    methods: {
        getItem() {
            if (!this.form.busy) {
                this.dataLoaded = false;
                this.form.startProcessing();
                axios.get('/api/item/' + this.item_id)
                    .then(response => {
                        this.form.finishProcessing();
                        this.dataLoaded = true;
                        item = response.data;
                        this.form.event_id = item.event_id;
                        this.form.type = item.type;
                        this.form.name = item.name;
                        this.form.description = item.description;
                        this.form.image = item.image;
                        this.form.value = item.value;
                        this.form.cost = item.cost;
                        this.form.sponsor = item.sponsor;
                    });
            }
        },
        saveForm() {
            if (!this.form.busy) {
                this.form.startProcessing();
                axios.put('/api/item/' + this.item_id, this.form)
                    .then(response => {
                        this.form.finishProcessing();
                        window.location.href = '/event/'+this.form.event_id+'/items';
                    },
                    error => {
                        this.form.setErrors(error.response.data);
                    });
            }
        }
    }

});
