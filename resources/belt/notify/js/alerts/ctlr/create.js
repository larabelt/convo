// helpers
import Form from 'belt/notify/js/alerts/form';

// templates make a change

import form_html from 'belt/notify/js/alerts/templates/form.html';
import create_html from 'belt/notify/js/alerts/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    form: new Form({router: this.$router}),
                }
            },
            methods: {
                submit() {
                    Events.$emit('alerts:' + this.entity_id + ':saving', this.form);
                    this.form.submit();
                }
            },
            template: form_html,
        },
    },
    template: create_html
}