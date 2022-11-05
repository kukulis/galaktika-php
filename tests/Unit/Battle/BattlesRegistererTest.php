<?php

namespace Tests\Unit\Battle;

use PHPUnit\Framework\TestCase;

class BattlesRegistererTest extends TestCase
{
    public function testRegisterBattleInLocation() {
        // TODO
//        BattlesRegisterer

        // if we have two subjects, which are in war and at some moment they are in the same location (planet)
        // then battle in that location should be registered
    }

    public function testNotRegisterBattleInLocation() {
        // if two subject fleets which are not in war are in the same location
        // then battle is not registered
    }

    public function  testRegisterBattleInLocation3_1() {
        // if there are three subjects in location where two pairs of them are in peace, and one pair in war
        // the battle should be registere with two sides which are on war
    }

    public function testRegisterBattleInLocation3_2() {
        // if there are three subject in location where two of them are in peace, but in war against the third,
        // then the battle should be registered between two sides, where in one side there are two subjects which are in peace
        // and in other side is the subject which are in war between two other fleets
    }

    public function testRegisterBattleInLocation3_3() {
        // if the three subjects are in war with each other
        // The three sided battle is registered.
    }

    public function testRegisterBattleInLocationMany() {
        // if there are four subjects in one location where all are in war, then 4 sided battle is registered
    }

    public function testRegisterBattleInLocationManyComplex() {
        // if there are four subjects in one location, where two of them are in peace, but in war with other two,
        // and the other two are in war between each other, then trhee sided battle is registered
    }

}