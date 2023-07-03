<?php
/**
 * @author Sebastian Pondo
 */

namespace Diagnolek\Lib\Cron;

class CronManager implements CronInterface
{

    private string $user = '';

    /**
     * @breif returns `crontab -l` result
     */
    public function getCrontab(): array
    {
        exec("crontab -l", $output, $exitCode);
        $result = [];
        if ($exitCode === 0) {
            $result = $output;
        }
        return $result;
    }

    /**
     * @brief only returns working cronjobs except for comment and blank
     */
    public function getListedCronjob(): array
    {
        exec("crontab -l", $output, $exitCode);
        $result = [];
        if ($exitCode === 0) {
            foreach ($output as $idx => $cronjob) {
                if ($cronjob && (substr($cronjob, 0, 1) != '#')) {
                    $result[] = $cronjob;
                }
            }
        }
        return $result;
    }

    public function cronDuplicationChecker($cronTag): bool
    {
        $listedCronjob = $this->getListedCronjob();
        $result = false;
        if ($listedCronjob) {
            foreach ($listedCronjob as $line => $cronjob) {
                $cron_duplication_check = strpos($cronjob, '#CRONTAG='.$cronTag);
                if ($cron_duplication_check) {
                    $result = true;
                }
            }
        }
        return $result;
    }

    public function addCronjob($command, $cronTag): array
    {
        $result = array(
            'status' => 'status',
            'msg'    => 'msg',
            'data'   => 'data'
        );

        $cronDuplicationCheck = $this->cronDuplicationChecker($cronTag);
        $managedCommand = '(crontab -l; echo "'.$command.' #CRONTAG='.$cronTag.'") | crontab -';

        if (!$cronTag) {
            $result['status'] = 'INPUT_ERROR';
            $result['msg'] = 'cron_tag is required';
            $result['data'] = $managedCommand;
        } else if ($cronDuplicationCheck) {
            $result['status'] = 'FAILED';
            $result['msg'] = 'duplicated cron tag exists';
            $result['data'] = true;
        } else {
            exec($managedCommand, $output, $exitCode);
            $result['data'] = array(
                'cron_add_output'   => $output,
                'cron_add_exitcode' => $exitCode,
                'managed_command'   => $managedCommand
            );
            if ($exitCode === 0) {
                $result['status'] = 'SUCCESS';
                $result['msg'] = 'added new cronjob';
            } else if ($exitCode === 127) {
                $result['status'] = 'ERROR';
                $result['msg'] = 'crond is not running or not installed';
            } else {
                $result['status'] = 'ERROR';
                $result['msg'] = 'error occurred in progress to register new cron job';
            }
        }
        return $result;
    }

    public function removeCronjob($cronTag): bool
    {
        $cronDuplicationCheck = $this->cronDuplicationChecker($cronTag);
        $result = false;
        if ($cronDuplicationCheck) {
            exec("crontab -l | sed '/\(.*#CRONTAG=$cronTag\)/d' | crontab ", $output, $exitCode);
            if ($exitCode === 0) {
                $result = true;
            }
        }
        return $result;
    }

    public function user(): string
    {
        if ($this->user !== '') return $this->user;
        ob_start();
        echo `whoami`;
        $this->user = ob_get_contents();
        ob_end_clean();
        return $this->user;
    }

    public function isRunning(): bool
    {
        ob_start();
        echo `ps -eaf | grep [c]ron`;
        $running = ob_get_contents();
        ob_end_clean();
        return $running !== '';
    }

}
