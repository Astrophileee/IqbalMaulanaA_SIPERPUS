<?php

namespace App\Http\Controllers;

use App\Models\loan;
use App\Http\Requests\StoreloanRequest;
use App\Http\Requests\UpdateloanRequest;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $loans = Loan::with(['member', 'user', 'loanDetails.book', 'returnBooks'])->get();
        return view('loans.index', [
            'user' => $request->user(),
            'loans' => $loans,
        ]);
    }

    public function returns(Request $request): View
{
    $loans = Loan::with(['member', 'user', 'loanDetails.book', 'returnBooks'])
                ->where('status', 'returned')
                ->get();
    return view('loans.returns', [
        'user' => $request->user(),
        'loans' => $loans,
    ]);
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();
        $users = User::all();
        return view('loans.create', compact('members', 'books','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreloanRequest $request)
    {
        $userId = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $userId;
        $loan = Loan::create($validatedData);

        if ($request->has('books')) {
            $books = array_filter($request->input('books'), fn($value) => !is_null($value) && $value !== '');
            $loan->books()->sync($books);
        }

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $loan->load(['member', 'user', 'books']);

        $bookIds = $loan->books->pluck('id');
        $books = $loan->books;
        return view('loans.detail', [
            'loan' => $loan,
            'books' => $books,
            'bookIds' => $bookIds,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loan $loan): View
    {
        return view('loans.edit', [
            'loan' => $loan,
            'members' => Member::all(),
            'books' => Book::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateloanRequest $request, loan $loan)
    {
        $validatedData = $request->validated();
        $loan->update($validatedData);
        if ($request->has('books')) {
            $books = array_filter($request->input('books'), fn($value) => !is_null($value) && $value !== '');
            $loan->books()->sync($books);
        }

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'loan deleted successfully!');
    }

    public function return(Request $request, loan $loan){
        if ($loan->status === 'returned') {
            return response()->json(['success' => false, 'message' => 'Loan already returned!'], 400);
        }
        $loan->status = 'returned';
        $loan->save();

        return response()->json(['success' => true, 'message' => 'Loan returned successfully!']);
    }

    public function generatePDF(){

        $loans = Loan::with(['member', 'user', 'loanDetails.book', 'returnBooks'])->get();
        $pdf = FacadePdf::loadView('loans.pdf', ['loans' => $loans]);

        return $pdf->download('tableLoans.pdf');

    }
    public function generateDetailPDF(Loan $loan)
    {
        $loan->load(['member', 'user', 'loanDetails.book', 'returnBooks']);

        $books = $loan->loanDetails->pluck('book');
        $bookIds = $books->pluck('id');

        $memberName = $loan->member ? $loan->member->name : 'Unknown Member';
        $loanDate = \Carbon\Carbon::parse($loan->date)->format('Y-m-d');

        $filename = str_replace(' ', '_', $memberName) . '_loan_' . $loanDate . '.pdf';

        $pdf = FacadePdf::loadView('loans.detailPdf', [
            'loan' => $loan,
            'books' => $books,
            'bookIds' => $bookIds,
        ]);

        return $pdf->download($filename);
    }
    public function generateReturnsPDF(){

        $loans = Loan::with(['member', 'user', 'loanDetails.book', 'returnBooks'])->where('status', 'returned')->get();
        $pdf = FacadePdf::loadView('loans.Returnspdf', ['loans' => $loans]);

        return $pdf->download('tableReturns.pdf');

    }
}
