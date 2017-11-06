<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ShowtimesFixture
 *
 */
class ShowtimesFixture extends TestFixture
{

    public $import = ['table' => 'showtimes'];

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'movie_id' => 1,
            'room_id' => 1,
            'start' => '2017-11-06 15:34:21',
            'end' => '2017-11-06 15:34:21',
            'created' => '2017-11-06 15:34:21',
            'modified' => '2017-11-06 15:34:21'
        ],
    ];
}
