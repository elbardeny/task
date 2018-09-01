<?php
/**
 * Created by PhpStorm.
 * User: elbardeny
 * Date: 9/1/18
 * Time: 11:13 AM
 */

namespace App\Jobs;

use App\Classes\ExcelFileProcess;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessExcelJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * string excel_file_path
     *
     * @var string
     */
    public $excel_file_path;

    public $excel_file_name;

    /**
     * Create a new job instance
     * constructor.
     *
     * @param string $file_path
     */
    public function __construct($file_path, $file_name)
    {
        $this->excel_file_path = $file_path;
        $this->excel_file_name = $file_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = new ExcelFileProcess($this->excel_file_path, $this->excel_file_name);
        $process->process();
    }

}