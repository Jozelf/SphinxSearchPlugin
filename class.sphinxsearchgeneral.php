<?php

class SphinxSearchGeneral {

    public static function isRunning($PID) {
        try {
            $Result = shell_exec(sprintf("ps %d", $PID));
            if (count(preg_split("/\n/", $Result)) > 2) {
                return true;
            }
        } catch (Exception $e) {

        }

        return false;
    }

    public static function ClearLogFiles() {
        //first empty output file
        file_put_contents(OUTPUT_FILE, '');
        //Output PID file
        file_put_contents(PID_FILE, '');
        //empty error file
        file_put_contents(ERROR_FILE, '');
    }

    public static function RunCommand($Command, $Path, $PrefixMsg = '', $Background = FALSE) {
        $pipes = array();
        if ($Background) {
            SaveToConfig('Plugin.SphinxSearch.PIDBackgroundWorker', $Command);
            self::ClearLogFiles();
            try {
                chdir($Path);
                exec(sprintf("%s > %s 2>%s & echo $! >> %s", $Command, OUTPUT_FILE, ERROR_FILE, PID_FILE));
                //while(!self::isRunning($PID)); //wait till finish
            } catch (Exception $e) {
                return $e;
            }


            return FALSE;  //return successfully
        } else {
            $descriptorspec = array(
                1 => array('pipe', 'w'),
                2 => array('pipe', 'w'),
            );


            $resource = proc_open($Command, $descriptorspec, $pipes, $Path);

            $stdout = stream_get_contents($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            foreach ($pipes as $pipe) {
                fclose($pipe);
            }

            $status = trim(proc_close($resource));
            if ($status) {
                return ($stderr . '<br/><br/>' .
                        '<b>' . $PrefixMsg . ', try to run this command manually in Terminal: </b><br/>' .
                        $Command . '<br/><br/> at directory: <br/>' .
                        $Path .
                        '<br/><br/>Try running it with sudo if it doesn\'t work
                    <br/><b>Terminal Output:</b><br/>' .
                        $stdout);
            }
            else
                return FALSE;
        }
    }

    /**
     * Simply checks the existense of searchd/indexer/sphinx.conf
     */
    public static function ValidateInstall() {
        if (!file_exists(C('Plugin.SphinxSearch.IndexerPath')) ||
                !file_exists(C('Plugin.SphinxSearch.SearchdPath')) ||
                !file_exists(C('Plugin.SphinxSearch.ConfPath'))
        )
            return T('Must reinstall sphinx...cannot locate indexer/searchd/configuration'); //fail
        else
            return FALSE; //SUCCESS
    }

}