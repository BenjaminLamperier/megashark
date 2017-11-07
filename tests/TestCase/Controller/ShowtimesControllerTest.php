<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ShowtimesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ShowtimesController Test Case
 */
class ShowtimesControllerTest extends IntegrationTestCase
{

    private static $showtime = [
        'movie_id' => 1,
        'room_id' => 1,
        'start' => '2017-11-06 15:00:00',
        'end' => '2017-11-06 19:00:00',
    ];

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.showtimes',
        'app.movies',
        'app.rooms'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('showtimes');
        $this->assertResponseSuccess();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('showtimes/view/1');
        $this->assertResponseSuccess();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('showtimes/add');
        $this->assertResponseSuccess();
    }

    public function testAddCheckRedirection()
    {
        $this->post('/showtimes/add', self::$showtime);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'showtimes', 'action' => 'index']);
    }

    public function testAddCheckDatabase()
    {
        $this->post('/showtimes/add', self::$showtime);

        $this->assertResponseSuccess();

        $showtimes = TableRegistry::get('Showtimes');
        $query = $showtimes->find()->where(['start' => '2017-11-06 15:00:00']);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('showtimes/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditCheckRedirectionOnSuccess()
    {
        $this->post('/showtimes/edit/1', []);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'showtimes', 'action' => 'index']);
    }

    public function testEditCheckModificationInDatabase()
    {
        $showtimes = TableRegistry::get('Showtimes');

        $showtime = [
            'end' => '2017-11-06 20:00:00'
        ];
        $this->post('/showtimes/edit/1', $showtime);

        $showtimeAfterEdit = $showtimes->get(1);
        $this->assertEquals('2017-11-06 20:00:00', $showtimeAfterEdit->end->format('Y-m-d H:i:s'));
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('showtimes/delete/1');
        $this->assertResponseSuccess();
    }
}
