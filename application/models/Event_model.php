<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    /**
     * Class Test
     */
    class Event_model extends Model
    {
        /**
         * @var string
         */
        protected $table = 'event';

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
         * Gets the users who attended this event.
         *
         * @return HasMany
         */
        public function attendees()
        {
            return $this->hasMany('Attendance_model', 'event_id');
        }
    }
