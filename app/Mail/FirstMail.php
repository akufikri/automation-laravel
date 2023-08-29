<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $pengguna;
    
    /**
     * Create a new message instance.
     */
    public function __construct($pengguna)
    {
        $this->pengguna = $pengguna;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('mails.first-mails')
            ->subject(config('app.name') . ' , Go Tax')
            ->with('pengguna', $this->pengguna);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}