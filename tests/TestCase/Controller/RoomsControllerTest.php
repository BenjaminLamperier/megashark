<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RoomsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RoomsController Test Case
 */
class RoomsControllerTest extends IntegrationTestCase
{

    private static $room = [
        'name' => 'Salle 1',
        'capacity' => 130
    ];

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rooms'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('rooms');
        $this->assertResponseSuccess();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('rooms/view/1');
        $this->assertResponseSuccess();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('rooms/add');
        $this->assertResponseSuccess();
    }

    public function testAddCheckRedirection()
    {
        $this->post('/rooms/add', self::$room);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'rooms', 'action' => 'index']);
    }

    public function testAddCheckDatabase()
    {
        $this->post('/rooms/add', self::$room);

        $this->assertResponseSuccess();

        $rooms = TableRegistry::get('Rooms');
        $query = $rooms->find()->where(['name' => 'Salle 1']);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('rooms/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditCheckRedirectionOnSuccess()
    {
        $this->post('/rooms/edit/1', []);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'rooms', 'action' => 'index']);
    }

    public function testEditCheckModificationInDatabase()
    {
        $rooms = TableRegistry::get('Rooms');

        $room = [
            'name' => 'Salle 2'
        ];
        $this->post('/rooms/edit/1', $room);

        $roomAfterEdit = $rooms->get(1);
        $this->assertEquals('Salle 2', $roomAfterEdit->name);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('rooms/delete/1');
        $this->assertResponseSuccess();
    }
}
