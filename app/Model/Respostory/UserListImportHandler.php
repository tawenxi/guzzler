<?php

namespace App\Model\Respostory;

class UserListImportHandler implements \Maatwebsite\Excel\Files\ImportHandler
{
    public function handle(UserListImport $import)
    {
        // get the results
        $results = $import->get();
    }
}
