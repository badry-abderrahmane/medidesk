<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Response;
use Auth;

class EmailController extends Controller
{
      public function index()
      {
          $emails = Email::all();
          $emails->filter->typecomm;
          $emails->filter->action;
          $emails->filter->etat;
          $emails->filter->ticket;
          return $emails;
      }

      public function store(EmailRequest $request)
      {
          $user["user_id"] = Auth::user()->id;
          $request->merge($user);
          $email = Email::create($request->toArray());
          return Response::json(['message' => 'Email bien ajouté'], 200);
      }

      public function show($id)
      {
          $email = Email::findOrfail($id);
          $email->typecomm;
          $email->action;
          $email->etat;
          $email->ticket;
          return Response::json($email, 200);
      }

      public function update(EmailRequest $request, $id)
      {
          $email = Email::findOrfail($id);
          $email->update($request->toArray());
          return Response::json(['message' => 'Email bien mis à jour'], 200);
      }

      public function destroy($id)
      {
          Email::destroy($id);
          return Response::json(['message' => 'Email bien supprimé'], 200);
      }
}
