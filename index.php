<?php

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
$validEntry = true;
require_once('app.php');
$app = new App;
$app->render();