<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Donation;

class DonationSubmitted extends Notification
{
    use Queueable;

    protected $donation;

    /**
     * Create a new notification instance.
     *
     * @param Donation $donation
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'donation_id' => $this->donation->id,
            'blood_type'  => $this->donation->blood_type,
            'units'       => $this->donation->units,
            'title'       => 'New Donation Received',
            'message'     => "A new donation of {$this->donation->units} units of {$this->donation->blood_type} blood has been registered in the system.",
            'status'      => 'donation_logged'
        ];
    }
}