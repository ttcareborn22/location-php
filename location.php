<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
	                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile',
                            '/windows nt 10/i'      =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',

                        );
    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }   
    return $os_platform;
}

function getBrowser() {
    global $user_agent;
    $browser        =   "Unknown Browser";
    $browser_array  =   array(
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser',
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',

                        );
    foreach ($browser_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }
    return $browser;
}
$user_browser   =   getBrowser();
$user_os        =   getOS();
$user_ip        =   $_SERVER['REMOTE_ADDR'];
if ($user_ip == "127.0.0.1") {
    $location = "localhost";
} else {
    $json = file_get_contents("http://freegeoip.net/json/{$user_ip}");
    $expression = json_decode($json);
    $location = $expression->country_name;
}
?>

<html>
<head>
    <title>Client Information</title>
    <style type="text/css">
        html {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            margin-right: auto;
            margin-left: auto;
        }

        table, th, td {
            padding: 5px;
        }

        th {
            background-color: #2E55FF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #2E55FF
        }

        h1 {
            margin-bottom: 0;
        }
    </style>
    <link rel="shortcut icon" href="/favicon.png">
</head>
<body>
    <table width="50%">
        <tr align="center">
            <th colspan="3"><h1>Informasi Pengunjung Twenty Tools</h1></th>
        </tr>
        <tr>
            <td><b>Sistem Operasi</b></td>
            <td>:</td>
            <td><?php echo $user_os;?></td>
        </tr>
        <tr>
            <td><b>Browser</b></td>
            <td>:</td>
            <td><?php echo $user_browser;?></td>
        </tr>
        <tr>
            <td><b>IP</b></td>
            <td>:</td>
            <td><?php echo $user_ip;?></td>
        </tr>
        <tr>
            <td><b>Negara</b></td>
            <td>:</td>
            <td><?php echo $location;?></td>
        </tr>
        <tr>
            <td><b>Selengkapnya</b></td>
            <td>:</td>
            <td><?php echo $_SERVER['HTTP_USER_AGENT'];?></td>
        </tr>
    </table>
</body>
</html>
