<?php

namespace App\Http\Controllers\Api;

use WizwebBe\OrmApi;
use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    protected $itemNameSingular = "Mail";
    protected $model;

    public function __construct()
    {
        $this->model = new Mail();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = OrmApi::fetchAllWithFullQueryExposure($this->model, $request, $this->itemNameSingular);
        return response()->json($result['res'], $result['code']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store the item as usual
        $result = OrmApi::createItem(
            $request,
            $this->model,
            $this->itemNameSingular
        );

        // Check if the item was created successfully
        if ($result['code'] === 201) { // Assuming 201 is the success code for creation
            // Retrieve the created item's details
            $createdItem = $result['res'];

            // Prepare email details
            $emailDetails = [
                'recipient_name' => $request->input('name'),
                'item_name' => $createdItem['name'] ?? 'Unknown Item', // Replace with your field names
            ];

            // Send the email
            Mail::to($request->input('email'))->send(new ItemCreatedMail($emailDetails));
        }

        return response()->json($result['res'], $result['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = OrmApi::fetchByIdWithFullQueryExposure($this->model, $id, $this->itemNameSingular);
        return response()->json($result['res'], $result['code']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = OrmApi::updateItem(
            $request,
            $this->model,
            $id,
            $this->itemNameSingular
        );
        return response()->json($result['res'], $result['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $result = OrmApi::deleteItem(
            $this->model,
            $id,
            $this->itemNameSingular,
            $request
        );
        return response()->json($result['res'], $result['code']);
    }
}
