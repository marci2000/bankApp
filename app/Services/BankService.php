<?php

namespace App\Services;

use App\Mail\NotificationMail;
use App\Models\Bank;
use App\Models\ExchangeRate;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class BankService {
    private function updateSubscriptionStatus(Subscription $subscription) {
        $subscription->sent = true;
        $subscription->date_sent = Carbon::now();
        $subscription->save();
    }

    public function sendMail(string $bankName) {
        $subscriptions = Subscription::where('bank_id', Bank::id($bankName))
            ->where('sent', 0)
            ->get();

        $subscriptions->map(function ($subscription) use ($bankName) {

            $rate = ExchangeRate::where('currency1', $subscription->currency1)
                ->where('currency2', $subscription->currency2)
                ->where('bank_id', $subscription->bank->id)
                ->latest()
                ->first();

            if ($subscription->under && $rate->value <= $subscription->value) {
                $text = "The exchange rate you are following have fallen under the limit you set.
                At the bank $bankName the exchange rate between $rate->currency1 and $rate->currency2 is $rate->value.";
                Mail::to($subscription->user->email)->send(new NotificationMail($text));
                $this->updateSubscriptionStatus($subscription);
                return;
            }

            if (!$subscription->under && $rate->value > $subscription->under) {
                $text = "The exchange rate you are following have risen above the limit you set.
                At the bank $bankName the exchange rate between $rate->currency1 and $rate->currency2 is $rate->value.";
                Mail::to($subscription->user->email)->send(new NotificationMail($text));
                $this->updateSubscriptionStatus($subscription);
            }
        });
    }
}
