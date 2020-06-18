<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\ServiceOrder;

class JobPosted extends Notification
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
					->line('Un nuevo trabajo ha sido publicado para el servicio de '.$this->order->service->name)
					->action('Ver trabajos publicados', url('/worker/jobs'))
					->line('Gracias por publicar en Cinso Estrellas');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		// Note by developer:
		// The data returned by this function represents a PHP plain array 
		// which is subsequently coded in a JSON string to be stored in the 
		// data column of the notifications table.
		return [
			'message' => 'Un nuevo trabajo ha sido publicado para el servicio de '.$this->service->name,
		];
	}
	
	/**
	 * Get the Nexmo/SMS representation of the notification
	 * 
	 * @param mixed $notifiable
	 * @return NexmoMessage
	 */
	public function toNexmo($notifiable)
	{
		return (new NexmoMessage)
				->content('Un nuevo trabajo ha sido publicado para el servicio de '.$this->service->name)
				->from('Cinco Estrellas');
	}
}
