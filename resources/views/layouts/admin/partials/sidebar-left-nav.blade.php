@php
    $can['alerts'] = $auth->can(['create','update','delete'], Belt\Convo\Alert::class);
@endphp

@if($can['alerts'])
    <li id="convo-admin-sidebar-left-alerts"><a href="/admin/belt/convo/alerts"><i class="fa fa-bullhorn"></i> <span>Alerts</span></a></li>
@endif