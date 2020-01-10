<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    /**
     * Class Test
     */
    class Attendance_model extends Model
    {
        /**
         * @var string
         */
        protected $table = 'attendance';

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
         * Gets the event the attendance record belongs to.
         *
         * @return BelongsTo
         */
        public function event()
        {
            return $this->belongsTo('Event_model');
        }
    }
