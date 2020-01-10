<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    /**
     * Class Test
     */
    class Announcement_model extends Model
    {
        /**
         * @var string
         */
        protected $table = 'announcement';

        /**
         * @var string
         */
        protected $primaryKey = 'id';

        /**
         * @var bool
         */
        public $incrementing = TRUE;

        /**
         * @var string
         */
        protected $keyType = 'int';

        /**
         * @var bool
         */
        public $timestamps = TRUE;

        /**
         * Gets the user who created the event.
         *
         * @return BelongsTo
         */
        public function created_by()
        {
            return $this->belongsTo('User_model');
        }

        /**
         * Gets the acknowledgements that belong to the announcement.
         *
         * @return HasMany
         */
        public function acknowledgements()
        {
            return $this->hasMany('Acknowledge_post_model', 'announcement_id');
        }
    }
