Vue.component('item-index', {
    props: ['event_id'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({}),
            dataLoaded: false,
            items: [],
        };
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.$nextTick(function(){
            this.getItems();
        });
    },

    methods: {
        getItems() {
            if (!this.form.busy) {
                this.dataLoaded = false;
                this.form.startProcessing();
                axios.get('/api/event/' + this.event_id + '/items')
                    .then(response => {
                        this.form.finishProcessing();
                        this.dataLoaded = true;
                        this.items = response.data.data;
                    });
            }
        }
    }

});
