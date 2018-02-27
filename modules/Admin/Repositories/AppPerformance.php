<?php

namespace Module\Admin\Repositories;


use Module\Core\Helpers\FileReader;

/**This class is for application performance checking.
 * Class AppPerformance
 * @package Module\Admin\Repositories
 */
class AppPerformance
{

    /**
     * this return onboard data
     * @return array
     */
    public function getOnboardData()
    {
        //if new milestone is introduced it should come here. best practice is to put this in config file.
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

        $aGraphData = [];
        foreach ($aWeeksCount as $iWeekNumber => $aStages) {
            $iTotalUsers = $aStages['0'];

            $aSeries = [];

            $aSeriesData = [];
            foreach ($aStages as $iPercentage => $iCount) {
                $aSeriesData[] = [$iPercentage, intval(($iCount / $iTotalUsers) * 100)];
            }

            $aSeries['name'] = $iWeekNumber.' week';
            $aSeries['data'] = $aSeriesData;

            $aGraphData[] = $aSeries;
        }

        return ['weekly_counts' => $aWeeksCount, 'graph_data' => $aGraphData];
    }
}