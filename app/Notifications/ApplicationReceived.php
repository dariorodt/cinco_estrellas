<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\ServiceOrder;

class ApplicationReceived extends Notification
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
					->line('Usted ha recibido aplicacions en su orden # '.$this->order->id.' de '.$this->order->service->name)
					->action('Ver las aplicaciones', url('/order/'.$this->order->id.'/edit'))
					->line('Gracias por contratar en Cinco Estrellas');
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
			'message' => 'Usted ha recibido aplicacions en su orden # '.$this->order->id.' de '.$this->order->service->name
		];
	}
	
	public function toNexmo($notifiable)
	{
		return (new NexmoMessage)
				->content('Usted ha recibido aplicacions en su orden # '.$this->order->id)
				->from('Cinco Estrellas');
	}
}
