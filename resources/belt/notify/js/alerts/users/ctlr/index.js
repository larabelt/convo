// helpers
import Form from 'belt/notify/js/alerts/form';
import Table from 'belt/notify/js/alerts/users/table';

// templates
import index_html from 'belt/notify/js/alerts/users/templates/index.html';

export default {
    data() {
        return {
            detached: new Table({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
                query: {not: 1},
            }),
            table: new Table({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
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