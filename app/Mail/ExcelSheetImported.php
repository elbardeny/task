<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExcelSheetImported extends Mailable
{
    use Queueable, SerializesModels;

    public $sheet_name;

    public $accepted_count;

    public $rejected_count;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sheet_name, $accepted_count, $rejected_count)
    {
        $this->sheet_name = $sheet_name;
        $this->accepted_count = $accepted_count;
        $this->rejected_count = $rejected_count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')->view('emails.imported_sheet_results')->with([
            'sheet_name' => $this->sheet_name,
            'accepted_count' => $this->accepted_count,
            'rejected_count' => $this->rejected_count,
        ]);
    }
}
