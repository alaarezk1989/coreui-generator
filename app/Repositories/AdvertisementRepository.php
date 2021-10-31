<?php

namespace App\Repositories;

use App\Models\Advertisement;
use App\Repositories\BaseRepository;

/**
 * Class AdvertisementRepository
 * @package App\Repositories
 * @version October 31, 2021, 9:50 pm UTC
*/

class AdvertisementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'language_id',
        'translation_id',
        'image_id',
        'title',
        'description',
        'button_link',
        'button_title',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Advertisement::class;
    }
}
