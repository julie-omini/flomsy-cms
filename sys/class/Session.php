<?php
class Session {
    function __construct($CMS) {
        $privatekey = $CMS->Config->server->privatekey;
        if (!isset($_SESSION['check'])){
            $_SESSION['check'] = hash("sha512", $privatekey.sha1($_SERVER['REMOTE_ADDR'].md5($privatekey).$_SERVER['HTTP_USER_AGENT'].sha1($privatekey).$_SERVER['REQUEST_SCHEME']));
        } else {
            if($_SESSION['check'] !== hash("sha512", ($privatekey).sha1($_SERVER['REMOTE_ADDR'].md5($privatekey).$_SERVER['HTTP_USER_AGENT'].sha1($privatekey).$_SERVER['REQUEST_SCHEME']))){
                session_destroy();
            }
        }
    }
    public function GetRole() : int {
        return isset($_SESSION['Role'])?$_SESSION['Role']:0;
    }
    public function Get($key) : mixed {
        return isset($_SESSION[$key]) ? $_SESSION[$key]:null;
    }
    public function Destroy() : void {
        session_destroy();
    }
}