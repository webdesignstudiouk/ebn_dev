<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' =>'/path/to/certificate.pem',
        'passPhrase'  =>'password',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'AIzaSyDzPltPJ4zNjsBIbWb9AceSLg0bGFmLPLc',
        'service'     =>'gcm'
    )

);
