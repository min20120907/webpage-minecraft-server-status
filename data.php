<?php
/*
 * 張文相 Zhang Wenxiang - 個人 Blog
 * https://blog.reh.tw/
 *
 * 範例教學
 * https://blog.reh.tw/webpage-display-minecraft-server-status/
 */
define('MQ_SERVER_ADDR', $host);
define('MQ_SERVER_PORT', $port);
define('MQ_TIMEOUT', 1);

require __DIR__.'/data/query.php';
require __DIR__.'/data/ping.php';

if (($Info = $Query->GetInfo()) !== false) { //判斷 Query 是否查詢的到
    $CleanHostName = str_replace(array("§k", "§l", "§m", "§n", "§o", "§r", "§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f"), "", $Info['HostName']); //清除伺服器 MOTD 顏色參數

    $status = "在線"; //伺服器狀態
    $platform = $Info['GameName']; //伺服器平台 (MINECRAFT or MINECRAFTPE)
    $gametype = $Info['GameType']; //遊戲類型

    $motd = $Info['HostName']; //伺服器 MOTD
    $clean_motd = $CleanHostName; //清除顏色參數後的伺服器 MOTD

    $host = $host; //伺服器 IP 或網域
    $hostip = $Info['HostIp']; //伺服器 IP
    $port = $Info['HostPort']; //伺服器端口

    $players_max = $Info['MaxPlayers']; //伺服器可容納最大玩家數
    $players_online = $Info['Players']; //伺服器線上玩家數

    $version = $Info['Version']; //伺服器兼容遊戲版本
    $software = $Info['Software']; //伺服器使用的軟體或核心

    $agreement = "Query"; //使用的查詢協定 (這邊是用來顯示查詢方式的)
    $processed = $Timer; //查詢耗時

    $Players = $Query->GetPlayers(); //取得在線玩家列表
    $Plugins = $info['Plugins']; //取得插件列表
} else if ($InfoPing !== false) { //判斷 Ping 是否查詢的到
    $CleanHostName = str_replace(array("§k", "§l", "§m", "§n", "§o", "§r", "§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f"), "", $InfoPing['description']); //清除伺服器 MOTD 顏色參數

    $status = "在線"; //伺服器狀態
    $platform = "使用 Ping 查詢無法取得資料"; //伺服器平台 (MINECRAFT or MINECRAFTPE)
    $gametype = "使用 Ping 查詢無法取得資料"; //遊戲類型

    $motd = $InfoPing['description']; //伺服器 MOTD
    $clean_motd = $CleanHostName; //清除顏色參數後的伺服器 MOTD

    $host = $host; //伺服器 IP 或網域
    $hostip = "使用 Ping 查詢無法取得資料"; //伺服器主機 IP
    $port = $port; //伺服器端口

    $players_max = $InfoPing['players']['max']; //伺服器可容納最大玩家數
    $players_online = $InfoPing['players']['online']; //伺服器線上玩家數

    $version = explode(" ", $InfoPing['version']['name'], 2);
    $version = $version[1]; //伺服器兼容遊戲版本

    $software = "使用 Ping 查詢無法取得資料"; //伺服器使用的軟體或核心

    $agreement = "Ping"; //使用的查詢協定 (這邊是用來顯示查詢方式的)
    $processed = $Timer; //查詢耗時
} else { //否則為離線
    $status = "離線"; //伺服器狀態
    $host = $host; //伺服器 IP 或網域
    $port = $port; //伺服器端口
}
?>
