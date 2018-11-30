<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 11/30/2018
 * Time: 11:19
 */

namespace App\Http\Common\Imports;

use App\Http\Common\Entities\Accessary;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Exception;

class AccessaryImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel {

    public function bindValue(Cell $cell, $value) {
        if (is_numeric($value)) {
            try {
                $cell->setValueExplicit(DataType::TYPE_NUMERIC);
            } catch (Exception $e) {
            }
            return true;
        }
        return parent::bindValue($cell, $value);
    }

    use Importable;

    /**
     * @param array $row
     *
     * @return Model|Model[]|null
     */
    public function model(array $row) {
        return new Accessary([
            '0' => $row[0],
            '1' => $row[1],
            '2' => $row[2],
            '3' => $row[3],
            '4' => $row[4],
            '5' => $row[5],
            '6' => $row[6],
            '7' => $row[7],
            '8' => $row[8],
            '9' => $row[9],
            '10' => $row[10],
            '11' => $row[11],
            '12' => $row[12],
            '13' => $row[13]
        ]);
    }

}
