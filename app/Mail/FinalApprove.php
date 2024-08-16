<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinalApprove extends Mailable
{
    use Queueable, SerializesModels;
    public $toLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toLink)
    {
        $this->toLink = $toLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link_final = $this->toLink['url'];
        return $this->from('linecall_System@aoth.in.th')
            ->subject('เข้าไปตรวจสอบและอนุมัติข้อมูล LineCall')
            ->markdown('SendMail.mailfinal', ['link' => $link_final]);
    }
}
