<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Services\HobbyService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    protected $hobbyService;

    public function __construct(HobbyService $hobbyService)
    {
        $this->hobbyService = $hobbyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with(['user', 'hobbies'])->get();
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        $this->hobbyService->syncHobbies($customer, $request->input('hobbies', []));
        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $user = auth()->user();

        // Validación básica, de nuevo, agregaría un model policy para esto.
        if ($user->profile_id !== 1 && ($user->profile_id === 2 && $user->id !== $customer->user_id)) {
            abort(403, 'Unauthorized action.');
        }

        $customer->load(['user', 'hobbies']);
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        $this->hobbyService->syncHobbies($customer, $request->input('hobbies', []));
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->noContent();
    }
}
