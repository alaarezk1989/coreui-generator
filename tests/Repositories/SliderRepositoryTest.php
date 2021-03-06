<?php namespace Tests\Repositories;

use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SliderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SliderRepository
     */
    protected $sliderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sliderRepo = \App::make(SliderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_slider()
    {
        $slider = Slider::factory()->make()->toArray();

        $createdSlider = $this->sliderRepo->create($slider);

        $createdSlider = $createdSlider->toArray();
        $this->assertArrayHasKey('id', $createdSlider);
        $this->assertNotNull($createdSlider['id'], 'Created Slider must have id specified');
        $this->assertNotNull(Slider::find($createdSlider['id']), 'Slider with given id must be in DB');
        $this->assertModelData($slider, $createdSlider);
    }

    /**
     * @test read
     */
    public function test_read_slider()
    {
        $slider = Slider::factory()->create();

        $dbSlider = $this->sliderRepo->find($slider->id);

        $dbSlider = $dbSlider->toArray();
        $this->assertModelData($slider->toArray(), $dbSlider);
    }

    /**
     * @test update
     */
    public function test_update_slider()
    {
        $slider = Slider::factory()->create();
        $fakeSlider = Slider::factory()->make()->toArray();

        $updatedSlider = $this->sliderRepo->update($fakeSlider, $slider->id);

        $this->assertModelData($fakeSlider, $updatedSlider->toArray());
        $dbSlider = $this->sliderRepo->find($slider->id);
        $this->assertModelData($fakeSlider, $dbSlider->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_slider()
    {
        $slider = Slider::factory()->create();

        $resp = $this->sliderRepo->delete($slider->id);

        $this->assertTrue($resp);
        $this->assertNull(Slider::find($slider->id), 'Slider should not exist in DB');
    }
}
