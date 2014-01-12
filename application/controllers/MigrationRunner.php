<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/12/14
 * Time: 5:47 PM
 */

class MigrationRunner extends CI_Controller {
    function up()
    {
        // Выполнение этого метода должно совершаться только через командную строку
        if (PHP_SAPI !== 'cli')
        {
            echo("Run only command line!");
            exit(1);
        }

        // Запуск миграции БД. Текущая версия устанавливается в config/migration.php.
        if (!$this->migration->current()){
            echo($this->migration->error_string());
            exit(1);
        }

        echo("Successful!");
    }
} 