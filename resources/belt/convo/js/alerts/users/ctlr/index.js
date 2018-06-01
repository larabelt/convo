// helpers
import Form from 'belt/convo/js/alerts/form';
import Table from 'belt/convo/js/alerts/users/table';

// templates
import index_html from 'belt/convo/js/alerts/users/templates/index.html';

export default {
    data() {
        return {
            detached: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
                query: {not: 1},
            }),
            table: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    mounted() {
        this.table.index();
    },
    methods: {
        attach(id) {
            this.form.setData({id: id});
            this.form.store()
                .then(response => {
                    this.table.index();
                    this.detached.index();
                })
        }
    },
    template: index_html
}