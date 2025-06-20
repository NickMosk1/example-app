<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadAssignedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public const EMAIL_SUBJECT = 'Для вас новая заявка!';
    public const VIEW_NAME = 'emails.lead_assigned';

    public function __construct(
        public Lead $lead
    ) {}

    public function build()
    {
        return $this
            ->subject(self::EMAIL_SUBJECT)
            ->view(self::VIEW_NAME)
            ->with(['lead' => $this->lead]);
    }
}