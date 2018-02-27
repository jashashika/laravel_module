<?php

namespace Module\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Module\Admin\Repositories\AppPerformance;

class AppPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function onboarding()
    {
        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        //dd(json_encode($aData['weekly_percentages']));


//        return response()->json($aData);

        return view('admin::charts.performance.onboarding', ['percentages' => $aData['weekly_percentages']]);
    }
}
