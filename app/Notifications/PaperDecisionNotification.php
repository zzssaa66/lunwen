<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Paper;
use Illuminate\Notifications\Messages\MailMessage;

class PaperDecisionNotification extends Notification
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
        $statusText = match($this->paper->status) {
            'accepted' => '已接受',
            'revision_requested' => '需要修改',
            'rejected' => '已拒绝',
            default => $this->paper->status,
        };
        return (new MailMessage)
            ->subject('论文审核结果')
            ->line('您的论文《'.$this->paper->title.'》审核已完成，结果：'.$statusText)
            ->when($this->paper->remarks, fn($mail) => $mail->line('备注：'.$this->paper->remarks))
            ->action('查看详情', url(route('papers.show', $this->paper)));
    }

    public function toDatabase($notifiable)
    {
        return [
            'paper_id' => $this->paper->id,
            'status' => $this->paper->status,
            'remarks' => $this->paper->remarks,
        ];
    }
}