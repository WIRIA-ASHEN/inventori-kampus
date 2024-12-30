<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PeminjamanBarangDiterima extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $peminjamanBarang;

    public function __construct($peminjamanBarang)
    {
        $this->peminjamanBarang = $peminjamanBarang;
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
     * Get the mail representation of the notification.
     */
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'id_barang' => $this->peminjamanBarang->id_barang,
            'id_user' => $this->peminjamanBarang->id_user,
            'jumlah' => $this->peminjamanBarang->jumlah,
            'tanggal_pinjam' => $this->peminjamanBarang->tanggal_pinjam,
            'status' => $this->peminjamanBarang->status,
            'message' => 'Pinjaman sedang diterima.'
        ];
    }
}
