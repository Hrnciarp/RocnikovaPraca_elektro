<?php

namespace App\Mail;

use App\Http\Controllers\KosikController;
use App\Models\Produkty;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PotvrdenieObjednavky extends Mailable
{
    use Queueable, SerializesModels;

    public $cisloObjednavky;
    public $cartItems;
    public $totalPrice;
    public $cartItemsWithPrices;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->cisloObjednavky = $this->generateCisloObjednavky();
        $this->totalPrice = \App\Http\Controllers\KosikController::calculateTotalPrice();
        $this->cartItems = \App\Http\Controllers\KosikController::getCartItems();
        $this->cartItemsWithPrices = \App\Http\Controllers\KosikController::getCartItemsWithPrices();

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            subject: 'GEARSHOP: Potvrdenie objednávky - ' . $this->cisloObjednavky,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'objednavka',
        );
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


    private function generateCisloObjednavky()
    {
        return strtoupper(substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 10)), 0, 10));
    }
}
