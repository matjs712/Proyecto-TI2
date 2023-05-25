<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class NotificacionEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $orders, $orderItem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->orders = $order;
        $this->orderItem = OrderItem::where('order_id', $order->id)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification');
    }
}