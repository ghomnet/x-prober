<?php

namespace InnStudio\Prober\Components\Database;

use InnStudio\Prober\Components\Events\EventsApi;
use InnStudio\Prober\Components\Xconfig\XconfigApi;
use PDO;
use SQLite3;

final class Conf extends DatabaseConstants
{
    public function __construct()
    {
        EventsApi::on('conf', function (array $conf) {
            if (XconfigApi::isDisabled($this->ID)) {
                return $conf;
            }

            $sqlite3Version = class_exists('SQLite3') ? SQLite3::version() : false;

            $conf[$this->ID] = array(
                'sqlite3'             => $sqlite3Version ? $sqlite3Version['versionString'] : false,
                'sqliteLibversion'    => \function_exists('sqlite_libversion') ? sqlite_libversion() : false,
                'mysqliClientVersion' => \function_exists('mysqli_get_client_version') ? mysqli_get_client_version() : false,
                'mongo'               => class_exists('Mongo'),
                'mongoDb'             => class_exists('MongoDB'),
                'postgreSql'          => \function_exists('pg_connect'),
                'paradox'             => \function_exists('px_new'),
                'msSql'               => \function_exists('sqlsrv_server_info'),
                'pdo'                 => class_exists('PDO') ? implode(',', PDO::getAvailableDrivers()) : false,
            );

            return $conf;
        });
    }
}
