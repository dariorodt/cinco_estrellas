<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\ServiceOrder;

class RememberRate extends Notification
{
    use Queueable;
    
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ServiceOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [/*'nexmo', */'database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Recuerde calificar a '.$this->order->worker->profile->full_name().' por el trabajo de '.$this->order->service->name.' en la order # '.$this->order->id)
                    /*->action('Notification Action', url('/'))*/
                    ->line('Gracias por contratar en CincoEstrellas');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $reflector = new \ReflectionClass($notifiable);
        if ($reflector->getName() == 'App\User') {
            return [
                'message' => 'Recuerde calificar a '.$this->order->worker->profile->f_name.' por el trabajo de '.$this->order->service->name.' en la order # '.$this->order->id
            ];
        } elseif ($reflector->getName() == 'App\Worker') {
            return [
                'message' => 'Recuerde calificar a '.$this->order->client->profile->f_name.' por el trabajo de '.$this->order->service->name.' en la order # '.$this->order->id
            ];
        }
    }
    
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                ->content('Recuerde calificar a '.$this->order->worker->profile->full_name().' por el trabajo de '.$this->order->service->name.' en la order # '.$this->order->id)
                ->from('Cinco Estrellas');
    }
}
