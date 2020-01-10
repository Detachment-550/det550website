<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    /**
     * Class Test
     */
    class Attendance_memo_model extends Model
    {
        /**
         * @var string
         */
        protected $table = 'attendance_memo';

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
            return $this->belongsTo('User_model', 'user_id');
        }

        /**
         * Gets the event the memo is for.
         *
         * @return BelongsTo
         */
        public function event()
        {
            return $this->belongsTo('Event_model');
        }

        /**
         * Gets the type of memo.
         *
         * @return BelongsTo
         */
        public function attendance_memo_type()
        {
            return $this->belongsTo('Attendance_memo_type_model');
        }

        /**
         * Gets the user who the memo is for.
         *
         * @return BelongsTo
         */
        public function memo_for()
        {
            return $this->belongsTo('User_model');
        }
    }
