<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\Loan;
use App\Models\ReturnBook;
use App\Http\Requests\StoreLoanDetailRequest;
use App\Http\Requests\UpdateLoanDetailRequest;
use Illuminate\Support\Carbon;

class LoanDetailController extends Controller
{

    public function return($loanId)
    {
        $loan = Loan::with('loanDetails')->findOrFail($loanId);

        if ($loan->status === 'returned') {
            return response()->json(['message' => 'Loan already returned'], 400);
        }

        $loan->update(['status' => 'returned']);
        $returnAt = Carbon::parse($loan->return_at)->startOfDay();
        $today = Carbon::now()->startOfDay();

        foreach ($loan->loanDetails as $detail) {
            $detail->update(['is_return' => true]);

            $lateDays = $today->gt($returnAt) ? floor($returnAt->diffInDays($today, false)) : 0;
            $isLate = $lateDays > 0;
            $amount = $isLate ? $lateDays * 25000 : 0;
            ReturnBook::create([
                'loan_detail_id' => $detail->id,
                'charge' => $isLate,
                'amount' => $amount,
            ]);
        }

        return redirect()->route('loans.index')->with('success', 'Return successfully.');
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLoanDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanDetail $loanDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanDetail $loanDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanDetailRequest $request, LoanDetail $loanDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanDetail $loanDetail)
    {
        //
    }
}
