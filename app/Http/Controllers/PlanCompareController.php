<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\SiteSetting;
use App\Services\PlanProcessor;

class PlanCompareController extends Controller
{
    public function index(PlanProcessor $processor)
    {
        $plans = Plan::with(['vendor', 'aiModels', 'benefits'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $config = SiteSetting::getValue('app_config', config('aihub'));
        $processedPlans = $processor->process($plans);

        $vendors = collect($processedPlans)->pluck('vendor')->unique()->sort()->values();
        $models = collect($processedPlans)->flatMap(fn ($p) => $p['models'])->unique()->sort()->values();

        return view('compare.index', [
            'config' => $config,
            'plans' => $processedPlans,
            'vendors' => $vendors,
            'models' => $models,
        ]);
    }
}
