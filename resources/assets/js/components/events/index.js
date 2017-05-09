Vue.component('event-index', {
    props: ['user', 'teams'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({}),
            dataLoaded: false,
            events: [],
        };
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.$nextTick(function(){
            this.getEvents();
        });
    },

    methods: {
        getEvents() {
            if (!this.form.busy) {
                this.dataLoaded = false;
                this.form.startProcessing();
                axios.get('/api/events')
                    .then(response => {
                        this.form.finishProcessing();
                        this.dataLoaded = true;
                        this.events = response.data.data;
                    });
            }
        }
    }

});
