<?php

namespace ReesMcIvor\Auth\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Nette\Utils\Html;
use NotificationChannels\Expo\ExpoChannel;
use App\Notifications\GmailChannel;

class AppInvitation extends Notification
{

    use Queueable;

    protected string $password = '';

    public function __construct( $newPassword = '' )
    {
        $this->password = $newPassword;
    }

    public function via()
    {
        return ['mail', 'slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)->content( sprintf('App Invitation sent to %s', $notifiable->email) );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to the Optimal Movement App')
            ->bcc(['Optimal Movement' => 'info@optimal-movement.co.uk' ])
            ->markdown('email.user.app_invitation', ['password' => $this->password]);
    }
}
