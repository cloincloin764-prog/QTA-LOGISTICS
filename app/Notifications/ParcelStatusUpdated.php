namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ParcelStatusUpdated extends Notification
{
    use Queueable;

    protected $parcel;
    protected $message;

    public function __construct($parcel, $message)
    {
        $this->parcel = $parcel;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        // System Alert (Database) and Email
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Shipment Update: ' . $this->parcel->tracking_code)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line($this->message)
            ->action('Track Shipment', url('/track/' . $this->parcel->tracking_code))
            ->line('Thank you for choosing QTA Logistics.');
    }

    public function toArray($notifiable)
    {
        return [
            'parcel_id' => $this->parcel->id,
            'tracking_code' => $this->parcel->tracking_code,
            'status' => $this->parcel->status,
            'message' => $this->message,
        ];
    }
}