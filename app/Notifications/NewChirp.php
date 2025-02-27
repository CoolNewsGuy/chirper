<?php

namespace App\Notifications;

use App\Models\Chirp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewChirp extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(public Chirp $chirp)
  {
    //
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notificatiaon.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject("New chirp from {$this->chirp->user->name}")
      ->greeting("New chirp from {$this->chirp->user->name}")
      ->line(Str::limit($this->chirp->message, 50))
      ->action("Go to chirper", url('/'))
      ->line("Thank you for using our app!");
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
