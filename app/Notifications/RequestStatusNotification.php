<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\BloodRequest;

class RequestStatusNotification extends Notification
{
    use Queueable;

    protected $bloodRequest;
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @param BloodRequest $bloodRequest
     * @param string $status ('new', 'approved', 'rejected')
     */
    public function __construct(BloodRequest $bloodRequest, string $status)
    {
        $this->bloodRequest = $bloodRequest;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database']; // Stores notifications directly inside your database table
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @param mixed $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        $title = '';
        $message = '';

        // Dynamically build titles and messages depending on the context
        switch ($this->status) {
            case 'new':
                $title = 'New Blood Request Submitted';
                $message = "A new request for {$this->bloodRequest->units} units of {$this->bloodRequest->blood_type} blood has been submitted for patient {$this->bloodRequest->patient_name}.";
                break;

            case 'approved':
                $title = 'Blood Request Approved';
                $message = "Great news! Your blood request for {$this->bloodRequest->blood_type} (Patient: {$this->bloodRequest->patient_name}) has been approved.";
                break;

            case 'rejected':
                $title = 'Blood Request Rejected';
                $message = "We regret to inform you that your blood request for {$this->bloodRequest->blood_type} has been rejected.";
                break;
        }

        return [
            'blood_request_id' => $this->bloodRequest->id,
            'blood_type'       => $this->bloodRequest->blood_type,
            'patient_name'     => $this->bloodRequest->patient_name,
            'status'           => $this->status,
            'title'            => $title,
            'message'          => $message,
        ];
    }
}