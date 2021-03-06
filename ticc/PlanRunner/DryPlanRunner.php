<?php
/**
 * Transactional Iterative Changes - Manage database changes
 *
 * Copyright (C) 2016 Matthew Krauss
 * Copyright (C) 2016 Matthew Carter
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Report issues at: https://github.com/mkrauss/ticc
 */

namespace ticc\PlanRunner;

use Functional as F;
use ticc\Plan;
use ticc\Change;

class DryPlanRunner implements \ticc\PlanRunner {
    /*
     * Plan runner that just prints what it would do
     */

    public function deploy_plan(Plan $plan) {
        /*
         * Print all changes in $plan
         */
        $plan->inject_changes_to(
            function (Change $change) {
                echo "Deploying: {$change->name()}... ";
                if (is_null($change->deploy_script())) {
                    echo "Nothing to deploy.\n";}
                else {
                    echo " Done.\n";}});}


    public function revert_plan(Plan $plan) {
        /*
         * Revert all changes in $plan
         */
        $plan->inject_changes_to(
            function (Change $change) {
                echo "Reverting: {$change->name()}...";
                if (is_null($change->revert_script())) {
                    echo "Nothing to revert.\n";}
                else {
                    echo " Done.\n";}});}


    public function verify_plan(Plan $plan) {
        /*
         * Verify all changes in $plan
         */
        $plan->inject_changes_to(
            function (Change $change) {
                echo "Verifying: {$change->name()}... ";
                if (is_null($change->verify_script())) {
                    echo "Nothing to verify.\n";}
                else {
                    echo " Good.\n";}});}}