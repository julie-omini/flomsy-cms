<?php
class Plugins {
    private $Class;
    private $CMS;
    function __construct($CMS) {
        $this->CMS = $CMS;
        $plugins = explode(',', $CMS->Config->template->plugins);

        $name = "ennNode";
        foreach ($plugins as $key => $value) {
            $value = trim($value);
            if (file_exists("./usr/plugins/". $value."/Main.php")){
                $CMS->Security->Include("./usr/plugins/". $value."/Main.php");
                $this->Class[$value] = new $value();
            } else {
                echo "Impossible de charger le plugin : ".$value;
            }
        }
    }
    public function __get($name) {
        return isset($this->Class[$name])?$this->Class[$name]:NULL;
    }
}