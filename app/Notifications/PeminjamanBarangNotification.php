<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PeminjamanBarangNotification extends Notification
{
    use Queueable;

    protected $peminjamanBarang;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($peminjamanBarang)
    {
        $this->peminjamanBarang = $peminjamanBarang;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id_barang' => $this->peminjamanBarang->id_barang,
            'id_user' => $this->peminjamanBarang->id_user,
            'jumlah' => $this->peminjamanBarang->jumlah,
            'tanggal_pinjam' => $this->peminjamanBarang->tanggal_pinjam,
            'status' => $this->peminjamanBarang->status,
            'message' => 'Pinjaman sedang di proses.'
        ];
    }
}
