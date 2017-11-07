<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MoviesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MoviesController Test Case
 */
class MoviesControllerTest extends IntegrationTestCase
{

    private static $movie = [
        'name' => 'Mega Shark',
        'description' => 'un film culte !',
        'duration' => 120
    ];

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.movies'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('movies');
        $this->assertResponseSuccess();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('movies/view/1');
        $this->assertResponseSuccess();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('movies/add');
        $this->assertResponseSuccess();
    }

    public function testAddCheckRedirection()
    {
        $this->post('/movies/add', self::$movie);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'movies', 'action' => 'index']);
    }

    public function testAddCheckDatabase()
    {
        $this->post('/movies/add', self::$movie);

        $this->assertResponseSuccess();

        $movies = TableRegistry::get('Movies');
        $query = $movies->find()->where(['name' => 'Mega Shark']);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('movies/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditCheckRedirectionOnSuccess()
    {
        $this->post('/movies/edit/1', []);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'movies', 'action' => 'index']);
    }

    public function testEditCheckModificationInDatabase()
    {
        $movies = TableRegistry::get('Movies');

        $movie = [
            'name' => 'Titre modifié'
        ];
        $this->post('/movies/edit/1', $movie);

        $movieAfterEdit = $movies->get(1);
        $this->assertEquals('Titre modifié', $movieAfterEdit->name);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('movies/delete/1');
        $this->assertResponseSuccess();
    }
}
