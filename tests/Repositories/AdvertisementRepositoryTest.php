<?php namespace Tests\Repositories;

use App\Models\Advertisement;
use App\Repositories\AdvertisementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AdvertisementRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdvertisementRepository
     */
    protected $advertisementRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->advertisementRepo = \App::make(AdvertisementRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_advertisement()
    {
        $advertisement = Advertisement::factory()->make()->toArray();

        $createdAdvertisement = $this->advertisementRepo->create($advertisement);

        $createdAdvertisement = $createdAdvertisement->toArray();
        $this->assertArrayHasKey('id', $createdAdvertisement);
        $this->assertNotNull($createdAdvertisement['id'], 'Created Advertisement must have id specified');
        $this->assertNotNull(Advertisement::find($createdAdvertisement['id']), 'Advertisement with given id must be in DB');
        $this->assertModelData($advertisement, $createdAdvertisement);
    }

    /**
     * @test read
     */
    public function test_read_advertisement()
    {
        $advertisement = Advertisement::factory()->create();

        $dbAdvertisement = $this->advertisementRepo->find($advertisement->id);

        $dbAdvertisement = $dbAdvertisement->toArray();
        $this->assertModelData($advertisement->toArray(), $dbAdvertisement);
    }

    /**
     * @test update
     */
    public function test_update_advertisement()
    {
        $advertisement = Advertisement::factory()->create();
        $fakeAdvertisement = Advertisement::factory()->make()->toArray();

        $updatedAdvertisement = $this->advertisementRepo->update($fakeAdvertisement, $advertisement->id);

        $this->assertModelData($fakeAdvertisement, $updatedAdvertisement->toArray());
        $dbAdvertisement = $this->advertisementRepo->find($advertisement->id);
        $this->assertModelData($fakeAdvertisement, $dbAdvertisement->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_advertisement()
    {
        $advertisement = Advertisement::factory()->create();

        $resp = $this->advertisementRepo->delete($advertisement->id);

        $this->assertTrue($resp);
        $this->assertNull(Advertisement::find($advertisement->id), 'Advertisement should not exist in DB');
    }
}
