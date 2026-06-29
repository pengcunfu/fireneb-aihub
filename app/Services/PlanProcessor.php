<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Collection;

class PlanProcessor
{
    public function process(Collection $plans): array
    {
        return $plans->values()->map(function (Plan $plan, int $index) {
            $firstMonth = $plan->first_month_price ?? $plan->monthly_price;
            $quarterly = $plan->quarterly_price ?? ($plan->monthly_price * 3);
            $yearly = $plan->yearly_price ?? ($quarterly * 3);

            $hourly = $plan->hourly_requests === '未公开'
                ? '未公开'
                : (int) $plan->hourly_requests;

            $monthly = $plan->monthly_requests === '未公开'
                ? '未公开'
                : (int) $plan->monthly_requests;

            return [
                'id' => $plan->id,
                'vendor' => $plan->vendor->name,
                'plan' => $plan->name,
                'action' => $plan->action_url,
                'firstMonthPrice' => $firstMonth,
                'monthlyPrice' => (float) $plan->monthly_price,
                'quarterlyPrice' => $quarterly,
                'yearlyPrice' => $yearly,
                'models' => $plan->aiModels->pluck('name')->all(),
                'hourlyRequests' => $hourly,
                'monthlyRequests' => $monthly,
                'benefits' => $plan->benefits->pluck('name')->all(),
                'note' => $plan->note ?? '',
                'originalIndex' => $index,
            ];
        })->all();
    }
}
