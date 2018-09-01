<?php
/**
 * Created by PhpStorm.
 * User: elbardeny
 * Date: 9/1/18
 * Time: 11:19 AM
 */

namespace App\Classes;

use App\Mail\ExcelSheetImported;
use Illuminate\Support\Facades\Mail;
use App\Models\Patient;
use Excel;

class ExcelFileProcess
{
    public $file_path;

    public $file_name;

    public $accepted_count = 0;

    public $rejected_count = 0;

    public function __construct($file_path, $file_name)
    {
        $this->file_path = $file_path;
        $this->file_name = $file_name;
    }

    function process()
    {

        if (!file_exists($this->file_path)) {
            return;
        }

        Excel::filter('chunk')->load($this->file_path)->chunk(250, function ($data) {
            $records_patch = [];

            foreach ($data as $row) {
                $record = [];
                $record['first_name'] = $row->first_name;
                $record['second_name'] = $row->second_name;
                $record['family_name'] = $row->family_name;
                $record['uid'] = $row->uid;

                if (self::check_record($record)) {
                    $records_patch[] = $record;
                }
            }

            $this->accepted_count += count($records_patch);
            $this->rejected_count += 250 - count($records_patch);

            if(count($records_patch)){
                Patient::insert($records_patch);
            }
        });

        Mail::to('example@example.com')->send(new ExcelSheetImported($this->file_name, $this->accepted_count, $this->rejected_count));

    }

    static function check_record($record)
    {
        return count($record) == count(array_filter($record));
    }

}