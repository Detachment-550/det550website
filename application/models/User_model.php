<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    /**
     * Class Test
     */
    class User_model extends Model
    {
        /**
         * @var string
         */
        protected $table = 'users';

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
        public $timestamps = FALSE;

        /**
         * @return hasMany
         */
        public function acknowledge_posts()
        {
            return $this->hasMany('Acknowledge_post_model', 'user_id');
        }
        /**
         * @return HasMany
         */
        public function attendance_memos()
        {
            return $this->hasMany('Attendance_memo_model', 'user_id');
        }
        /**
         * @return HasMany
         */
        public function announcements()
        {
            return $this->hasMany('Announcement_model', 'created_by_id');
        }
        /**
         * @return HasMany
         */
        public function attendance_records()
        {
            return $this->hasMany('Attendance_model', 'user_id');
        }
        /**
         * @return HasMany
         */
        public function events()
        {
            return $this->hasMany('Event_model', 'created_by_id');
        }
    }