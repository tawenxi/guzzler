<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserListImportHandler implements \Maatwebsite\Excel\Files\ImportHandler {

    public function handle(UserListImport $import)
    {
        // get the results
        $results = $import->get();
    }

}
