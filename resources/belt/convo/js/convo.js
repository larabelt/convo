import alerts from 'belt/convo/js/alerts/routes';

window.larabelt.convo = _.get(window, 'larabelt.convo', {});

export default class BeltConvo {

    constructor(components = []) {
        this.components = [];

        _(components).forEach((value, index) => {
            this.addComponent(value);
        });

        if ($('#belt-convo').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/belt/convo',
                routes: []
            });

            router.addRoutes(alerts);

            const app = new Vue({router, store}).$mount('#belt-convo');
        }

        let modals = new Vue({
            el: '#vue-modals'
        });
    }

    addComponent(Class) {
        this.components[Class.name] = new Class();
    }
}