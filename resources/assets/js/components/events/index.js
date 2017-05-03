Vue.component('event-index', {
    props: ['user', 'teams'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({
                name: '',
            }),
        };
    },

    /**
     * Prepare the component.
     */
    mounted() {
    },

    methods: {

    }

});
