<?php
    abstract class Encryption extends Dbh {
        private static $cyphering = "AES-128-CTR";
        private static $option = 0;
        private static $encryption_iv = '1234567890123456';
        
        protected function encrypt($data,$encryption_key) {
            $encription = openssl_encrypt($data, self::$cyphering, $encryption_key, self::$option, self::$encryption_iv);
            return $encription;        
        }

        protected function decrypt($encrypted_data,$decryption_key) {
            $decription = openssl_decrypt($encrypted_data, self::$cyphering, $decryption_key, self::$option, self::$encryption_iv);
            return $decription;
        }
    }