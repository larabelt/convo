// helpers
import Form from 'belt/notify/js/alerts/form';

// templates make a change

import edit_html from 'belt/notify/js/alerts/templates/edit.html';
import form_html from 'belt/notify/js/alerts/templates/form.html';

export default {
    data() {
        return {
            form: new Form(),
            entity_type: 'alerts',
            entity_id: this.$route.params.id,
        }
    },
    mounted() {
        this.form.show(this.entity_id);
    },
    components: {

        edit: {
            data() {
                return {
                    form: this.$parent.form,
                }
            },
            template: form_html,
        },
    },
    template: edit_html,
}