<?php

namespace App\Http\Controllers\Api;

use App\Mail\ItemCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use WizwebBe\OrmApi;
use App\Http\Controllers\Controller;
use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as MailFacade;

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
        if ($result['code'] === 201 || $result['code'] === 200) { // Assuming 201 is the success code for creation
            // Retrieve the created item's details
            $createdItem = $result['res'];
            Log::info('2024-13-06--12-53', ['$payload' =>  [$createdItem]]);

            // Get the recipient email from the users table
            $recipient = User::find($createdItem['data']['recipient_id']);
            if (!$recipient) {
                return response()->json(['message' => 'Recipient not found'], 404);
            }

            $recipientEmail = $recipient->email;

            // Prepare email details
            $emailDetails = [
                'recipient_name' => $recipient->first_name,
                'email_body' => $createdItem['data']['email_body'], // Email body from the payload
            ];

            // Send the email

            Log::info('$emailDetails');
            Log::info($emailDetails);
            MailFacade::to($recipientEmail)->send(new ItemCreatedMail($emailDetails));

            if (count(MailFacade::failures()) > 0) {
                // Log the failures
                Log::error('Mail sending failed', MailFacade::failures());
            } else {
                //Log::info('Mail sent successfully');
            }

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
