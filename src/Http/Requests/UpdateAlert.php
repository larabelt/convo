<?php
namespace Belt\Convo\Http\Requests;

use Belt;

/**
 * Class UpdateAlert
 * @package Belt\Convo\Http\Requests
 */
class UpdateAlert extends Belt\Core\Http\Requests\FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        $ends_at = $this->get('starts_at') ? 'after:starts_at' : '';

        return [
            'name' => 'sometimes|required',
            'body' => 'sometimes|required',
            'ends_at' => $ends_at,
        ];
    }

}