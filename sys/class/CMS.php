<?php
class CMS {
    private $Class;
    public $Tilte;
    public $Page;
    public $Args;
    function __construct() {
        /*
        $zipFile = 'update.zip';
        $filename = 'checksum.txt';
        $zip = new ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            if ($zip->locateName($filename) !== FALSE) {
                $entry = $zip->getStream($filename);
                $content = stream_get_contents($entry);
                fclose($entry);
                
                $jsonchecksum = json_decode($content, true);
                foreach ($jsonchecksum as $value) {
                    if ($value["checksum"] !== md5_file($value["path"]) && $value["path"] !== "index.php"){
                        echo $value["path"]." = ".$value["checksum"]."</br></br>";
                        //var_dump("./".$value["path"]);
                        $zip->extractTo("./", $value["path"]);
                    }
                }
            
            }
            // Fermer le fichier ZIP
            $zip->close();
        } else {
            echo 'Impossible d\'ouvrir le fichier ZIP.';
        }
        */
        $Config = simplexml_load_file('./Core.xml');
        if ($Config === false) {
            die('Erreur de chargement du fichier XML.');
        }

        $this->Tilte = $Config->template->title;

        


        $this->Class["Path"] = (object)[
            "Share" => (object)[
                "upload" => "./share/upload/",
                "Bot" => "./share/bot/",
                "Api" => "./share/api/"
            ],
            "Usr" => (object)[
                "Plugins" => "./usr/plugins/",
                "Template" => "./usr/template/"
            ],
            "Panel" => (object)[
                "Class" => "./panel/class/",
                "Templates" => "./panel/templates/"
            ]
        ];
        $this->Class["Config"] = $Config;

        include("./sys/class/Security.php");
        $this->Class["Security"] = new Security($this);
        include("./sys/class/Session.php");
        $this->Class["Session"] = new Session($this);
        include("./sys/class/Log.php");
        $this->Class["Log"] = new Log($this);
        include("./sys/class/Members.php");
        $this->Class["Members"] = new Members($this);
        include("./sys/function/GFunction.php");
        $this->Class["Function"] = new GFunction($this);
        include("./sys/class/DataBase.php");
        $this->Class["DataBase"] = new DataBase($this);
        include("./sys/class/Plugins.php");
        $this->Class["Plugins"] = new Plugins($this);
        
        
        include("./sys/class/Upload.php");
        $this->Class["Upload"] = new Upload($this);
                
        include("./sys/class/Template.php");
        $this->Class["Template"] = new Template($this);
    }

    public function __get($name) {
        return isset($this->Class[$name])?$this->Class[$name]:NULL;
    }

    public function setPage($page){
        $this->Page = $page;
    }
    public function getPage(){
        return $this->Page;
    }
    public function getTitle(){
        return $this->Tilte;
    }
    public function setTitle($tilte){
        $this->Config->template->title = $tilte;
        $this->Tilte = $tilte;
        $this->Config->asXML('./Core.xml');
    }
}