<?php
namespace WarehouseCore\Shell;

use WarehouseCore\Facade\ShellFacade;

final class Shell
{
    private ShellHelp $help;
    public function __construct(
        private ShellFacade $warehouse
    ) {}

    public function run(): void
    {
        $auth = $this->warehouse->authenticate();

        if (!$this->warehouse->isAuthenticated()) {
            echo $auth . "\n";
            exit(1);
        }

        echo "Warehouse Core v0.1.0\n";
        echo "Type \"help\" for available commands.\n\n";

        while (true) {
            echo "warehouse> ";

            $input = trim(fgets(STDIN));

            if ($input === 'help') {
                echo "help\n\n";

                return;
            }
            if ($input === 'exit') {
                return;
            }

            $arguments = preg_split('/\s+/', $input);
            $call = array_shift($arguments);

            if (!method_exists($this->warehouse, $call)) {
                echo "Unknown command: {$call}\n";
                continue;
            }

            echo $this->warehouse->$call(...$arguments);
            echo "\n";
        }
    }
}