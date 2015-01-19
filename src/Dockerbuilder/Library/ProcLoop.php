<?php
class ProcLoop
{
    private $procs = array();
    private $pipes = array();
    private $stdoutCallbacks = array();
    private $stderrCallbacks = array();
    private static $fdSpecs = array(
        1 => array('pipe', 'w'),
        2 => array('pipe', 'w'),
    );

    public function addProc($cmd, $stdoutCallback, $stderrCallback)
    {
        $this->procs[] = proc_open($cmd, static::$fdSpecs, $pipes);
        stream_set_blocking($pipes[1], 0);
        stream_set_blocking($pipes[2], 0);
        $this->pipes[] = array($pipes[1], $pipes[2]);
        $this->stdoutCallbacks[] = $stdoutCallback;
        $this->stderrCallbacks[] = $stderrCallback;
    }

    public function run()
    {
        $count = count($this->procs);
        while ($this->isAnyPipeAvailable()) {
            for ($i = 0; $i < $count; $i++) {
                $ret = stream_select($tmp = $this->pipes[$i], $write = NULL, $except = NULL, 1);
                if ($ret === false) {
                    throw new RuntimeException;
                } else if ($ret !== 0) {
                    foreach ($this->pipes[$i] as $sock) {
                        if ($buf = fread($sock, 4096)) {
                            if ($buf) {
                                if ($sock === $this->pipes[$i][0]) {
                                    call_user_func($this->stdoutCallbacks[$i], $buf);
                                } else {
                                    call_user_func($this->stderrCallbacks[$i], $buf);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function isAnyPipeAvailable()
    {
        foreach ($this->pipes as $pipe) {
            if (feof($pipe[0]) === false || feof($pipe[1]) === false) {
                return true;
            }
        }
        return false;
    }
}
