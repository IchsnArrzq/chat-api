<?php

namespace App\Http\Controllers\Api\Explore;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Contact\ContactToggle;
use App\Traits\JsonRespond;
use Illuminate\Http\Request;

class ApiUserController extends ApiController
{
    use JsonRespond;
    private $contactToggle;
    public function __construct(ContactToggle $contactToggle)
    {
        parent::__construct();
        $this->contactToggle = $contactToggle;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::paginate($this->getLimit()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->contactToggle->execute([
            'user_id' => auth()->id(),
            'contact_id' => $request->contact_id
        ]);

        return $this->respond([
            'message' => 'Success Toggle your contact'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->contactToggle->execute([
            'user_id' => auth()->id(),
            'contact_id' => $request->contact_id
        ]);

        return $this->respond([
            'message' => 'Success Toggle your contact'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
