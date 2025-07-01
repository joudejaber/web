<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Contract;

class ContractUpdated extends Notification
{
    protected $contract;

    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    public function via($notifiable)
    {
        return ['database']; // stored in DB
    }

    public function toDatabase($notifiable)
{
    return [
        'message' => 'Your contract has been updated.',
        'contract_id' => $this->contract->id,
    ];
}

}

