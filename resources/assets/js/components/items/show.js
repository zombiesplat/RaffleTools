Vue.component('item-show', {
    props: ['item_id'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({}),
            item: {
                event_id: "",
                type: "",
                type_name: "",
                name: "",
                description: "",
                image: "",
                image_src: "",
                value: "",
                cost: "",
                sponsor: "",
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
                axios.get('/api/item/' + this.item_id)
                    .then(response => {
                        this.form.finishProcessing();
                        this.dataLoaded = true;
                        item = response.data;
                        this.item.event_id = item.event_id;
                        this.item.type = item.type;
                        this.item.type_name = item.type_name;
                        this.item.name = item.name;
                        this.item.description = item.description;
                        this.item.image = item.image;
                        this.item.image_src = item.image_src;
                        this.item.value = item.value;
                        this.item.cost = item.cost;
                        this.item.sponsor = item.sponsor;
                    });
            }
        },
    }
});
