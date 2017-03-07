<?php

namespace Nht\Hocs\Settings;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	public $timestamps = false;

    public $fillable = [
        'logo', 'name', 'address', 'email_1', 'email_2', 'email_3', 'phone_1', 'phone_2', 'phone_3',
        'skype_1', 'skype_2', 'skype_3', 'yahoo_1', 'yahoo_2', 'yahoo_3', 'short_description',
        'description', 'contact', 'meta_title', 'meta_keyword', 'meta_description', 'js_codes', 'facebook',
        'googleplus', 'twitter', 'linkin', 'youtube'
    ];

    /**
     * Get logo image link
     * @param  string $type [description]
     * @return [type]       [description]
     */
	public function getLogo($type = 'md_')
	{
		return $this->logo != null ? LOGO_SETTING . $type . $this->logo : '/images/no-image.png';
	}

}
