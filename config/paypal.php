<?php
return array(
    // set your paypal credential
    'client_id' => 'ARFnixtkRQcz6UQqaQiHqxViJeVFAFSJVl-22yXR8851LLSzWFMVYFAgvAQPsmSLZTUZkXRG357PU3C4',
    'secret' => 'EEs_JrXdBDZom0SU5M2HU_J-X1fR7iJHSs-UqjvSApdAYzI_ZZ9ttXQROVlxbmWPTr6mZxwxvKJ9PYTs',
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
        'http.ConnectionTimeOut' => 30,
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