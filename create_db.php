<?php

// Helper function to run commands
function runCommand(string $command): void {
    $output = [];
    $return_var = 0;
    
    exec($command, $output, $return_var);
    
    if ($return_var !== 0) {
        echo "Error running {$command}: " . implode("\n", $output) . "\n";
        exit(1); // Exit the script if there is an error
    }
    
    echo "Successfully ran {$command}\n";
}

// Run commands
// runCommand('php datastore/create_sqlite_db.php');
runCommand('php datastore/migration.php');

echo "All commands executed successfully!";
