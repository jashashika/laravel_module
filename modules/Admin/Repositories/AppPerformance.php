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
        $aMilestones = [100, 99, 95, 92, 90, 85, 80, 75, 70, 60, 55, 50, 45, 40, 35, 30, 20, 0];

        // this time takes on-board data from csv file instead of DB table
        $sFilePath = base_path('storage/Admin/onboarding/onboarding_data_2018_02_25.csv');
        $aFileData = FileReader::simpleCsv($sFilePath);

        $aWeeksCount = [];
        foreach ($aFileData as $iIndex => $aRow) {
            $oDate = new \DateTime($aRow['created_at']);
            $iWeek = $oDate->format("W");

            $aWeekRecords[$iWeek][] = $aRow;

            $iPercentage = $aRow['onboarding_percentage'];
            $aRelevantMilestones = array_slice($aMilestones, array_search($iPercentage, $aMilestones));
            foreach ($aRelevantMilestones as $iMilestone) {
                $aWeeksCount[$iWeek][$iMilestone] = isset($aWeeksCount[$iWeek][$iMilestone]) ? ++$aWeeksCount[$iWeek][$iMilestone] : 1;
            }

            ksort($aWeeksCount[$iWeek]);
        }

        $aWeeksPercentages = [];
        foreach ($aWeeksCount as $iWeekNumber => $aStages) {
            $iTotalUsers = $aStages['0'];
            foreach ($aStages as $iPercentage => $iCount) {
                $aWeeksPercentages[$iWeekNumber][$iPercentage] = ($iCount / $iTotalUsers) * 100;
            }
            ksort($aWeeksPercentages[$iWeekNumber]);
        }
        ksort($aWeeksPercentages);

        return ['weekly_counts' => $aWeeksCount, 'weekly_percentages' => $aWeeksPercentages];
    }
}