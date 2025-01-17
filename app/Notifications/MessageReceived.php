<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\ServiceOrder;

class MessageReceived extends Notification
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
					->line('Usted tiene un nuevo mensaje en la orden de servicio '.$this->order->service->name)
					/*->action('Ver mensajes', url('/'))*/
					->line('Gracias por trabajar en Cinco Estrellas');
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
			'message' => 'Usted tiene un nuevo mensaje en la orden de servicio '.$this->order->service->name,
		];
	}
	
	public function toNexmo($notifiable)
	{
		return (new NexmoMessage)
				->content('Usted tiene un nuevo mensaje en la orden de servicio '.$this->order->service->name)
				->from('Conco Estrellas');
	}
}
