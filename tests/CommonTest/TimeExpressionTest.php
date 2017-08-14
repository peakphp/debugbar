<?php

use PHPUnit\Framework\TestCase;

use Peak\Common\TimeExpression;

class TimeExpressionTest extends TestCase
{
    function testExpression()
    {
        $this->assertTrue( (new TimeExpression(1))->toMicroseconds() === 1000);
        $this->assertTrue( (new TimeExpression(1000))->toSeconds() === 1000);
        $this->assertTrue( (new TimeExpression("2day"))->toSeconds() === 172800);
        $this->assertTrue( (new TimeExpression("2 day"))->toSeconds() === 172800);
        $this->assertTrue( (new TimeExpression("2 day"))->toSeconds() === 172800);
        $this->assertTrue( (new TimeExpression("2 days"))->toSeconds() === 172800);
        $this->assertTrue( (new TimeExpression("2     days"))->toSeconds() === 172800);
        $this->assertTrue( (new TimeExpression("2 days 1 sec"))->toSeconds() === 172801);
        $this->assertTrue( (new TimeExpression("2day 15min"))->toSeconds() === 173700);
        $this->assertTrue( (new TimeExpression("15min2day"))->toSeconds() === 173700);
        $this->assertTrue( (new TimeExpression("4min30sec"))->toSeconds() === 270);
        $this->assertTrue( (new TimeExpression("4mins"))->toSeconds() === 240);

        // using DateInterval syntax (ISO8601 interval spec)
        $this->assertTrue( (new TimeExpression("PT1H35M45S"))->toSeconds() === 5745);
        $this->assertTrue( (new TimeExpression("P2D"))->toSeconds() === 172800);
        $this->assertTrue( (new TimeExpression("P2DT1M15S"))->toSeconds() === 172875);
        $this->assertTrue( (new TimeExpression("P2DT1M15S"))->toString() === '2 days 1 minute 15 seconds');

        // using DateInterval syntax (ISO8601 interval spec) with custom format
        $this->assertTrue(
            (new TimeExpression("P3DT5H"))->toString('%d jours %h heures') === '3 jours 5 heures'
        );
        $this->assertTrue(
            (new TimeExpression("P3DT5H"))->toString('%y years %d days %h hours') === '0 years 3 days 5 hours'
        );


        // using TimeExpression to substract time from a DateTime
        $datetime = new DateTime('2017-08-14 11:00:00');
        $datetime->sub(new TimeExpression('PT25M')); // substract 25 minutes
        $this->assertTrue($datetime->format('Y-m-d H:i:s') === '2017-08-14 10:35:00');

        // using TimeExpression to add time from a DateTime
        $datetime = new DateTime('2017-08-14 11:00:00');
        $datetime->add(new TimeExpression('PT25M15S'));
        $this->assertTrue($datetime->format('Y-m-d H:i:s') === '2017-08-14 11:25:15');

        // using TimeExpression to add time from a DateTime
        $datetime = new DateTime('2017-08-14 11:00:00');
        $datetime->add(new TimeExpression('25 mins 15 secs'));
        $this->assertTrue($datetime->format('Y-m-d H:i:s') === '2017-08-14 11:25:15');

        // getting ISO8601 interval spec
        $this->assertTrue( (new TimeExpression('2 days 1 sec'))->toIntervalSpec() === 'P2DT1S');

        // getting ISO8601 interval spec
        $this->assertTrue( (new TimeExpression(1500))->toIntervalSpec() === 'PT25M');

//        echo "\n";
//        echo (new TimeExpression(125))->toSeconds(); // 125
//        echo "\n";
//        echo (new TimeExpression("2day"))->toSeconds(); // 172800
//        echo "\n";
//        echo (new TimeExpression("4min30sec"))->toSeconds(); // 270;
//        echo "\n";
//
//        // using DateInterval (ISO8601 interval spec)
//        echo (new TimeExpression("PT1H35M45S"))->toSeconds(); //5745;
//        echo "\n";
//        echo (new TimeExpression("PT1H35M45S"))->toString(); //1 hour 35 minutes 45 seconds;
//        echo "\n";
//        echo (new TimeExpression("PT1H35M45S"))->toString('%y Years, %m Months, %d Days, %h Hours, %i Minutes, %s Seconds');
//        //0 Years, 0 Months, 0 Days, 1 Hours, 35 Minutes, 45 Seconds
//        echo "\n";
//
//        $datetime = new DateTime('2017-08-14 11:00:00');
//        $datetime->sub(new TimeExpression('PT25M'));
//        echo $datetime->format('Y-m-d H:i:s'); //2017-08-14 10:35:00');
//
//        $datetime = new DateTime('2017-08-14 11:00:00');
//        $datetime->sub(new TimeExpression('25 min'));
//        echo $datetime->format('Y-m-d H:i:s'); //2017-08-14 10:35:00');
//
//        $datetime = new DateTime('2017-08-14 11:00:00');
//        $datetime->add(new TimeExpression(1501));
//        echo $datetime->format('Y-m-d H:i:s'); //2017-08-14 10:35:00');

//        $di = new DateInterval()

    }
}


class DateInterval2 extends DateInterval
{

}