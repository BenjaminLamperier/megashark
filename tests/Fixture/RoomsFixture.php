<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoomsFixture
 *
 */
class RoomsFixture extends TestFixture
{

    public $import = ['table' => 'rooms'];

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'capacity' => 1,
            'created' => '2017-11-06 15:34:07',
            'modified' => '2017-11-06 15:34:07'
        ],
    ];
}
