<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Test
     */
    class Wiki_model extends Model
    {
        /**
         * @var string
         */
        protected $table = 'wiki';

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
    }
