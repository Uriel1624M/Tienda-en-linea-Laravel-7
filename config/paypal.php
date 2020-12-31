<?php
return array(
    /** set your paypal credential **/
    'client_id' =>'AZaIC8sMio5uBlg6TesQO-EUqJWXP5cBfBT7e0M3wd39b6Ei40Z2bjjarnzWCFZux8ng--xvlUrUuLYY',
    'secret' => 'EBZt32BXgWa3eTYC7CPgcAVn9Vwri_zZ31Y5LbQggDRAddkIK-h_07ZsCyoGBkMLAgVx_FcuL_f3vRfn',
    /**
    * SDK configuration
    */
    'settings' => array(
        /**
        * Available option 'sandbox' or 'live'
        */
        'mode' => 'sandbox',
        /**
        * Specify the max request time in seconds
        */
        'http.ConnectionTimeOut' => 1000,
        /**
        * Whether want to log to a file
        */
        'log.LogEnabled' => true,
        /**
        * Specify the file that want to write on
        */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
        * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
        *
        * Logging is most verbose in the 'FINE' level and decreases as you
        * proceed towards ERROR
        */
        'log.LogLevel' => 'FINE'
    ),
);
