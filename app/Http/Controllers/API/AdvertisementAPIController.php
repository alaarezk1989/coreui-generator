<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdvertisementAPIRequest;
use App\Http\Requests\API\UpdateAdvertisementAPIRequest;
use App\Models\Advertisement;
use App\Repositories\AdvertisementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AdvertisementController
 * @package App\Http\Controllers\API
 */

class AdvertisementAPIController extends AppBaseController
{
    /** @var  AdvertisementRepository */
    private $advertisementRepository;

    public function __construct(AdvertisementRepository $advertisementRepo)
    {
        $this->advertisementRepository = $advertisementRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/advertisements",
     *      summary="Get a listing of the Advertisements.",
     *      tags={"Advertisement"},
     *      description="Get all Advertisements",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Advertisement")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $advertisements = $this->advertisementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($advertisements->toArray(), 'Advertisements retrieved successfully');
    }

    /**
     * @param CreateAdvertisementAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/advertisements",
     *      summary="Store a newly created Advertisement in storage",
     *      tags={"Advertisement"},
     *      description="Store Advertisement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Advertisement that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Advertisement")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Advertisement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAdvertisementAPIRequest $request)
    {
        $input = $request->all();

        $advertisement = $this->advertisementRepository->create($input);

        return $this->sendResponse($advertisement->toArray(), 'Advertisement saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/advertisements/{id}",
     *      summary="Display the specified Advertisement",
     *      tags={"Advertisement"},
     *      description="Get Advertisement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Advertisement",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Advertisement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            return $this->sendError('Advertisement not found');
        }

        return $this->sendResponse($advertisement->toArray(), 'Advertisement retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAdvertisementAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/advertisements/{id}",
     *      summary="Update the specified Advertisement in storage",
     *      tags={"Advertisement"},
     *      description="Update Advertisement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Advertisement",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Advertisement that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Advertisement")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Advertisement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAdvertisementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            return $this->sendError('Advertisement not found');
        }

        $advertisement = $this->advertisementRepository->update($input, $id);

        return $this->sendResponse($advertisement->toArray(), 'Advertisement updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/advertisements/{id}",
     *      summary="Remove the specified Advertisement from storage",
     *      tags={"Advertisement"},
     *      description="Delete Advertisement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Advertisement",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            return $this->sendError('Advertisement not found');
        }

        $advertisement->delete();

        return $this->sendSuccess('Advertisement deleted successfully');
    }
}
