<?php
namespace Belt\Convo\Http\Requests;

/**
 * Class StoreAlert
 * @package Belt\Convo\Http\Requests
 */
class StoreAlert extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {

        $ends_at = $this->get('starts_at') ? 'after:starts_at' : '';

        return [
            'name' => 'required',
            'body' => 'required',
            'ends_at' => $ends_at,
        ];
    }

}