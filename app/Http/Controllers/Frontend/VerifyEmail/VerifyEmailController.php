<?php

namespace App\Http\Controllers\Frontend\VerifyEmail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\VerifyEmail\VerifyEmailRequest;
use App\Http\Traits\Frontend\VerifyEmail\VerifyEmailTrait;
use App\Jobs\ProcessCsvEmailsJob;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    use VerifyEmailTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $emails = $this->fetchEmails($request);
            return view('frontend.verify-emails.email-listing', compact('emails'))->render();
        }
        return view('frontend.verify-emails.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VerifyEmailRequest $request)
    {
        try {
            if ($request->type === 'single') {
                return $this->handleSingleEmail($request);
            }

            if ($request->type === 'csv') {
                $validationResult = $this->validateCSVUpload($request);
                if (isset($validationResult['error'])) {
                    return redirect()->back()->with('error', $validationResult['error']);
                }
                if ($this->handleCsvUpload($request)) {
                    ProcessCsvEmailsJob::dispatch();
                    return redirect()->back()->with('success', 'CSV file uploaded successfully. It will be processed shortly.');
                }
            }
            return redirect()->back()->with('error', 'Invalid request type');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
