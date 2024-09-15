<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): Response
  {
    return Inertia::render('Chirps/Index', [
      'chirps' => Chirp::with('user:id,name')->latest()->get(),
    ]);
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
  public function store(Request $request): RedirectResponse
  {
    $validated = $request->validate(["message" => "required|string|max:255"]);

    $request->user()->chirps()->create($validated);

    return redirect(route('chirps.index'));
  }

  /**
   * Display the specified resource.
   */
  public function show(chirp $chirp)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(chirp $chirp)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, chirp $chirp): RedirectResponse
  {
    Gate::authorize('update', $chirp);

    $validated = $request->validate(["message" => "required|string|max:255"]);

    $chirp->update($validated);

    return redirect(route('chirps.index'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(chirp $chirp)
  {
    Gate::authorize('delete', $chirp);

    $chirp->delete();

    return redirect(route('chirps.index'));
  }
}
