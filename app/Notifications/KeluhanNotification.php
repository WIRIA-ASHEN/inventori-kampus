<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KeluhanNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $keluhan;
    public function __construct($keluhan)
    {
        $this->keluhan = $keluhan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id_barang' => $this->keluhan->id_barang,
            'id_user' => $this->keluhan->id_user,
            'keluhan' => $this->keluhan->keluhan,
            'gambar' => $this->keluhan->gambar,
            'saran' => $this->keluhan->saran,
            'status' => $this->keluhan->status,
            'message' => 'Sesorang menambahkan keluhan',
        ];
    }
}
