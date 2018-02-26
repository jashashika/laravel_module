<?php

namespace Module\Admin\Repositories;


use Module\Core\Helpers\FileReader;


class AppPerformance
{

    /**
     * this return onboard data
     */
    public function getOnboardData()
    {
// this time takes on-board data from csv file instead of DB table

        $sFilePath = base_path('storage/Admin/onboarding/onboarding_data_2018_02_25.csv');
        $sFileData = FileReader::simpleCsv($sFilePath);

        return $sFileData;
    }
}