import Form from 'belt/notify/js/alerts/form';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import edit_html from 'belt/notify/js/alerts/templates/edit.html';
import form_html from 'belt/notify/js/alerts/templates/form-edit.html';

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
            mixins: [TranslationStore],
            data() {
                return {
                    form: this.$parent.form,
                    entity_type: 'alerts',
                    entity_id: this.$parent.entity_id,
                }
            },
            created() {
                this.bootTranslationStore();
            },
            methods: {
                submit() {
                    Events.$emit('alerts:' + this.form.id + ':updating', this.form);
                    this.form.submit();
                }
            },
            template: form_html,
        },
    },
    template: edit_html,
}