<?php

namespace Belt\Notify;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Alert
 * @package Belt\Notify
 */
class Alert extends Model implements
    Belt\Core\Behaviors\IncludesSubtypesInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Core\Behaviors\TranslatableInterface,
    Belt\Core\Behaviors\TypeInterface
{

    use Belt\Core\Behaviors\IncludesSubtypes;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\Translatable;
    use Belt\Core\Behaviors\TypeTrait;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $morphClass = 'alerts';

    /**
     * @var string
     */
    protected $table = 'alerts';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var array
     */
    protected $with = ['params'];

    /**
     * @var array
     */
    protected $dates = ['starts_at', 'ends_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Default values
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
        'show_url' => false,
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_url' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $appends = ['morph_class'];

    /**
     * @param $value
     * @return null
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper(trim($value));
    }

    /**
     * @param $query
     * @param $datetime
     */
    public function scopeActive($query, $datetime = null)
    {

        $datetime = $datetime ?: date('Y-m-d H:i:s', strtotime('now'));

        $query->where('alerts.is_active', true);
        $query->where(function ($query) use ($datetime) {
            $query->whereNull('alerts.starts_at');
            $query->orWhere('alerts.starts_at', '<=', $datetime);
        });
        $query->where(function ($query) use ($datetime) {
            $query->whereNull('alerts.ends_at');
            $query->orWhere('alerts.ends_at', '>=', $datetime);
        });
    }


}