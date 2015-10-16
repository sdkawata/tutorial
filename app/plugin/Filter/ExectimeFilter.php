<?php
class Sample_Plugin_Filter_ExectimeFilter extends Ethna_Filter
{
    function prefilter()
    {
        $this->start=microtime(true);
    }

    function postfilter()
    {
        $this->end=microtime(true);
        $time=$this->end-$this->start;
        print "\n<div align=\"right\"><i>this page was processed in {$time} s</i></div>";
    }
}
