<?php

namespace App\Modules\Member\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    // Import Notifiable Trait
    use Notifiable;

    // Specify Slack Webhook URL to route notifications to
 /*   public function routeNotificationForSlack() {
        return $this->slack_webhook_url;
    }*/

}
