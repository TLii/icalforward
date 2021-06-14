<?php
if (!isset($validEntry)) {
    die('Not a valid entry point.');
}
/***
 *  icalforwarder - a simple iCal feed forwarder
    Copyright (C) 2021 Tuomas Liinamaa <tuomas@tuomas.fun>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

 */

require_once('./config.php');

class App {
    private $username;
    private $password;
    private $calendarUrl;
    private $authEnabled;

    function __construct() {
        global $config;


        $this->authEnabled = $config['need_auth'];
        if ($this->authEnabled == true) {
            $this->username = $config['calendar_username'];
            $this->password = $config['calendar_password'];
        }
        $this->calendarUrl = $config['calendar_url'];
      
    }

    function getICS() {
        $ch = curl_init($this->calendarUrl);

        $options = array (
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_USERAGENT      => "icsforwarder v. 0.0.1",
            CURLOPT_CONNECTTIMEOUT => 60,
            CURLOPT_TIMEOUT => 60,
        );

        curl_setopt_array($ch, $options);

        if ($this->authEnabled == true) {
            curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        }

        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    function render() {

        if (!isset($_REQUEST['action'])) {
            die('No action selected.');
        } elseif ($_REQUEST['action'] == 'feed') {
            header('Content-type: text/calendar; charset=utf-8');
            header('Content-Disposition: inline; filename=calendar.ics');
            echo $this->getICS();
            exit;
        } elseif ($_REQUEST['action'] == 'raw') {
            echo $this->getICS();
        } else {
            echo 'Malformed request: No action specified.';
        }
    }

}