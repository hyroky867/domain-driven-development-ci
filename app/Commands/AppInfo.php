<?php

declare(strict_types=1);

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\Exceptions\CLIException;

class AppInfo extends BaseCommand
{
    protected $group = 'demo';
    protected $name = 'app:info';
    protected $description = 'Displays basic application information.';

    /**
     * @param string[] $params
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function run(array $params): void
    {
        $php_version_color = CLI::color((string) phpversion(), 'yellow');
        CLI::write("PHP Version: {$php_version_color}");

        $ci_version_color = CLI::color(\CodeIgniter\CodeIgniter::CI_VERSION, 'yellow');
        CLI::write("CI Version: {$ci_version_color}");

        $app_path_color = CLI::color(APPPATH, 'yellow');
        CLI::write("APP_PATH: {$app_path_color}");

        $system_path_color = CLI::color(SYSTEMPATH, 'yellow');
        CLI::write("SYSTEM_PATH: {$system_path_color}");

        $root_path_color = CLI::color(ROOTPATH, 'yellow');
        CLI::write("ROOT_PATH: {$root_path_color}");

        $included_files_color = CLI::color((string) count(get_included_files()), 'yellow');
        CLI::write("Included files: {$included_files_color}");
    }
}
