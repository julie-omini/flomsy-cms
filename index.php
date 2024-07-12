<?php define('__analytique_server_', '127.0.0.1/analytics/'); ?>
<?php
ini_set("session.cookie_httponly", True);
session_start();
date_default_timezone_set('Europe/Paris');
define("__root__", dirname(__FILE__)."/");

include "./sys/class/CMS.php";
$_SESSION['Role'] = 3;
new CMS();

$buf = [];
$buff = [];

$serie = [
	"starbuttefly" => [
		"banner" => [
			"poster" => "https://mrwallpaper.com/images/hd/star-butterfly-star-vs-the-forces-of-evil-yrqe6duieyafpfky.jpg",
			"trailer" => "https://video.ladyscort.fr/xLQI90Khx167.mp4",
			"title" => "Star Butterfly",
			"description" => "Star Butterfly, une princesse venue d'une autre dimension combat les m\u00e9chants dans de multiples univers pour prot\u00e9ger sa pr\u00e9cieuse baguette magique qu'elle ne sait toujours pas utiliser."
		]
	],
	"luzosville" => [
		"banner" => [
			"poster" => "https:\/\/thumb.canalplus.pro\/http\/unsafe\/1440x810\/filters:quality(80)\/img-hapi.canalplus.pro:80\/ServiceImage\/ImageID\/112228182",
			"trailer" => "https://video.ladyscort.fr/VKxKEFIbrCcd.mp4",
			"title" => "Luz à Osville",
			"description" => "Luz est une adolescente qui se retrouve accidentellement plong\u00e9e dans le Royaume des D\u00e9mons. Elle a un r\u00eave : devenir une sorci\u00e8re."
		]
	],
	"littlestpetshop" => [
		"banner" => [
			"poster" => "https://video.ladyscort.fr/n88Nf0RYyCqo.mp4",
			"trailer" => "https:\/\/wallpapercave.com\/wp\/wp2070636.jpg",
			"title" => "Littlest Pet Shop",
			"description" => "Blythe d\u00e9couvre qu'elle peut parler aux animaux du Littlest Pet Shop, une garderie pour animaux de compagnie, et se lance dans une s\u00e9rie d'aventures palpitantes."
		]
	],
	"labandepicsou" => [
		"banner" => [
			"poster" => "https://image.tmdb.org/t/p/original/tco0lyOHy3bjy2hyishbuCk0Yvg.jpg",
			"trailer" => "https:\/\/video.ladyscort.fr\/pcEHgkZM6HMs.mp4",
			"title" => "La Bande à Picsou",
			"description" => "Riri, Fifi, Loulou et Zaza d\u00e9couvrent d'anciens secrets de famille remontant au pass\u00e9 \u00e9pique de leur oncle Picsou. Ils se retrouvent ainsi embarqu\u00e9s dans d'incroyables escapades de par le monde."
		]
	],
	"wakfu" => [
		"banner" => [
			"poster" => "https://www.france.tv/image/vignette_16x9/800/450/o/p/d/a61a12a0-phpeludpo.jpg",
			"trailer" => "",
			"title" => "Wakfu",
			"description" => ""
		]
	],
	"stevenunivers" => [
		"banner" => [
			"poster" => "https://wallpapers.com/images/featured/steven-universe-background-r68jl28lq9ayxmm5.jpg",
			"trailer" => "https://video.ladyscort.fr/tToJCCFxgQUn.mp4",
			"title" => "Steven Univers",
			"description" => "Le monde est prot\u00e9g\u00e9 des forces mal\u00e9fiques par les Gemmes de Cristal, un groupe de guerri\u00e8res intergalactiques. Les quatre Gems incluent Garnet, Am\u00e9thyst, Perle et Steven, un jeune gar\u00e7on ayant h\u00e9rit\u00e9 d'une Gemme de sa m\u00e8re."
		]
	],
	"avatarlederniermaitredelair" => [
		"banner" => [
			"poster" => "https://www.ecranlarge.com/content/uploads/2021/11/avatar-le-dernier-maitre-de-lair-photo-1404833.jpg",
			"trailer" => "",
			"title" => "Avatar : le dernier maître de l'air",
			"description" => ""
		]
	]
];

$saison = [
	13,
	22,
	21,
	21
];
foreach ($saison as $key => $value) {
	$ss = $key+1;
	for ($i=1; $i < $value+1; $i++) {
		$id = RandomString(16);
		$buf[$id] = [
			"name" => "Star Butterfly - Saison $ss Episode $i",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"mp4",
				"webm",
			],
			"src" => "https://mlpfr.ponies.fr/marco/StarVF$i-{$ss}_{quality}",
			"poster" => "https://mlp-france.com/star/saison1/playerbg.jpg"
		];
		$serie["starbuttefly"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "Star Butterfly - Saison $ss Episode $i",
			"thumbnail" => "https://mlp-france.com/star/saison1/playerbg.jpg"
		];
	}
}

$saison = [
	19,
	21,
	3
];
foreach ($saison as $key => $value) {
	$ss = $key+1;
	for ($i=1; $i < $value+1; $i++) {
		$ep = $i;
		if($ep < 10) $ep = '0'.strval($i);

		$id = RandomString(16);
		$buf[$id] = [
			"name" => "Luz à Osville - Saison $ss Episode $ep",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"mp4",
				"webm",
			],
			"src" => "https://mlpfr.ponies.fr/eda/TOHVF$ep-{$ss}_{quality}",
			"poster" => "https://mlp-france.com/luz/saison1/playerbg.jpg"
		];
		$serie["luzosville"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "Luz à Osville - Saison $ss Episode $i",
			"thumbnail" => "https://mlp-france.com/luz/saison1/playerbg.jpg"
		];
	}
}

$saison = [
	26,
	26,
	26,
	26
];
foreach ($saison as $key => $value) {
	$ss = $key+1;
	for ($i=1; $i < $value+1; $i++) {
		$ep = $i;
		if($ep < 10) $ep = '0'.strval($i);

		$id = RandomString(16);
		$buf[$id] = [
			"name" => "Littlest Pet Shop - Saison $ss Episode $ep",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"mp4",
				"webm",
			],
			"src" => "https://mlpfr.ponies.fr/sunil/VFLPS$ep-{$ss}_{quality}",
			"poster" => "https://mlp-france.com/lps/saison1/playerbg.jpg"
		];
		$serie["littlestpetshop"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "Littlest Pet Shop - Saison $ss Episode $i",
			"thumbnail" => "https://mlp-france.com/lps/saison1/playerbg.jpg"
		];
	}
}

$saison = [
	23,
	24,
	22
];
foreach ($saison as $key => $value) {
	$s = $key+1;
	$ss = $key+1;
	if($ss < 10) $ss = '0'.strval($ss);

	for ($i=1; $i < $value+1; $i++) {
		$ep = $i;
		if($ep < 10) $ep = '0'.strval($i);

		$id = RandomString(16);
		$buff[$id] = [
			"name" => "La Bande à Picsou - Saison $ss Episode $ep",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"mp4"
			],
			"src" => "https://needforponies.fr/media/videos/ducktales_{$ss}x{$ep}_VF_{quality}",
			"poster" => "https://needforponies.fr/media/images/thumbnails/ducktales-$s-$i.jpg"
		];
		$serie["labandepicsou"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "La Bande à Picsou - Saison $ss Episode $i",
			"thumbnail" => "https://needforponies.fr/media/images/thumbnails/ducktales-$s-$i.jpg"
		];
	}
}


$saison = [
	26,
	26,
	13
];
foreach ($saison as $key => $value) {
	$s = $key+1;
	$ss = $key+1;
	if($ss < 10) $ss = '0'.strval($ss);

	for ($i=1; $i < $value+1; $i++) {
		$ep = $i;
		if($ep < 10) $ep = '0'.strval($i);

		$id = RandomString(16);
		$buff[$id] = [
			"name" => "Wakfu - Saison $ss Episode $ep",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"mp4",
				"webm",
			],
			"src" => "https://needforponies.fr/media/videos/wakfu_{$ss}x{$ep}_{quality}",
			"poster" => "https://needforponies.fr/media/images/thumbnails/wakfu-$s-$i.jpg"
		];
		$serie["wakfu"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "Wakfu - Saison $ss Episode $i",
			"thumbnail" => "https://needforponies.fr/media/images/thumbnails/wakfu-$s-$i.jpg"
		];
	}
}

$saison = [
	52,
	26,
	25,
];
foreach ($saison as $key => $value) {
	$s = $key+1;
	$ss = $key+1;
	if($ss < 10) $ss = '0'.strval($ss);

	for ($i=1; $i < $value+1; $i++) {
		$ep = $i;
		if($ep < 10) $ep = '0'.strval($i);

		$id = RandomString(16);
		$buff[$id] = [
			"name" => "Steven Univers - Saison $ss Episode $ep",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"webm",
			],
			"src" => "https://needforponies.fr/media/videos/steven-universe_{$ss}x{$ep}_VF_{quality}",
			"poster" => "https://needforponies.fr/media/images/thumbnails/steven-universe-$s-$i.jpg"
		];
		$serie["stevenunivers"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "Steven Univers - Saison $ss Episode $i",
			"thumbnail" => "https://needforponies.fr/media/images/thumbnails/steven-universe-$s-$i.jpg"
		];
	}
}


$saison = [
	20,
	20,
	21
];
foreach ($saison as $key => $value) {
	$s = $key+1;
	$ss = $key+1;
	if($ss < 10) $ss = '0'.strval($ss);

	for ($i=1; $i < $value+1; $i++) {
		$ep = $i;
		if($ep < 10) $ep = '0'.strval($i);

		$id = RandomString(16);
		$buff[$id] = [
			"name" => "Avatar : le dernier maître de l'air - Saison $ss Episode $ep",
			"mediaQuality" => [
				"360p",
				"480p",
				"720p",
			],
			"mediaType" => [
				"webm",
			],
			"src" => "https://needforponies.fr/media/videos/avatar-last-airbender_{$ss}x{$ep}_VF_{quality}",
			"poster" => "https://needforponies.fr/media/images/thumbnails/avatar-last-airbender-$s-$i.jpg"
		];
		$serie["avatarlederniermaitredelair"]['replay']["Saison $ss"][] = [
			"id" => $id,
			"name" => "Avatar : le dernier maître de l'air - Saison $ss Episode $i",
			"thumbnail" => "https://needforponies.fr/media/images/thumbnails/avatar-last-airbender-$s-$i.jpg"
		];
	}
}


$data = [
	"Needforponies" => $buff,
	"Mlp-France" => $buf
];

file_put_contents('watch.json', json_encode($serie, JSON_PRETTY_PRINT));

file_put_contents('channel.json', json_encode($data, JSON_PRETTY_PRINT));

function RandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}