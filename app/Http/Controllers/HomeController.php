<?php
/**
 * Created by PhpStorm.
 * User: elbardeny
 * Date: 9/1/18
 * Time: 10:47 AM
 */

namespace App\Http\Controllers;


use App\Http\Requests\UploadExcel;
use App\Jobs\ProcessExcelJob;

class HomeController extends Controller
{

    function excel_upload_form()
    {
        return view('excel_upload_form');
    }

    function process_excel_upload(UploadExcel $request)
    {
        dispatch(new ProcessExcelJob($request->excel_file->getRealPath(), $request->excel_file->getClientOriginalName()));

        return back()->with('message', 'the file will be processed.');
    }

}