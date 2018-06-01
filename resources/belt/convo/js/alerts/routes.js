import index from 'belt/convo/js/alerts/ctlr/index';
import create from 'belt/convo/js/alerts/ctlr/create';
import edit  from 'belt/convo/js/alerts/ctlr/edit';

export default [
    {path: '/alerts', component: index, canReuse: false, name: 'alerts'},
    {path: '/alerts/create', component: create, name: 'alerts.create'},
    {path: '/alerts/edit/:id', component: edit, name: 'alerts.edit'},
]