<?php
class Template {
    private $CMS;
    private $Template;
    private $Mime;
    function __construct($CMS) {
        $this->CMS = $CMS;
        $this->Template = $CMS->Config->template->folder;
        $this->Mime = [
            "text/plain" => "txt",
            "text/html" => ["htm", "html"],
            "text/css" => "css",
            "application/javascript" => "js",
            "application/json" => "json",
            "application/xml" => "xml",
            "application/x-shockwave-flash" => "swf",
            "video/x-flv" => "flv",
            "image/png" => "png",
            "image/jpeg" => ["jpe", "jpeg", "jpg"],
            "image/gif" => "gif",
            "image/bmp" => "bmp",
            "image/vnd.microsoft.icon" => "ico",
            "image/tiff" => ["tiff", "tif"],
            "image/svg+xml" => "svg",
            "application/zip" => "zip",
            "application/x-rar" => "rar",
            "application/x-rar-compressed" => "rar",
            "application/x-msdownload" => ["exe", "msi"],
            "application/vnd.ms-cab-compressed" => "cab",
            "audio/mpeg" => "mp3",
            "video/quicktime" => ["qt", "mov"],
            "application/pdf" => "pdf",
            "image/vnd.adobe.photoshop" => "psd",
            "application/postscript" => ["ai", "eps", "ps"],
            "application/msword" => "doc",
            "application/rtf" => "rtf",
            "application/vnd.ms-excel" => "xls",
            "application/vnd.ms-powerpoint" => "ppt",
            "application/vnd.oasis.opendocument.text" => "odt",
            "application/vnd.oasis.opendocument.spreadsheet" => "ods"
        ];
        $Path = explode('/', substr($_SERVER['REQUEST_URI'], 1));

        $rewrites = json_decode(file_get_contents("./rewrite.json"));
        
        $geturl = implode("/", $Path);
        foreach ($rewrites as $value) {
            $regex = str_replace("/", "\\/", $value->path);
            preg_match("/$regex/", $geturl, $matches);
            if (isset($matches[0]) !== false){
                unset($matches[0]);
                $Path = explode('/', substr($value->rewrite, 1));
                $CMS->Args = $matches;
                break;
            }
        }
        $CMS->setPage(end($Path));
        switch ($Path[0]) {
            case "panel":
                    if ($CMS->Session->GetRole() === 3 || $CMS->Session->GetRole() === 2){
                        if (str_contains(implode("/", $Path), '.css') || str_contains(implode("/", $Path), '.js') || str_contains(implode("/", $Path), '.png')){
                            if ($this->TryLoadFile(implode("/", $Path))){
                                exit();
                            }
                        }
                        $CMS->Security->Include(Path:implode("/", $Path).".php");
                        return;
                    }
                    exit(header('Location: ../403'));
                break;
            case "api":
                    $plugin = explode('/', implode("/", $Path));
                    if (file_exists("./share/".implode("/", $Path).".php")){
                        $CMS->Security->Include(Path:"share/".implode("/", $Path).".php");
                    } else if (file_exists("./usr/plugins/".$plugin[1]."/api/".$plugin[2].".php")){
                        $CMS->Security->Include(Path:"./usr/plugins/".$plugin[1]."/api/".$plugin[2].".php");   
                    } else {
                        exit(header('Location: ../../404'));
                    }
                break;
            default:
                    $this->Load_Page_Template(Path:implode("/", $Path));
                break;
        }
    }
    private function Load_Page_Template($Path){
        $Permission = $this->LoadPerm("usr/template/".$this->Template."/Permission.json");
        if ($Permission === null)
            exit();

        if (str_contains($Path, '.css') || str_contains($Path, '.js') || str_contains($Path, '.jpg')  || str_contains($Path, '.png')  || str_contains($Path, '.svg') || str_contains($Path, '.ico') || str_contains($Path, '.webp')){
            if ($this->TryLoadFile("usr/template/".$this->Template."/".$Path)){
                exit();
            }
        }

        if (str_contains($Path, '.css') || str_contains($Path, '.js') || str_contains($Path, '.jpg')  || str_contains($Path, '.png')  || str_contains($Path, '.svg') || str_contains($Path, '.ico') || str_contains($Path, '.webp')){

            if ($this->TryLoadFile($Path)){
                exit();
            }
        }
        if (isset($Permission[$Path])){
            if (in_array($this->CMS->Session->GetRole(), $Permission[$Path])){
                $this->CMS->Security->Include("usr/template/".$this->Template."/".$Path.".php");
                return;
            } else {
                exit(header('Location: ../403'));
            }
        }
        exit(header('Location: ../404'));
    }
    private function TryLoadFile($Path){
        if (file_exists($Path)){
            $extention = pathinfo($Path, PATHINFO_EXTENSION);
            header("Content-Type: ".array_search($extention, $this->Mime));
            header('Content-Length: ' . filesize($Path));
            readfile($Path);
            return true;
        }
        return false;
    }
    private function LoadPerm($Path) : mixed {
        if (!file_exists($Path))
            return null;
        return json_decode(file_get_contents($Path), true);
    }
}
