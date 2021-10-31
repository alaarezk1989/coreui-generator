<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Slider",
 *      required={"language_id", "image_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="language_id",
 *          description="language_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="translation_id",
 *          description="translation_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="image_id",
 *          description="image_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="button_link",
 *          description="button_link",
 *          type="string",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="button_title",
 *          description="button_title",
 *          type="string",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Slider extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'sliders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'language_id' => 'integer',
        'translation_id' => 'integer',
        'image_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'button_link' => 'string',
        'button_title' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'language_id' => 'required',
        'translation_id' => 'nullable',
        'image_id' => 'required',
        'title' => 'nullable',
        'description' => 'nullable',
        'button_link' => 'nullable',
        'button_title' => 'nullable'
    ];

    
}
