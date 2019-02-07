// helpers
import Table from 'belt/notify/js/alerts/table';

// templates make a change

import index_html from 'belt/notify/js/alerts/templates/index.html';

export default {

    components: {

        index: {
            data() {
                return {
                    table: new Table({router: this.$router}),
                }
            },
            mounted() {
                this.table.updateQueryFromRouter();
                this.table.index();
            },
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Alert Manager</span>
                <span slot="help"><link-help docKey="admin.notify.alerts.manager" /></span>
                <li><router-link :to="{ name: 'alerts' }">Alert Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}