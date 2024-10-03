<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class CompanyController extends Controller
{
    public function index(): Renderable
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create(): Renderable
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        (new Company()) -> create($request -> validated());

        return redirect() -> route('companies.index');
    }

    public function edit(Company $company): Renderable
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        $company->update($request->validated());
        return redirect() -> route('companies.index');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company -> delete();
        return redirect() -> route('companies.index');
    }
}
