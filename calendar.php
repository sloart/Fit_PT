<?php
class Calendar {
    private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    private $currentYear = 0;
    private $currentMonth = 0;
    private $currentDay = 0;
    private $currentDate = null;
    private $daysInMonth = 0;
    private $naviHref = null;

    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    public function show()
    {
        $year = isset($_GET['year']) ? $_GET['year'] : date("Y");
        $month = isset($_GET['month']) ? $_GET['month'] : date("m");

        $this->currentYear = $year;
        $this->currentMonth = $month;
        $this->daysInMonth = $this->_daysInMonth($month, $year);

        $content = '<div id="calendar">' .
            '<div class="box">' .
            $this->_createNavi() .
            '</div>' .
            '<div class="box-content">' .
            '<ul class="label">' . $this->_createLabels() . '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates">';

        $daysInMonth = $this->daysInMonth;
        $dayOffset = date("N", strtotime($year . '-' . $month . '-01')) - 1;
        $lastDayOffset = date("N", strtotime($year . '-' . $month . '-' . $daysInMonth)) - 1;

        for ($i = 0; $i < $dayOffset; $i++) {
            $content .= '<li></li>';
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $weekday = date("N", strtotime($year . '-' . $month . '-' . $day));
            $content .= '<a href="view_appointments.php?date=' . $year . '-' . $month . '-' . $day . '"><li class="' . ($weekday == 7 ? 'end' : ($weekday == 6 ? 'start' : '')) . '">' . $day . '</li></a>';
        }

        for ($i = 0; $i < (6 - $lastDayOffset); $i++) {
            $content .= '<li></li>';
        }

        $content .= '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '</div>';
        $content .= '</div>';
        return $content;
    }

    private function _createNavi()
    {
        $nextMonth = ($this->currentMonth == 12) ? 1 : ($this->currentMonth + 1);
        $nextYear = ($this->currentMonth == 12) ? ($this->currentYear + 1) : $this->currentYear;
        $preMonth = ($this->currentMonth == 1) ? 12 : ($this->currentMonth - 1);
        $preYear = ($this->currentMonth == 1) ? ($this->currentYear - 1) : $this->currentYear;

        return '<div class="header">' .
            '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
            '<span class="title">' . date('F Y', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
            '<a class="next" href="' . $this->naviHref . '?month=' . sprintf('%02d', $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
            '</div>';
    }

    private function _createLabels()
    {
        $content = '';

        foreach ($this->dayLabels as $index => $label) {
            $content .= '<li class="' . ($label == "Sun" ? 'end title' : ($label == "Mon" ? 'start title' : 'title')) . '">' . $label . '</li>';
        }

        return $content;
    }

    private function _daysInMonth($month = null, $year = null)
    {
        if (is_null($year)) {
            $year = date("Y");
        }
        if (is_null($month)) {
            $month = date("m");
        }
        return date('t', strtotime($year . '-' . $month . '-01'));
    }
}
?>