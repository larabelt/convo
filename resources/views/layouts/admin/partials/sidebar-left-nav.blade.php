@php
    $can['alerts'] = $auth->can(['create','update','delete'], Belt\Notify\Alert::class);
@endphp

@if($can['alerts'])
    <li id="notify-admin-sidebar-left-alerts"><a href="/admin/belt/notify/alerts"><i class="fa fa-bullhorn"></i> <span>Alerts</span></a></li>
@endif