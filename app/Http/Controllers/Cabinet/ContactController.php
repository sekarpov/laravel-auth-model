<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\CreateRequest;
use App\Http\Requests\Contacts\EditRequest;
use App\Models\Contact;
use App\UseCases\Contacts\ContactService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $contacts = Contact::forUser(Auth::user())->orderByDesc('id')->paginate(20);

        return view('cabinet.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('cabinet.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Contacts\CreateRequest $request
     * @param \App\UseCases\Contacts\ContactService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request, ContactService $service)
    {
        try {
            $contact = $service->create(Auth::id(), $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.contacts.index', $contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Contact $contact)
    {
        $this->checkAccess($contact);
        return view('cabinet.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Contact $contact)
    {
        $this->checkAccess($contact);
        return view('cabinet.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Contacts\EditRequest $request
     * @param \App\Models\Contact $contact
     * @param \App\UseCases\Contacts\ContactService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $request, Contact $contact, ContactService $service)
    {
        $this->checkAccess($contact);
        try {
            $service->edit($contact->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.contacts.index', $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @param \App\UseCases\Contacts\ContactService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact, ContactService $service)
    {
        $this->checkAccess($contact);
        try {
            $service->remove($contact->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.contacts.index');
    }

    private function checkAccess(Contact $contact): void
    {
        if (!Gate::allows('manage-own-contact', $contact)) {
            abort(403);
        }
    }
}
