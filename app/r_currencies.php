<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $CURR_ID
 * @property int $TAXP_ID
 * @property string $CURR_NAME
 * @property string $CURR_COUNTRY
 * @property string $CURR_SYMBOL
 * @property float $CURR_RATE
 * @property string $created_at
 * @property string $updated_at
 * @property RTaxTableProfile $rTaxTableProfile
 */
class r_currencies extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'R_CURRENCIES';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'CURR_ID';

    /**
     * @var array
     */
    protected $fillable = ['TAXP_ID', 'CURR_NAME', 'CURR_COUNTRY', 'CURR_SYMBOL', 'CURR_RATE', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rTaxTableProfile()
    {
        return $this->belongsTo('App\RTaxTableProfile', 'TAXP_ID', 'TAXP_ID');
    }
}
