<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Paper;
use Illuminate\Notifications\Messages\MailMessage;

class PaperAssignedNotification extends Notification
{
    use Queueable;

    protected $paper;

    public function __construct(Paper $paper)
    {
        $this->paper = $paper;
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('您有新论文需要评审')
            ->line('论文题目：《'.$this->paper->title.'》已分配给您评审。')
            ->action('前往评审', url(route('reviewer.papers.show', $this->paper)))
            ->line('请及时登录系统提交评审意见。');
    }

    public function toDatabase($notifiable)
    {
        return [
            'paper_id' => $this->paper->id,
            'title' => $this->paper->title,
            'message' => '您被分配评审论文：《'.$this->paper->title.'》。',
        ];
    }
}