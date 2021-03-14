<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\CreateRequest;
use App\Http\Requests\Contacts\EditRequest;
use App\Http\Resources\Contacts\ContactDetailResource;
use App\Http\Resources\Contacts\ContactListResource;
use App\Models\Contact;
use App\UseCases\Contacts\ContactService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    private $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $contacts = Contact::forUser(Auth::user())->orderByDesc('id')->paginate(20);

        return ContactListResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Contacts\CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function store(CreateRequest $request)
    {
        $contact = $this->service->create(Auth::id(), $request);

        return (new ContactDetailResource($contact))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \App\Http\Resources\Contacts\ContactDetailResource
     */
    public function show(Contact $contact)
    {
        $this->checkAccess($contact);

        return new ContactDetailResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Contacts\EditRequest $request
     * @param \App\Models\Contact $contact
     * @return \App\Http\Resources\Contacts\ContactDetailResource
     */
    public function update(EditRequest $request, Contact $contact)
    {
        $this->checkAccess($contact);
        $this->service->edit($contact->id, $request);

        return new ContactDetailResource(Contact::findOrFail($contact->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Contact $contact)
    {
        $this->checkAccess($contact);
        $this->service->remove($contact->id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    private function checkAccess(Contact $contact): void
    {
        if (!Gate::allows('manage-own-contact', $contact)) {
            abort(403);
        }
    }
}
