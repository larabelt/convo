<?php
namespace Belt\Notify\Http\Requests;

use Belt;

class PaginateAlerts extends Belt\Core\Http\Requests\PaginateRequest
{
    public $perPage = 5;

    public $orderBy = 'alerts.id';

    public $sortBy = 'desc';

    public $sortable = [
        'alerts.id',
        'alerts.name',
        'alerts.created_at',
        'alerts.updated_at',
    ];

    public $searchable = [
        'alerts.name',
        'alerts.starts_at',
        'alerts.ends_at',
    ];

}